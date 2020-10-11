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
        $sql = "INSERT INTO tentacle(kraken_id, power_id)
                VALUES (:kraken_id, :power_id";
        $this->prepare($sql);
        $this->bindParam(':kraken_id', $krakenId, \PDO::PARAM_INT);
        $this->bindParam(':power_id', $powerId, \PDO::PARAM_INT);
        return $this->execute();
    }
}