<?php


namespace App;


/**
 * Class StorageFactory
 * @package App
 *
 * @property object $storage
 */
class StorageFactory
{

    const DB_STORAGE = 'App\\DBStorage';
    const FILE_STORAGE = 'App\\FileStorage';
    const EMAIL_STORAGE = 'App\\EmailStorage';

    protected $storage;

    /**
     * StorageFactory constructor.
     * @param string $storageClass
     * @param array $storageParams
     */
    public function __construct($storageClass = self::DB_STORAGE, $storageParams = [])
    {
        if (class_exists($storageClass)) {
            $this->storage = new $storageClass($storageParams);
        } else {
            $this->storage = new DBStorage($storageParams);
        }
    }

    /**
     * Save data to specified storage
     * @param array $attributes
     * @return mixed
     */
    public function save($attributes)
    {
        return $this->storage->save($attributes);
    }

    /**
     * Get all entries from specified storage
     * @return mixed
     */
    public function findAll()
    {
        return $this->storage->findAll();
    }

    /**
     * Get entry with certain `id` from specified storage
     * @param integer $id
     * @return mixed|null
     */
    public function findOne($id)
    {
        return $this->storage->findOne($id);
    }
}
