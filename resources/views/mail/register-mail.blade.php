@component('mail::message')
# Регистрация

Ваш Пароль:
<strong>{{ $password }}</strong>


Запомните его!

Спасбо, ваш {{ config('app.name') }}
@endcomponent
