<?php

namespace App\Controller;


use App\Application\Controller;

use App\Entity\Kraken;
use App\Entity\Tentacle as TentacleModel;
use App\Entity\KrakenPower;


class Tentacle extends Controller
{
    /**
     * Route '/tentacle/
     * 
     * Create a Tentacle
     * 
     */
    public function create ()
    {
        $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';

        if ($contentType === 'Application/json') {
            // get and decode new tentacle form content
            $content = trim(file_get_contents("php://php"));
            $decoded = json_decode($content, true);
            // get form content as variables
            extract($decoded);

            $error = [];

            !$krakenId ? $error["kraken-id"] = 'Il manque l\'ID du kraken' : $krakenId = (int) $krakenId;

            !$name ? $error["name"] = 'Il faut entrer un nom' : $name = htmlspecialchars($name);

            !$lifePoints ? $error["life-points"] = 'Il manque le nombre de points de vie du kraken' : $lifePoints = (int) $lifePoints;

            !$force ? $error["force"] = 'Il manque la force du kraken' : $force = (int) $force;

            !$dextetity ? $error["dextetity"] = 'Il manque la dextérité du kraken' : $dextetity = (int) $dextetity;

            !$constitution ? $error["constitution"] = 'Il manque la constitution du kraken' : $constitution = (int) $constitution;

            if (count($error) !== 0) {
                $response = array(
                    'response' => 'not ok',
                    'errors' => $error,
                    'errorMessage' => 'Il y a des erreurs dans le formulaire'
                );
            }
            else {
                $tentacleModel = new TentacleModel();
                $isTentacleSaved = $tentacleModel->add($krakenId, $name, $lifePoints, $force, $dexterity, $constitution);

                if (!$isTentacleSaved) {
                    $response = array(
                        'response' => 'not ok',
                        'errorMessage' => 'Il y a eu un problème pendant l\'enregistrement en base de données'
                    );
                }
                else {            
                    $tentacleModel = new TentacleModel();
                    $tentacles = $tentacleModel->getAllbyKrakenId($krakenId);

                    $tentacleHtml = $this->twig->render('partial/tentacles-infos.html.twig', [
                        "tentacles" => $tentacles
                    ]);

                    $response = array(
                        'response' => 'ok',
                        'message' => 'Tentacule enregistré',
                        'tentacleHtml' => $tentacleHtml
                    );
                }
            }
            echo json_encode($response);
        }
    }
}