@php(extract($attributes))
{{--
    <h3> Запрос от пользователя {{ $name or 'неизвестный'}}</h3>
    TODO or работает как логическое или, хотя так быть не должно
    https://laravel.ru/docs/v5/blade
--}}
<h3> Запрос от пользователя {{ !empty($name) ? $name : 'неизвестный'}}</h3>
<p>Телефон: {{ !empty($phone) ? $phone : 'не указан'}}</p>
<h4>Текст вопроса:</h4>
<p>{{ !empty($message) ? $message : 'отсутствует'}}</p>
