<?php

namespace App\Entity;


use App\Application\Database;


class KrakenPower extends Database
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
     * @var int
     */
    private $powerId;



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
        $this->krakenId = $krakenId;
        return $this;
    }

    /**
     * Get the value of powerId
     * 
     * @return int
     */
    public function getPowerId (): int
    {
        return $this->powerId;
    }

    /**
     * Set the value of powerId
     * 
     * @param int $powerId
     * 
     * @return self
     */
    public function setPowerId (int $powerId): self
    {
        $this->powerId = $powerId;
        return $this;
    }



    /* ############### SQL REQUESTS ############### */

    /**
     * Add a power to this kraken
     * 
     * @param int $krakenId
     * @param int $powerId
     * 
     * @return bool
     */
    public function add (int $krakenId, int $powerId): bool
    {
        $sql = "INSERT INTO kraken_power(kraken_id, power_id)
                VALUES (:kraken_id, :power_id)";
        $this->prepare($sql);
        $this->bindParam(':kraken_id', $krakenId, \PDO::PARAM_INT);
        $this->bindParam(':power_id', $powerId, \PDO::PARAM_INT);
        return $this->execute();
    }


    /**
     * Get all power's names of a kraken
     * 
     * @param int $id
     * 
     * @return array
     */
    public function getAllPowersByKrakenId (int $id): array
    {
        $sql = "SELECT * FROM power
                LEFT JOIN kraken_power ON kraken_power.kraken_id=:id
                WHERE power.id=kraken_power.power_id";
        $this->prepare($sql);
        $this->bindParam(':id', $id, \PDO::PARAM_INT);
        $this->execute();

        return $this->fetchAll();
    }


    /**
     * Get the number of powers for a kraken
     * 
     * @param int $krakenId
     * 
     * @return array
     */
    public function getPowersNb (int $krakenId): array
    {
        $sql = "SELECT COUNT(id) FROM kraken_power WHERE kraken_id=:kraken_id";
        $this->prepare($sql);
        $this->bindParam(':kraken_id', $krakenId, \PDO::PARAM_INT);
        $this->execute();

        return $this->fetch();
    }


    /**
     * Delete a power for a kraken
     * 
     * @param int $krakenId The kraken ID
     * @param int $powerId The power ID
     * 
     * @return bool
     */
    public function delete (int $id): bool
    {
        // first, check if the kraken has this poswer
        $sql = "SELECT * FROM kraken_power WHERE id=:id";
        $this->prepare($sql);
        $this->bindParam(':id', $id, \PDO::PARAM_INT);
        $this->execute();
        $krakenPower = $this->fetchAll();

        if (!$krakenPower) return false;
        else {
            $sql = "DELETE FROM kraken_power WHERE id=:id";
            $this->prepare($sql);
            $this->bindParam(':id', $id, \PDO::PARAM_INT); 
            $this->execute();

            return $this->rowCount() === 1 ? true : false;
        }
    }
}