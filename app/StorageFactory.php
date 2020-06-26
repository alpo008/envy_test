<?php


namespace App;


class StorageFactory
{

    const DB_STORAGE = 'App\\DBStorage';
    const FILE_STORAGE = 'App\\FileStorage';
    //const EMAIL_STORAGE = 'file';

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

    public function save($attributes)
    {
        return $this->storage->save($attributes);
    }

    public function findAll()
    {
        return $this->storage->findAll();
    }

    /**
     * @param integer $id
     * @return mixed|null
     */
    public function findOne($id)
    {
        return $this->storage->findOne($id);
    }
}
