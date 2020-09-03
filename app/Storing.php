<?php


namespace App;


/**
 * Interface Storing
 * @package App
 */
interface Storing
{
    /**
     * Save data to specified storage
     * @param array $attributes
     * @return bool
     */
    public function save(array $attributes);

    /**
     * Get all entries from specified storage
     * @return array
     */
    public function findAll();

    /**
     * Get entry with certain `id` from specified storage
     * @param integer $id
     * @return array
     */
    public function findOne(int $id);
}
