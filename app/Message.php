<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\StorageFactory as Store;

/**
 * Class Message
 * @package App
 *
 * @property array $fillable
 */
class Message extends StorageDispatcher
{

    protected $fillable = ['name', 'phone', 'message'];

    /**
     * Message constructor.
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        $this->table = 'messages';
        $this->dbStorage = new Store(Store::DB_STORAGE, [
            'table' => $this->table
        ]);
        $this->fileStorage = new Store(Store::FILE_STORAGE, [
            'storagePath' => 'messages'
        ]);
        $this->emailStorage = new Store(Store::EMAIL_STORAGE, [
            'viewPath' => 'emails.message.html',
            'subject' => 'Запрос пользователя сайта Envy test'
        ]);
        parent::__construct($attributes);
    }
}
