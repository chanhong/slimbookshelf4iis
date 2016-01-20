<?php
// Route configuration

$app->get('/', 'Bookshelf\Controllers\AuthorController:listAuthors')->setName('list-authors');
$app->map(['GET', 'POST'], '/authors/{author_id:[0-9]+}/edit', 'Bookshelf\Controllers\AuthorController:editAuthor')->setName('edit-author');
$app->get('/authors/{author_id:[0-9]+}', 'Bookshelf\Controllers\AuthorController:listBooks')->setName('author');
$app->get('/books', 'Bookshelf\Controllers\BookController:listBooks')->setName('list-books');
