<?php
namespace Bookshelf\Models;

use Valitron\Validator;
use Lib\MVC4Slim\BaseModel;
use PdoLite\PdoLite;

final class Author extends BaseModel
{
    /**
     * Turn off the created_at & updated_at columns
     * @var boolean
     */
//    public $timestamps = false;

    /**
     * Fields that can be updated via update()
     * @var array
     */
    protected $fillable = ['name', 'biography'];

    public static function all() {
        
        return self::select("authors");
    }

    public static function find_me($author_id) {
        $sql = self::qbSelect("authors", ['where'=>"id=".$author_id]);
        return self::findRow($sql,"obj");
    }
    
    public function books($author_id) {
        
        return self::select("books", ['where'=>"author_id=".$author_id]);
    }

    /**
     * Update author with new data
     *
     * @param  $id arrray $attributes
     * @return null
     */
    public function doUpdate($id, array $attributes = [], array $options = []) {
        
        $validator = $this->getValidator($attributes);
        
        if (!$validator->validate()) {
            $messages = [];
            foreach ($validator->errors() as $fieldName => $errors) {
                $messages[] = current($errors);
            }
            $message = implode("\n", $messages);
            throw new \Exception($message);
        }

        $one = PdoLite::filterBySchema("authors", $attributes);
        return self::update("authors", ['fl'=>$one,'where'=>"id=".$id]);
    }

    /**
     * Retrieve validator for this entity
     *
     * @param  Array $data Data to be validated
     * @return Validator
     */
    public function getValidator($data) {
        
        $validator = new Validator($data);

        $validator->rule('required', 'name');
        $validator->rule('lengthBetween', 'name', 1, 100);

        $validator->labels([
            'name' => 'Name',
        ]);
        
        return $validator;
    }
}
