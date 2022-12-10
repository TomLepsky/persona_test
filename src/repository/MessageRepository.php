<?php


namespace App\Repository;


use App\Component\DB;
use Exception;
use PDO;

class MessageRepository
{
    /**
     * @throws Exception
     */
    public static function createMessage(int $chatId, string $message, string $userName) : bool
    {
        if (ChatRepository::getChatById($chatId) === null) {
            throw new Exception("Not found chat with id: $chatId");
        }

        $user = UserRepository::getUserByName($userName);
        if ($user === null) {
            $user = UserRepository::createUser($userName);
        }

        $db = DB::getConnection();
        $stmt = $db->prepare("INSERT INTO `message`(`chat_id`, `user_id`, `message`, `date`) VALUES (?, ?, ?, NOW())");
        return $stmt->execute([$chatId, $user['id'], $message]);
    }

    public static function deleteMessage(int $id) : bool
    {
        $db = DB::getConnection();
        $stmt = $db->prepare("DELETE FROM `message` WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public static function getMessages(int $chatId = 0, int $page = 1, int $pageSize = 10) : array
    {
        $placeHolders = [];
        $sql = "SELECT m.id as id, m.chat_id as chat_id, m.user_id as user_id, u.name as user_name, m.message as message, m.date as date 
                FROM `message` m 
                LEFT JOIN `user` u ON m.user_id = u.id";
        if ($chatId !== 0) {
            $sql .= " WHERE chat_id = :chatId ";
            $placeHolders[':chatId'] = $chatId;
        }
        $sql .= " LIMIT :pageSize OFFSET :page";
        $placeHolders[':pageSize'] = $pageSize;
        $placeHolders[':page'] = ($page - 1) * $pageSize;

        $db = DB::getConnection();
        $stmt = $db->prepare($sql);
        foreach ($placeHolders as $placeHolder => $param) {
            $stmt->bindValue($placeHolder, $param, PDO::PARAM_INT);
        }
        $stmt->execute();
        return $stmt->fetchAll();
    }
}