<?php


namespace App;


interface Storing
{
    public function save($model);

    public function findAll();

    public function findOne($id);
}
