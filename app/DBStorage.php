<?php


namespace App;


use Illuminate\Database\Connection;
use Illuminate\Support\Facades\DB;

/**
 * Class DBStorage
 * @package App
 *
 * @property Connection $database
 * @property string $table
 */
class DBStorage implements Storing
{
    const DEFAULT_DB = 'mysql';

    const DEFAULT_TABLE = 'messages';

    protected $database;

    protected $table;

    /**
     * DBStorage constructor.
     * @param array $params
     */
    public function __construct(array $params)
    {
        $database = $params['database'] ?? $this::DEFAULT_DB;
        $this->database = DB::connection($database);
        $this->table = $params['table'] ?? $this::DEFAULT_TABLE;
    }

    /**
     * Save entry to the specified table
     * @param array $attributes
     * @return bool
     */
    public function save(array $attributes) :bool
    {
        return $this->database->table($this->table)->insert($attributes);
    }

    /**
     * Get all entries from the specified table
     * @return array
     */
    public function findAll() :array
    {
        if ($result = $this->database->table($this->table)->get()->all()) {
            return array_map('get_object_vars', $result);
        }
        return [];
    }

    /**
     * Get entry by its `id`
     * @inheritDoc
     */
    public function findOne(int $id)
    {
        if ($result = $this->database->table($this->table)->where('id', $id)->first()) {
            return get_object_vars($result);
        }
        return [];
    }
}
