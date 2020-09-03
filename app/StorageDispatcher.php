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
    public function setDbStorage(string $database, string $table) :void
    {
        $this->dbStorage = new Store(Store::DB_STORAGE,
            compact('database', 'table')
        );
    }

    /**
     * @return bool
     */
    public function saveToDb() :bool
    {
        return $this->dbStorage->save($this->getAttributes());
    }

    /**
     * @return bool
     */
    public function saveToFile() :bool
    {
        return $this->fileStorage->save($this->getAttributes());
    }

    /**
     * @return bool
     */
    public function sendEmail() :bool
    {
        return $this->emailStorage->save($this->getAttributes());
    }

    /**
     * @return array
     */
    public function findAllInDb() :array
    {
        return $this->dbStorage->findAll();
    }

    /**
     * @return array
     */
    public function findAllInFileStorage() :array
    {
        return $this->fileStorage->findAll();
    }

    /**
     * @param integer $id
     * @return array
     */
    public function findOneInDb(int $id)
    {
        return $this->dbStorage->findOne($id);
    }

    /**
     * @param integer $id
     * @return array
     */
    public function findOneInFileStorage(int $id) :array
    {
        return $this->fileStorage->findOne($id);
    }
}
