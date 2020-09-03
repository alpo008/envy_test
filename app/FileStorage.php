<?php


namespace App;


use Illuminate\Support\Facades\Storage;

/**
 * Class FileStorage
 * @package App
 *
 * @property string $storagePath
 */
class FileStorage implements Storing
{
    const DEFAULT_PATH = 'messages';

    protected $storagePath;

    /**
     * FileStorage constructor.
     * @param array $params
     */
    public function __construct(array $params = [])
    {
        $this->storagePath = $params['storagePath'] ?? $this::DEFAULT_PATH;
        $this->storagePath .= '.json';
    }

    /**
     * Save entry to the file
     * @inheritDoc
     */
    public function save (array $attributes) :bool
    {
        $entries = $this->findAll();
        $id = !empty($entries) ? max(array_keys($entries)) + 1 : 1;
        $created_at = date('Y-m-d H:i:s');
        $attributes = array_merge($attributes, compact('id', 'created_at'));
        $entries[$id] =  $attributes;
        $jsonOptions = JSON_UNESCAPED_UNICODE |  JSON_PRETTY_PRINT;
        return Storage::put($this->storagePath, json_encode($entries, $jsonOptions));
    }

    /**
     * Get all entries from the storage file
     * @inheritDoc
     */
    public function findAll() :array
    {
        $entries = [];
        try {
            $entries = json_decode(Storage::get($this->storagePath), true) ?? [];
        } catch (\Exception $e) {
        }
        return $entries;
    }

    /**
     * Get entry by its `id`
     * @inheritDoc
     */
    public function findOne(int $id) :array
    {
        return $this->findAll()[$id] ?? [];
    }
}
