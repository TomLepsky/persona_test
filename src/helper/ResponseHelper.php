<?php


namespace App\Helper;

use Psr\Http\Message\ResponseInterface as Response;

class ResponseHelper
{
    public static function jsonResponseWrapper(Response $response, int $status, array $data) : Response
    {
        $response->getBody()->write(json_encode($data));
        return $response->withHeader('Content-Type', 'application/json')->withStatus($status);
    }
}