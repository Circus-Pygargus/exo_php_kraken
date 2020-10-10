<?php

namespace App\Application;


use \Twig_Loader_Filesystem;

use \Twig_Environment;


class Template
{
    private const PATH = "templates";

    /**
     * @var Twig_Loader_Filesystem
     */
    private $loader;


    /**
     * @var Tiwg_Environment
     */
    private $template;


    public function __construct()
    {
        $this->loader = new Twig_Loader_Filesystem((self::PATH));

        $this->template = new Twig_Environment(
            $this->loader,
            array(
                // we don't want cache with twig
                'cache' => false
            )
        );
    }


    public function render (string $path, array $params = []): string
    {
        return $this->template->render(
            $path,
            $params
        );
    }


    public function renderBlock (string $path, string $block, $params = []): string
    {
        $templateLoad = $this->template->load($path);
        return $templateLoad->renderBlock($block, $params);
    }


    public function load (string $path, array $params = [])
    {
        return $this->template->load($path);
    }
}