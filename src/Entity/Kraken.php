<?php

namespace App\Entity;


use App\Application\Database;


class Kraken extends Database
{
    /* ############### PROPERTIES ############### */

    /**
     * @var int
     */
    private $id;


    /**
     * @var string
     */
    private $name;


    /**
     * @var int
     */
    private $age;


    /**
     * @var int
     */
    private $height;


    /**
     * @var int
     */
    private $weight;



    /* ############### GETTERS AND SETTERS ############### */

    /**
     * Get the value of id
     * 
     * @return int
     */
    public function getId (): int
    {
        return $this->id;
    }

    /**
     * Set the value of id
     * 
     * @param int $id
     * 
     * @return self
     */
    public function setId (int $id): self
    {
        $this->id = $id;
        return $this;
    }


    /**
     * Get the value of name
     * 
     * @return string
     */
    public function getName (): string
    {
        return $this->name;
    }

    /**
     * Set the value of name
     * 
     * @param string $name
     * 
     * @return self
     */
    public function setName (string $name): self
    {
        $this->name = $name;
        return $this;
    }


    /**
     * Get the value of age
     * 
     * @return int
     */
    public function getAge (): int
    {
        return $this->age;
    }

    /**
     * Set the value of age
     * 
     * @param int $age
     * 
     * @return self
     */
    public function setAge (int $age): self
    {
        $this->age = $age;
        return $this;
    }


    /**
     * Get the value of height
     * 
     * @return int
     */
    public function getHeight (): int
    {
        return $this->height;
    }

    /**
     * Set the value of height
     * 
     * @param int $height
     * 
     * @return self
     */
    public function setHeight (int $height): self
    {
        $this->height = $height;
        return $this;
    }


    /**
     * Get the value of weight
     * 
     * @return int
     */
    public function getWeight (): int
    {
        return $this->weight;
    }

    /**
     * Set the value of weight
     * 
     * @param int $weight
     * 
     * @return self
     */
    public function setWeight (int $weight): self
    {
        $this->weight = $weight;
        return $this;
    }



    /* ############### SQL REQUESTS ############### */

    /**
     * Add a kraken
     * 
     * @param string $name
     * @param int $age
     * @param int $height
     * @param int $weight
     * @param string $tentacles
     * @param string $powers
     * 
     * @return bool
     */
    public function add (string $name, int $age, int $height, int $weight, string $tentacles, string $powers): bool
    {
        $sql = "INSERT INTO kraken(name, age, height, weight, tentacles, powers)
                VALUES (:name, :age, :height, :weight, :tentacles, :powers)";
        $this->prepare($sql);
        $this->bindParam(':name', $name, \PDO::PARAM_STR);
        $this->bindParam(':age', $age, \PDO::PARAM_INT);
        $this->bindParam(':height', $height, \PDO::PARAM_INT);
        $this->bindParam(':weight', $weight, \PDO::PARAM_INT);
        $this->bindParam(':tentacles', $tentacles, \PDO::PARAM_STR);
        $this->bindParam(':powers', $powers, \PDO::PARAM_STR);
        return $this->execute();
    }


    /**
     * Get a kraken id by name
     * 
     * @param string $name
     * 
     * @return int kraken ID
     */
    public function getIdByName (string $name)
        {
        $sql = "SELECT id FROM kraken WHERE name=:name";
        $this->prepare($sql);
        $this->bindParam(':name', $name, \PDO::PARAM_STR);
        $this->execute();

        return $this->fetch();
    }


    /**
     * Get all krakens
     * 
     * @return array
     */
    public function getAll (): array
    {
        $sql = "SELECT * FROM kraken";
        $this->prepare($sql);
        $this->execute();
        return $this->fetchAll();
    }


    /**
     * Update tentacles form a kraken
     * 
     * @param int $id
     * @param string $tentacles
     * 
     * @return void
     */
    public function editTentacles ($id, $tentacles): void
    {
        $sql = "UPDATE kraken SET tentacles=:tentacles WHERE id=:id";
        $this->prepare($sql);
        $this->bindParam(':id', $id, \PDO::PARAM_INT);
        $this->bindParam(':tentacles', $tentacles, \PDO::PARAM_STR);
        $this->execute();
    }


    /**
     * Update powers form a kraken
     * 
     * @param int $id
     * @param string $powers
     * 
     * @return void
     */
    public function editPowers ($id, $powers): void
    {
        $sql = "UPDATE kraken SET powers=:powers WHERE id=:id";
        $this->prepare($sql);
        $this->bindParam(':id', $id, \PDO::PARAM_INT);
        $this->bindParam(':powers', $powers, \PDO::PARAM_STR);
        $this->execute();
    }
}