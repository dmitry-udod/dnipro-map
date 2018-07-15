@component('mail::message')
# Дякуємо!

Ваш запит прийнято і буде розглянуто найближчим часом.

Результат обробки Ви отримаєте на вказану електронну пошту.

- ПІБ: {{ $entity->name }}
- Скаргу зареєстровано у системі за номером: `{{ $entity->uuid }}`

З повагою,<br>
{{ config('app.name') }}
@endcomponent
