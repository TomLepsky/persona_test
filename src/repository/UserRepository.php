<?php


namespace App\Repository;


use App\Component\DB;
use JetBrains\PhpStorm\ArrayShape;

class UserRepository
{
    public static function getUserByName(string $name) : ?array
    {
        $db = DB::getConnection();
        $stmt = $db->prepare("SELECT * FROM `user` WHERE name = ?");
        $stmt->execute([$name]);
        $result = $stmt->fetch();
        return empty($result) ? null : $result;
    }

    #[ArrayShape(['id' => "string", 'name' => "string"])]
    public static function createUser(string $name) : array
    {
        $db = DB::getConnection();
        $stmt = $db->prepare("INSERT INTO `user`(`name`) VALUES (?)");
        $stmt->execute([$name]);
        return ['id' => $db->lastInsertId(), 'name' => $name];
    }
}