<?php

namespace Bookshelf\Controllers;

use Slim\Views\Twig;
use Slim\Router;
use Slim\Flash\Messages as FlashMessages;
use Bookshelf\Models\Author;
use Lib\MVC4Slim\BaseController;

final class AuthorController extends BaseController
{
    
    public function listAuthors($request, $response)
    {
        return $this->view->render($response, 'author/list.twig', 
            array_merge($this->settings['tpl'], [
                'authors' => Author::all(),
            ])
        );
    }

    public function listBooks($request, $response, $params)
    {
        if (isset($params['author_id'])) {
            
            $author = new Author();
            $author_found = $author->find_me((int)$params['author_id']);
            if (!$author_found) {
                // not found
                throw new \Exception("Author {$params['author_id']} not found");
            }
            $books = $author->books((int)$params['author_id']);
        }
        
        return $this->view->render($response, 'author/books.twig', 
            array_merge($this->settings['tpl'], [
                'author' => $author_found,
                'books' => $books,
            ])
        );
    }

    public function editAuthor($request, $response, $params)
    {
        $author = new Author();
        $author_found = $author->find_me((int)$params['author_id']);
        if (!$author_found) {
            $uri = $request->getUri()->withQuery('')->withPath($this->router->pathFor('list-authors'));
            return $response->withRedirect((string)$uri);
        }

        $errors = null;
        if ($request->isPost()) {
            
            if ($request->getAttribute('csrf_status') === false) {
                $errors['form'] = 'CSRF faiure';
            } else {
                
                $data = $request->getParsedBody();
                $validator = $author->getValidator($data);
                
                if ($validator->validate()) {
                    $author->doUpdate($author_found->id, $data);

                    $uri = $request->getUri()->withQuery('')->withPath($this->router->pathFor('author', ['author_id' => $author_found->id]));

                    $this->flash->addMessage('message', 'Author updated');
                    print_r($uri);

                    return $response->withRedirect((string)$uri);
                } else {
                    $errors = $validator->errors();
                }
            }
        }

        return $this->view->render($response, 'author/edit.twig', 
            array_merge($this->settings['tpl'], [
                'author' => $author_found,
                'errors' => $errors,
                
                'csrf' => [
                            'name' => $request->getAttribute('csrf_name'),
                            'value' => $request->getAttribute('csrf_value'),
                        ],
                        
            ])
        );
    }
}
