<?php

namespace App\Application;


use App\Application\DatabaseConfig;


class Database extends DatabaseConfig
{
    /**
     * PDO STATEMENT
     */
    private $sth;


    public function __construct()
    {
        $this->connect();
    }


    protected function prepare (string $sql): void
    {
        $this->sth = $this->db->prepare($sql);
    }


    protected function bindParam (string $param, $var, $type): void
    {
        $this->sth->bindParam($param, $var, $type);
    }


    protected function bindValue (string $param, $var, $type): void{
        $this->sth->bindParam($param, $var, $type);
    }


    protected function execute (): bool
    {
        return $this->sth->execute();
    }


    protected function fetch (): array
    {
        return $this->sth->fetch(\PDO::FETCH_ASSOC);
    }


    protected function fetchAll (): array
    {
        return $this->sth->fetchAll(\PDO::FETCH_ASSOC);
    }
}