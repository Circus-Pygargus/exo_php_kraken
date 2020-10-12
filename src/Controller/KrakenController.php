<?php

namespace App\Controller;


use App\Application\Controller;


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
}