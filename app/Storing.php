<?php


namespace App;


/**
 * Interface Storing
 * @package App
 */
interface Storing
{
    public function save($model);

    public function findAll();

    public function findOne($id);
}
