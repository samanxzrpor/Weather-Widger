<?php
namespace App\Models\Contracts;



abstract class BaseModelAbstract implements CrudInterface
{

    protected $connection;
    protected $primaryKey = 'ID';
    protected $tableName ;
    protected $pageSize = 10;
    public $attributes = [];

    public function getAttributes(string $key = null)
    {
        if(is_null($key))
            return $this->attributes;

        if(!array_key_exists($key, $this->attributes))
            return null;

        return $this->attributes[$key];
    }

    public function __get(string $name)
    {
        if (array_key_exists($name, $this->attributes)) {
			return $this->attributes[$name];
		}
    }

    public function __set($name , $value)
    {
        $this->attributes[$name] = $value;
    }
}