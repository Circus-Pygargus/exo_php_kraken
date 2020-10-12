<?php

namespace App\Application;


use Dotenv\Dotenv;


class DatabaseConfig
{

    /**
     * @var PDO
     */
    public $db;

    private function config ()
    {
        // load phpdotenv
        $dotenv = Dotenv::createImmutable($_SERVER["DOCUMENT_ROOT"] . '/..');

        $dotenv->load();
        
        try {
            $this->db = new \PDO('mysql:host=' . $_ENV['HOSTNAME'] . ';dbname=' . $_ENV['DBNAME'], $_ENV['USER'], $_ENV['PASSWORD'], [\PDO::ATTR_EMULATE_PREPARES=>false]);
        }
        catch (\Exception $e) {
            // die('Erreur : ' . $e->get->message());
            
            die('Erreur : ' . $e);
        }
    }

    public function connect ()
    {
        $this->config();
    }
}