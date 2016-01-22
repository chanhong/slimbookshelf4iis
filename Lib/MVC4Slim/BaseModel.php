<?php
namespace MVC4Slim;

use Illuminate\Database\Eloquent\Model;
use Valitron\Validator;

class BaseModel extends Model
{
    /**
     * Turn off the created_at & updated_at columns
     * @var boolean
     */
    public $timestamps = false;

}
