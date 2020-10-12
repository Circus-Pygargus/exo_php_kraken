<?php

namespace App\Controller;


use App\Application\Controller;

use App\Entity\Kraken;


class KrakenController extends Controller
{
    /**
     * route '/'
     */
    public function index ()
    {
        return $this->twig->render('index.html.twig');
    }


    /**
     * route '/kraken/new'
     * 
     * user wants to create a new kraken, send a kraken creation form
     */
    public function new ()
    {
        return $this->twig->render('kraken_new/index.html.twig');
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
                    $response = array(
                        'reponse' => 'ok',
                        'message' => 'Kraken enregistré !'
                    );
                }
            }
            echo json_encode($response);
        }
    }
}