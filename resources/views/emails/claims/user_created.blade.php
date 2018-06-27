@component('mail::message')
# Дякуємо!

Ваша скарга прийнята і буде розглянута найближчим часом.

Результат обробки Ви отримаєте на вказану електронну пошту

- ПІБ: {{ $claim->name }}
- Контактний телефон: {{ $claim->phone }}
- Опис проблеми: {{ $claim->description }}
- Скаргу зареєстровано у системі за номером: `{{ $claim->uuid }}`

@component('mail::button', ['url' => route('claim_check_status', [$city->slug, $claim->uuid])])
Перевiрити статус скарги
@endcomponent

З повагою,<br>
{{ config('app.name') }}
@endcomponent
