<?php


namespace App\Repository;

use App\Component\DB;

class ChatRepository
{
    public static function getChats() : array
    {
        $db = DB::getConnection();
        return $db->query("SELECT * FROM `chat`")->fetchAll();
    }

    public static function getChatById(int $id) : ?array
    {
        $db = DB::getConnection();
        $stmt = $db->prepare("SELECT * FROM `chat` WHERE id = ?");
        $stmt->execute([$id]);
        $result = $stmt->fetch();
        return empty($result) ? null : $result;
    }
}