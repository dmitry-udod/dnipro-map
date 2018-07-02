@component('mail::message')
# Дякуємо за інформацію!

Вашу заявку № __{{ $claim->uuid }}__ розглянуто.

{{ $claim->response }}

З повагою,<br>
{{ config('app.name') }}
@endcomponent
