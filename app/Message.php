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
 * @property DBStorage $defaultDBStorage
 * @property FileStorage $fileStorage
 * @property EmailStorage $emailStorage
 */
class Message extends Model
{
    protected $table = 'messages';
    protected $fillable = ['name', 'phone', 'message'];
    protected $defaultDBStorage;
    protected $fileStorage;
    protected $emailStorage;

    /**
     * Message constructor.
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        $this->defaultDBStorage = new Store(Store::DB_STORAGE, [
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
     * @return bool
     */
    public function saveToDefaultDb()
    {
        return $this->defaultDBStorage->save($this->getAttributes());
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
    public function findAllInDefaultDB()
    {
        return $this->defaultDBStorage->findAll();
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
    public function findOneInDefaultDB($id)
    {
        return $this->defaultDBStorage->findOne($id);
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
