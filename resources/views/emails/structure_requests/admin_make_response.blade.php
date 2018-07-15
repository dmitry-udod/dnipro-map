@component('mail::message')
# Дякуємо за інформацію!

Вашу заявку № __{{ $entity->uuid }}__ розглянуто.

{{ $entity->response }}

З повагою,<br>
{{ config('app.name') }}
@endcomponent
