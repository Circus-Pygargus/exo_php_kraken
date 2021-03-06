<?php

namespace App\Controller;


use App\Application\Controller;

use App\Entity\Kraken;
use App\Entity\Tentacle;
use App\Entity\KrakenPower;
use App\Entity\Power;


class KrakenController extends Controller
{
    /**
     * route '/'
     * 
     * @return string HTML
     */
    public function index (): string
    {
        $krakenModel = new Kraken();
        $krakens = $krakenModel->getAll();

        $tentacleModel = new Tentacle();
        $krakenPowerModel = new KrakenPower();

        foreach ($krakens as &$kraken) {
            $result = $tentacleModel->getTentaclesNb($kraken["id"]);
            $kraken["tentacleNb"] = $result["COUNT(id)"];

            $powers = $krakenPowerModel->getAllPowersByKrakenId($kraken["id"]);
            $kraken["powers"] = "";
            foreach ($powers as $power) {
                if (!$kraken["powers"]) {
                    $kraken["powers"] = $power["name"];
                }
                else {
                    $kraken["powers"] .= ', ' . $power["name"];
                }
            }
        }
        return $this->twig->render('index.html.twig', [
            "krakens" => $krakens
        ]);
    }


    /**
     * route '/kraken/new'
     * 
     * user wants to create a new kraken, send a kraken creation form
     * 
     * @return string HTML
     */
    public function new (): string
    {
        return $this->twig->render('kraken/new.html.twig');
    }


    /**
     * route '/kraken/create'
     * 
     * user sent the kraken creation form
     */
    public function create ()
    {
        $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';

        if ($contentType === 'Application/json') {
            // get and decode new kraken form content
            $content = trim(file_get_contents("php://input"));
            $decoded = json_decode($content, true);
            // get form content as variables
            extract($decoded);

            $error = [];

            !$name ? $error["name"] = "Il faut entrer un nom" : $name = htmlspecialchars($name);
            
            !$age ? $error["age"] = "Il faut entrer un age" : $age = (int) $age;

            !$height ? $error["height"] = "Il faut entrer une taille" : $height = (int) $height;

            !$weight ? $error["weight"] = "Il faut entrer un poids" : $weight = (int) $weight;

            if (count($error) !== 0) {
                $response = array(
                    'response' => 'not ok',
                    'errors' => $error, 
                    'errorMessage' => 'Il y a des erreurs dans le formulaire'
                );
            }
            else {
                $krakenModel = new Kraken();
                $isKrakenSaved = $krakenModel->add($name, $age, $height, $weight);

                if (!$isKrakenSaved) {
                    $response = array(
                        'response' => 'not ok',
                        'errorMessage' => 'Il y a eu un problème pendant l\'enregistrement en base de données'
                    );
                }
                else {
                    $krakenId = $krakenModel->getIdByName($name);
                    $response = array(
                        'response' => 'ok',
                        'message' => 'Kraken enregistré !',
                        'krakenId' => $krakenId["id"]
                    );
                }
            }
            echo json_encode($response);
        }
    }


    /**
     * route /kraken/krakenId
     * 
     * Display infos about requested kraken
     * 
     * param given by altoRouter, wanted param is in an array
     * @param array
     * 
     * @return string HTML
     */
    public function infos (array $krakenId): string
    {
        $id = (int)$krakenId["krakenId"];

        $krakenModel = new Kraken();
        $kraken = $krakenModel->getOneById($id);

        $tentacleModel = new Tentacle();
        $tentacles = $tentacleModel->getAllbyKrakenId($id);

        $krakenPowerModel = new KrakenPower();
        $krakenPowers = $krakenPowerModel->getAllPowersByKrakenId($id);

        $powerModel = new Power();
        $allPowers = $powerModel->getAll();
        $availablePowers = $this->getAvailablePowers($allPowers, $krakenPowers);

        return $this->twig->render('kraken/infos.html.twig', [
            "kraken" => $kraken,
            "tentacles" => $tentacles,
            "krakenPowers" => $krakenPowers,
            "availablePowers" => $availablePowers
        ]);
    }


    /**
     * Get available powers for a kraken
     * 
     * @param array $allPowers All existing powers
     * @param array $krakenPowers The kraken powers
     * 
     * @return array
     */
    private function getAvailablePowers (array $allPowers, array $krakenPowers): array
    {
        $availablePowers = [];

        foreach ($allPowers as $possiblePower) {
            $powerSeen = false;
            foreach ($krakenPowers as $krakenPower) {
                if ($possiblePower["id"] === $krakenPower["power_id"]) $powerSeen = true;
            }

            if (!$powerSeen) array_push($availablePowers, $possiblePower);
        }

        return $availablePowers;
    }
}