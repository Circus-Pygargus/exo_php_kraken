<?php

namespace App\Entity;


use App\Application\Database;


class Tentacle extends Database
{
    /* ############### PROPERTIES ############### */

    /**
     * @var int
     */
    private $id;

    /**
     * @var int
     */
    private $krakenId;

    /**
     * @var string
     */
    private $name;

    /**
     * @var int
     */
    private $lifePoints;

    /**
     * @var int
     */
    private $forcee;

    /**
     * @var int
     */
    private $dexterity;

    /**
     * @var int
     */
    private $constitution;



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
     * Get the value of krakenId
     * 
     * @return int
     */
    public function getKrakenId (): int
    {
        return $this->krakenId;
    }

    /**
     * Set the value of krakenId
     * 
     * @param int $krakenId
     * 
     * @return self
     */
    public function setKrakenId (int $krakenId): self
    {
        $this->ikrakenIdd = $krakenId;
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
     * Get the value of lifePoints
     * 
     * @return int
     */
    public function getLifePoints (): int
    {
        return $this->lifePoints;
    }

    /**
     * Set the value of lifePoints
     * 
     * @param int $lifePoints
     * 
     * @return self
     */
    public function setLifePoints (int $lifePoints): self
    {
        $this->lifePoints = $lifePoints;
        return $this;
    }


    /**
     * Get the value of forcee
     * 
     * @return int
     */
    public function getforcee (): int
    {
        return $this->forcee;
    }

    /**
     * Set the value of forcee
     * 
     * @param int $forcee
     * 
     * @return self
     */
    public function setforcee (int $forcee): self
    {
        $this->forcee = $forcee;
        return $this;
    }


    /**
     * Get the value of dexterity
     * 
     * @return int
     */
    public function getDexterity (): int
    {
        return $this->dexterity;
    }

    /**
     * Set the value of dexterity
     * 
     * @param int $dexterity
     * 
     * @return self
     */
    public function setDexterity (int $dexterity): self
    {
        $this->dexterity = $dexterity;
        return $this;
    }


    /**
     * Get the value of constitution
     * 
     * @return int
     */
    public function getConstitution (): int
    {
        return $this->constitution;
    }

    /**
     * Set the value of constitution
     * 
     * @param int $constitution
     * 
     * @return self
     */
    public function setConstitution (int $constitution): self
    {
        $this->constitution = $constitution;
        return $this;
    }



    /* ############### SQL REQUESTS ############### */

    /**
     * Add a tentacle
     * 
     * @param int $krakenId
     * @param string $name
     * @param int $lifePoints
     * @param int $forcee
     * @param int $dexterity
     * @param int $constitution
     * 
     * @return bool
     */
    public function add (int $krakenId, string $name, int $lifePoints, int $forcee, int $dexterity, int $constitution): bool
    {
        $sql = "INSERT INTO tentacle(kraken_id,name, life_points, forcee, dexterity, constitution)
                VALUES (:kraken_id, :name, :life_points, :forcee, :dexterity, :constitution)";
        $this->prepare($sql);
        $this->bindParam(':kraken_id', $krakenId, \PDO::PARAM_INT);
        $this->bindParam(':name', $name, \PDO::PARAM_STR);
        $this->bindParam(':life_points', $lifePoints, \PDO::PARAM_INT);
        $this->bindParam(':forcee', $forcee, \PDO::PARAM_INT);
        $this->bindParam(':dexterity', $dexterity, \PDO::PARAM_INT);
        $this->bindParam(':constitution', $constitution, \PDO::PARAM_INT);
        return $this->execute();
    }


    /**
     * Get a tentacle id by name
     * 
     * @param string $name
     * 
     * @return int tentacle ID
     */
    public function getIdByName (string $name)
        {
        $sql = "SELECT id FROM tentacle WHERE name=:name";
        $this->prepare($sql);
        $this->bindParam(':name', $name, \PDO::PARAM_STR);
        $this->execute();

        return $this->fetch();
    }


    /**
     * Get a tentacle by id
     * 
     * @param int $id
     * 
     * @return array
     */
    public function getById ($id): array
    {
        $sql = "SELECT * FROM tentacle WHERE id=:id";
        $this->prepare($sql);
        $this->bindParam(':id', $id, \PDO::PARAM_INT);
        $this->execute();

        return $this->fetch(); 
    }


    /**
     * Get all tentacle corresponding to kraken id
     * 
     * @param int $krakenId
     * 
     * @return array
     */
    public function getAllbyKrakenId ($krakenId): array
    {
        $sql = "SELECT * FROM tentacle WHERE kraken_id=:kraken_id";
        $this->prepare($sql);
        $this->bindParam(':kraken_id', $krakenId, \PDO::PARAM_INT);
        $this->execute();

        return $this->fetchAll();
    }
}