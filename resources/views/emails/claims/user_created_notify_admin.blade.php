@component('mail::message')
# СКАРГА

- ПІБ: {{ $claim->name }}
- Контактний телефон: {{ $claim->phone }}
- Адреса електронної пошти: {{ $claim->email }}
- Категорія проблеми: {{ $claim->category }}
- Опис проблеми: {{ $claim->description }}
- Скаргу зареєстровано у системі за номером: `{{ $claim->uuid }}`

@component('mail::button', ['url' => route('admin.claims.edit', [$city->slug, $claim->id])])
    Опрацювати скаргу
@endcomponent

З повагою,<br>
{{ config('app.name') }}
@endcomponent