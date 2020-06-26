<?php


namespace App;


use Illuminate\Support\Facades\Mail;

/**
 * Class EmailStorage
 * @package App
 *
 * @property string $viewPath
 * @property string $subject
 */
class EmailStorage implements Storing
{

    const DEFAULT_VIEW_PATH = 'emails.default.html';
    const DEFAULT_SUBJECT = 'Запрос с сайта Envy test';

    protected $viewPath;
    protected $subject;

    /**
     * EmailStorage constructor.
     * @param array $params
     */
    public function __construct(array $params = [])
    {
        $this->viewPath = $params['viewPath'] ?? $this::DEFAULT_VIEW_PATH;
        $this->subject = $params['subject'] ?? $this::DEFAULT_SUBJECT;
    }

    /**
     * Save email to admin or whatever
     * @param array $attributes
     * @return bool
     */
    public function save ($attributes)
    {
        if (empty($attributes) || !is_array($attributes)) {
            return false;
        }
        try {
            Mail::send($this->viewPath, compact('attributes'), function ($mail) {
                $mail->subject($this->subject);
            });
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * @return mixed|null
     */
    public function findAll()
    {
        return null;
    }

    /**
     * @param integer $id
     * @return mixed|null
     */
    public function findOne($id)
    {
        return null;
    }
}
