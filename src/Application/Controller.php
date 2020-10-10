<?php

namespace App\Application;


use App\Application\Template;


class Controller
{
    /**
     * @var Template
     */
    protected $twig;


    public function __construct()
    {
        $this->twig = new Template();
    }
}