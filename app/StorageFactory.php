<?php


namespace App;


/**
 * Class StorageFactory
 * @package App
 *
 * @property object $storage
 */
class StorageFactory implements Storing
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
     * @inheritDoc
     */
    public function save(array $attributes) :bool
    {
        return $this->storage->save($attributes);
    }

    /**
     * @inheritDoc
     */
    public function findAll() :array
    {
        return $this->storage->findAll();
    }

    /**
     * @inheritDoc
     */
    public function findOne(int $id) :array
    {
        return $this->storage->findOne($id);
    }
}
