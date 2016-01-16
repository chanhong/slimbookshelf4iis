<?php

namespace Bookshelf;

use Slim\Views\Twig;
use Slim\Router;
use Slim\Flash\Messages as FlashMessages;
use Bookshelf\Models\Author;
use Bookshelf\Models\Book;

final class BookController
{
    private $view;
    private $router;
    private $flash;
    private $pubdir;
    private $layout;

    public function __construct(Twig $view, Router $router, FlashMessages $flash)
    {
        $this->view = $view;
        $this->router = $router;
        $this->flash = $flash;
        if (defined('PUBDIR')) $this->pubdir = '/'.constant("PUBDIR"); 
        if (defined('LAYOUT')) $this->layout = constant("LAYOUT");               
    }

    public function listBooks($request, $response, $params)
    {
        return $this->view->render($response, 'bookshelf/book/list.twig', [
            'books' => Book::all(),
            'public'=> $this->pubdir,  
            'layout'=> $this->layout,
        ]);
    }
}
