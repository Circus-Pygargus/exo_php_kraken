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
}