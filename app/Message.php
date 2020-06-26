<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\StorageFactory as Store;

/**
 * Class Message
 * @package App
 *
 * @property string $table
 * @property array $fillable
 * @property DBStorage $dbStorage
 * @property FileStorage $fileStorage
 * @property EmailStorage $emailStorage
 */
class Message extends Model
{
    protected $table = 'messages';
    protected $fillable = ['name', 'phone', 'message'];
    protected $dbStorage;
    protected $fileStorage;
    protected $emailStorage;

    /**
     * Message constructor.
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        $this->dbStorage = new Store(Store::DB_STORAGE, [
            'table' => $this->table
        ]);
        $this->fileStorage = new Store(Store::FILE_STORAGE, [
            'storagePath' => $this->table
        ]);
        $this->emailStorage = new Store(Store::EMAIL_STORAGE, [
            'viewPath' => 'emails.message.html',
            'subject' => 'Запрос пользователя сайта Envy test'
        ]);
        parent::__construct($attributes);
    }

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
