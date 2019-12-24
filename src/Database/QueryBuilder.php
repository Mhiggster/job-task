<?php


namespace Choco\Database;

use PDO;

class QueryBuilder
{
    /**
     * @var $pdo
     */
    private $pdo;

    /**
     * QueryBuilder constructor.
     * @param PDO $pdo
     */
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * @return string
     */
    public function tableName() : string
    {
        return $this->table;
    }

    /**
     * @return string
     */
    private function promoTable() : string
    {
        return 'CREATE TABLE '.$this->tableName().' (
            id int(11) AUTO_INCREMENT PRIMARY KEY,
            name varchar(255),
            start_date int(11),
            end_date int(11),
            status varchar(30)
        )';
    }

    /**
     * Создаем Таблицу
     */
    public function createTable() : void
    {
        try {
            $st = $this->pdo->prepare($this->promoTable());
            $st->execute();
        } catch (\PDOException $e) {
            echo 'Таблица '.$this->tableName().' уже существует!';
        }
    }

    /**
     * @param array $parameters
     */
    public function insert(array $parameters) : void
    {
        $sql = sprintf(
            'INSERT INTO %s (%s) values (%s)',
            $this->tableName(),
            implode(', ', array_keys($parameters)),
            ':' . implode(', :', array_keys($parameters))
        );

        try {
            $st = $this->pdo->prepare($sql);
            $st->execute($parameters);
        } catch (\PDOException $e) {
            // write error to the log
        }

    }

    /**
     * @return array
     */
    public function selectRandom() : array
    {
        $st = $this->pdo->prepare('SELECT * FROM '.$this->tableName().' ORDER BY RAND() LIMIT 1');
        $st->execute();

        return $st->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * @return array
     */
    public function all() : array
    {
        $st = $this->pdo->prepare('SELECT * FROM '.$this->tableName());
        $st->execute();

        return $st->fetchAll(PDO::FETCH_ASSOC);
    }
}
