<?php

namespace App\Controller;


use App\Application\Controller;

use App\Entity\Tentacle;


class TentacleController extends Controller
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
            $content = trim(file_get_contents("php://input"));
            $decoded = json_decode($content, true);
            // get form content as variables
            extract($decoded);

            $error = [];

            !$krakenId ? $error["kraken-id"] = 'Il manque l\'ID du kraken' : $krakenId = (int) $krakenId;
            !$name ? $error["name"] = 'Il faut entrer un nom' : $name = htmlspecialchars($name);

            !$lifePoints ? $error["life-points"] = 'Il manque le nombre de points de vie du kraken' : $lifePoints = (int) $lifePoints;

            !$force ? $error["force"] = 'Il manque la force du kraken' : $force = (int) $force;

            !$dexterity ? $error["dexterity"] = 'Il manque la dextérité du kraken' : $dexterity = (int) $dexterity;

            !$constitution ? $error["constitution"] = 'Il manque la constitution du kraken' : $constitution = (int) $constitution;

            if (count($error) !== 0) {
                $response = array(
                    'response' => 'not ok',
                    'errors' => $error,
                    'errorMessage' => 'Il y a des erreurs dans le formulaire'
                );
            }
            else {
                $tentacleModel = new Tentacle();
                $isTentacleSaved = $tentacleModel->add($krakenId, $name, $lifePoints, $force, $dexterity, $constitution);

                if (!$isTentacleSaved) {
                    $response = array(
                        'response' => 'not ok',
                        'errorMessage' => 'Il y a eu un problème pendant l\'enregistrement en base de données'
                    );
                }
                else {            
                    $tentacleModel = new Tentacle();
                    $tentacles = $tentacleModel->getAllbyKrakenId($krakenId);

                    $tentacleHtml = $this->twig->render('partial/tentacles-infos.html.twig', [
                        "tentacles" => $tentacles
                    ]);

                    $removableTentaclesHtml = $this->twig->render('partial/tentacles-delete.html.twig', [
                        "tentacles" => $tentacles
                    ]);

                    $response = array(
                        'response' => 'ok',
                        'message' => 'Tentacule enregistré',
                        'tentacleHtml' => $tentacleHtml,
                        'removableTentaclesHtml' => $removableTentaclesHtml
                    );
                }
            }
            echo json_encode($response);
        }
    }


    /**
     * Route '/tentacle/delete'
     * 
     * Delete a tentacle
     */
    public function delete ()
    {
        $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';

        if ($contentType === "Application/json") {
            // get and decode new kraken form content
            $content = trim(file_get_contents("php://input"));
            $decoded = json_decode($content, true);
            // get form content as variables ($krakenId and $tentacleId)
            extract($decoded);

            $tentacleModel = new Tentacle();

            // get kraken ID
            $tentacle = $tentacleModel->getById($tentacleId);

            // delete tentacle
            $istentalceDeleted = $tentacleModel->delete($tentacleId);

            if (!$istentalceDeleted) {
                $response = array(
                    'response' => 'not ok',
                    'errorMessage' => 'Il y a eu un problème pendant la suppression du tentacule en BDD'
                );
            }
            else {
                // get remaining tentacles
                $tentacles = $tentacleModel->getAllbyKrakenId($tentacle["kraken_id"]);

                $tentacleHtml = $this->twig->render('partial/tentacles-infos.html.twig', [
                    "tentacles" => $tentacles
                ]);
                $removableTentaclesHtml = $this->twig->render('partial/tentacles-delete.html.twig', [
                    "tentacles" => $tentacles
                ]);

                $response = array(
                    'response' => 'ok',
                    'message' => 'Tentacule enregistré',
                    'tentacleHtml' => $tentacleHtml,
                    'removableTentaclesHtml' => $removableTentaclesHtml
                );
            }
            echo json_encode($response);
        }
    }
}