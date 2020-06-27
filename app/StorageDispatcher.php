<?php


namespace App;


use App\StorageFactory as Store;
use Illuminate\Database\Eloquent\Model;

/**
 * Class StorageDispatcher
 * @package App
 *
 * @property DBStorage $dbStorage
 * @property FileStorage $fileStorage
 * @property EmailStorage $emailStorage
 */
abstract class StorageDispatcher extends Model
{
    protected $dbStorage;
    protected $fileStorage;
    protected $emailStorage;

    /**
     * Переопределение БД (DB overriding)
     *
     * @param string $database
     * @param string $table
     *
     * @example
     * $model = new Message($attributes);
     * $model->setDbStorage('pgsql', 'pg_messages');
     * $model->saveToDefaultDb();
     */
    public function setDbStorage($database, $table)
    {
        $this->dbStorage = new Store(Store::DB_STORAGE,
            compact('database', 'table')
        );
    }

    /**
     * @return bool
     */
    public function saveToDb()
    {
        return $this->dbStorage->save($this->getAttributes());
    }

    /**
     * @return bool
     */
    public function saveToFile()
    {
        return $this->fileStorage->save($this->getAttributes());
    }

    /**
     * @return bool
     */
    public function sendEmail()
    {
        return $this->emailStorage->save($this->getAttributes());
    }

    /**
     * @return array
     */
    public function findAllInDb()
    {
        return $this->dbStorage->findAll();
    }

    /**
     * @return array
     */
    public function findAllInFileStorage()
    {
        return $this->fileStorage->findAll();
    }

    /**
     * @param integer $id
     * @return array
     */
    public function findOneInDb($id)
    {
        return $this->dbStorage->findOne($id);
    }

    /**
     * @param integer $id
     * @return array
     */
    public function findOneInFileStorage($id)
    {
        return $this->fileStorage->findOne($id);
    }
}
