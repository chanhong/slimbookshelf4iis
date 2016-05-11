<?php
namespace Bookshelf\Models;

use Lib\MVC4Slim\BaseModel;

final class Book extends BaseModel
{
    public static function all()
    {
        return self::select("books");
    }
    
    // not seem to be used?
    public function xauthor()
    {
//        return $this->belongsTo('Bookshelf\Models\Author');
    }
    
}
