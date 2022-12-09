<?php

use App\Component\DB;
use App\Helper\ResponseHelper;
use App\Repository\ChatRepository;
use App\Repository\MessageRepository;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';

DB::getConnection();
$app = AppFactory::create();
$app->addRoutingMiddleware();
$errorMiddleware = $app->addErrorMiddleware(true, false, false);

$app->get('/message', function (Request $request, Response $response, $args) {
    $params = $request->getQueryParams();
    $page = $params['page'] ?? 1;
    if ($page < 1) {
        return ResponseHelper::jsonResponseWrapper($response, 422, ['error' => "page must be equal 1 or more"]);
    }

    $pageSize = $params['pageSize'] ?? 10;
    if ($pageSize < 1) {
        return ResponseHelper::jsonResponseWrapper($response, 422, ['error' => "pageSize must be equal 1 or more"]);
    }
    $messages = MessageRepository::getMessages(
        $params['chatId'] ?? 0,
        $page,
        $pageSize
    );
    return ResponseHelper::jsonResponseWrapper($response, 200, $messages);
});

$app->post('/message', function (Request $request, Response $response, $args) {
    $params = json_decode($request->getBody()->getContents(), true);
    $missed = array_diff(['chatId', 'message', 'userName'], array_keys($params));
    if (!empty($missed)) {
        $missed = implode(', ', $missed);
        return ResponseHelper::jsonResponseWrapper($response, 422, ['error' => "You forget following params: $missed"]);
    }

    $chat = ChatRepository::getChatById($params['chatId']);
    if ($chat === null) {
        return ResponseHelper::jsonResponseWrapper($response, 422, ['error' => "Chat with id: {$params['chatId']} doesn't exists"]);
    }

    $result = MessageRepository::createMessage($params['chatId'], $params['message'], $params['userName']);
    if (!$result) {
        return ResponseHelper::jsonResponseWrapper($response, 500, ['error' => "Server internal error"]);
    }

    return $response->withStatus(201);
});

$app->delete('/message/{id:[\d]+}', function (Request $request, Response $response, $args) {
    $result = MessageRepository::deleteMessage(intval($args['id']));
    if (!$result) {
        return ResponseHelper::jsonResponseWrapper($response, 500, ['error' => "Server internal error"]);
    }

    return $response->withStatus(200);
});

$app->get('/chat', function (Request $request, Response $response, $args) {
    $chats = ChatRepository::getChats();
    return ResponseHelper::jsonResponseWrapper($response, 200, $chats);
});

$app->run();