<?php

namespace Bookshelf\Controllers;

use Slim\Views\Twig;
use Slim\Router;
use Slim\Flash\Messages as FlashMessages;
use Bookshelf\Models\Author;
use Bookshelf\Models\Book;
use Lib\BaseController;

final class BookController extends BaseController
{
    public function __construct(Twig $view, Router $router, FlashMessages $flash, Array $settings) {
        parent::__construct($view, $router, $flash, $settings);
    }
    
    public function listBooks($request, $response, $params)
    {
        return $this->view->render($response, 'book/list.twig',
            array_merge($this->settings['tpl'], [
                'books' => Book::all(),
            ])
        );
    }
}
