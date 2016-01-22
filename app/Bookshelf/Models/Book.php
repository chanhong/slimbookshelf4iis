<?php
namespace Bookshelf\Models;

use Illuminate\Database\Eloquent\Model;
use MVC4Slim\BaseModel;

final class Book extends BaseModel
{
    public function author()
    {
        return $this->belongsTo('Bookshelf\Models\Author');
    }
}
