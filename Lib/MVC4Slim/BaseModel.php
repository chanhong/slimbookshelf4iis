<?php
namespace Lib\MVC4Slim;

use Valitron\Validator;
use PdoLite\PdoLite;

class BaseModel extends PdoLite
{
    /**
     * Turn off the created_at & updated_at columns
     * @var boolean
     */
    public $timestamps = false;

    
}
