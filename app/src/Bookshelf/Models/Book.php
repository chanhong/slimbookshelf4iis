<?php
namespace Bookshelf\Models;

use Illuminate\Database\Eloquent\Model;

final class Book extends Model
{
    public function author()
    {
        return $this->belongsTo('Bookshelf\Models\Author');
    }
}
