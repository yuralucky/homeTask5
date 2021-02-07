<?php


namespace Hillel;


abstract class Model
{


    public static function find($id)
    {

        return 'SELECT * FROM ' . strtolower(Model::getClassName(static::class)) . ' WHERE id=:' . $id;
    }

    private function create()
    {
        $cols = get_object_vars($this);

        $value = array_map(function ($item) {
            return ':' . $item;
        }, array_keys($cols));
        return 'INSERT INTO ' . strtolower(Model::getClassName(static::class)) . '(' . implode(',', array_keys($cols)) . ') 
        VALUES(' . implode(',', $value) . ')';
    }

    public static function getClassName($str)
    {
        $strPlain = explode('\\', $str);
        return end($strPlain);
    }

    private function update($id)
    {
        $cols = get_object_vars($this);

        $value = array_map(function ($item) {
            return "{$item}=:" . $item;
        }, array_keys($cols));
        var_dump($value);
        return 'UPDATE ' . strtolower(Model::getClassName(static::class)) . ' SET ' . implode(',', $value) . ' WHERE id = :' . $id;
    }

    public function save($id = null)
    {
        return $id ? $this->update($id) : $this->create();
    }

    public function delete($id)
    {
        return 'DELETE ' . strtolower(static::class) . ' WHERE id=:' . $id;
    }

}