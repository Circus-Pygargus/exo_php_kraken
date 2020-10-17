<?php

namespace App\Controller;

use App\Application\Controller;

use App\Entity\Kraken;
use App\Entity\Power;
use App\Entity\KrakenPower;
use App\Entity\Tentacle;


class PowerController extends Controller
{
    /**
     * Route '/power/add'
     * 
     * Add a power
     */
    public function add ()
    {
        $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';

        if ($contentType === "Application/json") {
            $content = trim(file_get_contents("php://input"));
            $decoded = json_decode($content, true);
            extract($decoded);
            
            $errors = [];

            !$krakenId ? $errors["krakenId"] = 'Il manque l\'ID du kraken' : $krakenId = (int) $krakenId;

            !$powerId ? $errors["powerId"] = 'Il manque l\'ID du pouvoir' : $powerId = (int) $powerId;

            if (count($errors) !== 0) {
                $response = array(
                    'response' => 'not ok',
                    'errors' => $errors,
                    'errorMessage' => 'Il y a des erreurs dans le formulaire'
                );
            }
            else {
                $tentacleModel = new Tentacle();
                $tentaclesNb = $tentacleModel->getTentaclesNb($krakenId)["COUNT(id)"];

                $krakenPowerModel = new KrakenPower();
                $krakenPowersNb = $krakenPowerModel->getPowersNb($krakenId)["COUNT(id)"];
                
                if (($tentaclesNb < 4 && $krakenPowersNb === 1) ||
                    ($tentaclesNb >= 4 && $tentaclesNb < 8 && $krakenPowersNb === 2) ||
                    ($tentaclesNb === 8 && $krakenPowersNb === 3))
                {
                    $response = array(
                        'response' => 'not ok',
                        'errorMessage' => 'Impossible d\'ajouter un pouvoir vu le nombre de tentacules'
                    );
                }
                else {
                    $isPowerRecorded = $krakenPowerModel->add($krakenId, $powerId);

                    if (!$isPowerRecorded) {
                        $response = array(
                            'response' => 'not ok',
                            'errorMessage' => 'Il y a eu un problème en BDD durant l\'enregistrement de ce pouvoir'
                        );
                    }
                    else {
                        $krakenPowers = $krakenPowerModel->getAllPowersByKrakenId($krakenId);

                        $powerModel = new Power();
                        $allPowers = $powerModel->getAll();
                        $availablePowers = $this->getAvailablePowers($allPowers, $krakenPowers);

                        $krakenModel = new Kraken();
                        $kraken = $krakenModel->getOneById($krakenId);

                        $powersHtml = $this->twig->render('partial/powers-infos.html.twig', [
                            "krakenPowers" => $krakenPowers
                        ]);

                        $addablePowersHtml = $this->twig->render('partial/powers-add.html.twig', [
                            "kraken" => $kraken,
                            "availablePowers" => $availablePowers
                        ]);

                        $removablePowersHtml = $this->twig->render('partial/powers-delete.html.twig', [
                            "kraken" => $kraken,
                            "krakenPowers" => $krakenPowers
                        ]);

                        $response = array(
                            'response' => 'ok',
                            'message' => 'Pouvoir enregistré',
                            'powersHtml' => $powersHtml,
                            'addablePowersHtml' => $addablePowersHtml,
                            'removablePowersHtml' => $removablePowersHtml
                        );
                    }
                }
            }
            echo json_encode($response);
        }
    }


    /**
     * Remove a power to a kraken
     * 
     * Route '/power/remove'
     */
    public function remove ()
    {
        $contentType = isset($_SERVER["CONTENT_TYPE"]) ? $_SERVER["CONTENT_TYPE"] : '';
        
        if ($contentType === "Application/json") {
            $content = trim(file_get_contents("php://input"));
            $decoded = json_decode($content, true);

            extract($decoded);

            $errors = [];

            !$krakenId ? $errors["krakenId"] = 'Il manque l\'D du kraken' : $krakenId = (int) $krakenId;

            !$powerId ? $errors["powerId"] = 'Il manque l\'ID du kraken' : $powerId = (int) $powerId;

            if (count($errors) !== 0) {
                $response = [
                    'response' => 'not ok',
                    'errors' => $errors,
                    'errorMessage' => 'Il y a un problème avec le formulaire'
                ];
            }
            else {
                $tentacleModel = new Tentacle();
                $tentaclesNb = $tentacleModel->getTentaclesNb($krakenId)["COUNT(id)"];

                $krakenPowerModel = new KrakenPower();
                $krakenPowersNb = $krakenPowerModel->getPowersNb($krakenId)["COUNT(id)"];
                
                if ($krakenPowersNb === 1) {
                    $response = array(
                        'response' => 'not ok',
                        'errorMessage' => 'Impossible de supprimer le pouvoir de base du kraken'
                    );
                }
                else if (($tentaclesNb >= 4 && $tentaclesNb < 8 && $krakenPowersNb === 2) ||
                    ($tentaclesNb === 8 && $krakenPowersNb === 3))
                {
                    $response = array(
                        'response' => 'not ok',
                        'errorMessage' => 'Impossible de supprimer un pouvoir, il faut supprimer au moins un tentacule'
                    );
                }
                else {
                    $isPowerdeleted = $krakenPowerModel->delete($powerId);
                    if (!$isPowerdeleted) {
                        $response = array(
                            'response' => 'not ok',
                            'errorMessage' => 'Il y a eu un problème en BDD durant l\'enregistrement de ce pouvoir'
                        );
                    }
                    else {
                        $krakenPowers = $krakenPowerModel->getAllPowersByKrakenId($krakenId);

                        $powerModel = new Power();
                        $allPowers = $powerModel->getAll();
                        $availablePowers = $this->getAvailablePowers($allPowers, $krakenPowers);

                        $krakenModel = new Kraken();
                        $kraken = $krakenModel->getOneById($krakenId);

                        $powersHtml = $this->twig->render('partial/powers-infos.html.twig', [
                            "krakenPowers" => $krakenPowers
                        ]);

                        $addablePowersHtml = $this->twig->render('partial/powers-add.html.twig', [
                            "kraken" => $kraken,
                            "availablePowers" => $availablePowers
                        ]);

                        $removablePowersHtml = $this->twig->render('partial/powers-delete.html.twig', [
                            "kraken" => $kraken,
                            "krakenPowers" => $krakenPowers
                        ]);

                        $response = array(
                            'response' => 'ok',
                            'message' => 'Pouvoir retiré',
                            'powersHtml' => $powersHtml,
                            'addablePowersHtml' => $addablePowersHtml,
                            'removablePowersHtml' => $removablePowersHtml
                        );
                    }
                }
            }
            echo json_encode($response);
        }
    }



    /**
     * Get available powers for a kraken
     * 
     * @param array $allPowers All existing powers
     * @param array $krakenPowers The kraken powers
     * 
     * @return array
     */
    private function getAvailablePowers ($allPowers, $krakenPowers): array
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