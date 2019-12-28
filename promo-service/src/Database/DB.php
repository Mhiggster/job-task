<?php


namespace Choco\Database;

use PDO;

class DB
{
    /**
     * @param array $config
     * @return PDO
     */
    public static function connection(array $config) : PDO
    {
        try {
            return new PDO(
                $config['driver'].':host='.$config['host'].';dbname='.$config['dbname'].';charset=utf8',
                $config['username'],
                $config['password'],
                $config['options']);
        } catch (PDOException $e) {
            die('Подключение не удалось: ' . $e->getMessage());
        }
    }
}
