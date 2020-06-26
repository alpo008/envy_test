<?php

namespace App\Http\Controllers\Api\V0;

use App\Message;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MessagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Message::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'formData.name' => 'required|between:3, 63|regex:/^[a-zA-Zа-яА-ЯёЁ\s]+$/',
            'formData.phone' => 'required|between:7,31|regex:/^\+?[\d\s\-]+$/',
            'formData.message' => 'required|between:5,65535'
        ], $this->getValidationMessages());
        $messageAttributes = $request->post('message');
        $storageType = $request->post('storage');
        if (!empty($messageAttributes)) {
            return new Message($messageAttributes);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    protected function getValidationMessages()
    {
        return  [
            'required' => 'Поле обязательно для заполнения.',
            'between' => 'Количество символов должно быть между :min и :max.',
            'regex' => 'Используются недопустимые для данного поля символы.',
            'max' => 'Количество символов не должно превышать :max.',
        ];
    }
}
