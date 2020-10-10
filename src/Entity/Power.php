<?php

namespace App\Entity;


use App\Application\Database;


class Power extends Database
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



    /* ############### SQL REQUESTS ############### */

    /**
     * Get a power by id
     * 
     * @param int $id
     * 
     * @return array
     */
    public function getById ($id): array
    {
        $sql = "SELECT * FROM power WHERE id=:id";
        $this->prepare($sql);
        $this->bindParam(':id', $id, \PDO::PARAM_INT);
        $this->execute();

        return $this->fetch(); 
    }
}