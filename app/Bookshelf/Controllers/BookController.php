<?php

namespace Bookshelf\Controllers;

use Slim\Views\Twig;
use Slim\Router;
use Slim\Flash\Messages as FlashMessages;
use Bookshelf\Models\Author;
use Bookshelf\Models\Book;
use Lib\MVC4Slim\BaseController;
use PdoLite\PdoLite;

final class BookController extends BaseController
{

    public function listBooks($request, $response, $params) {

        return $this->view->render($response, 'book/list.twig',
            array_merge($this->settings['tpl'], [
                'books' => Book::all(),
            ])
        );
    }
}
