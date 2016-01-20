<?php

namespace Bookshelf\Lib;

use Slim\Views\Twig;
use Slim\Router;
use Slim\Flash\Messages as FlashMessages;

class BaseController
{
    public $view;
    public $router;
    public $flash;
    public $settings;
    
    private $pubdir;
    private $selected_layout;

    public function __construct(Twig $view, Router $router, FlashMessages $flash, Array $settings)
    {
        $this->view = $view;
        $this->router = $router;
        $this->flash = $flash;
        if (!empty($settings['pubdir'])) $this->pubdir = '/'. $settings['pubdir'];
        if (!empty($settings['selected_layout'])) $this->selected_layout = $settings['selected_layout'];
        $this->settings['tpl'] = ['pubdir'=> $this->pubdir,'selected_layout'=> $this->selected_layout];
    }

}
