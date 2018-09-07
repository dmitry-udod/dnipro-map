@component('mail::message')
# Попередній запис

- Назва: {{ $record->structure_name }}
- ПІБ дитини: {{ $record->name }}
- Вік дитини: {{ $record->age }}
- ПІБ дорослого: {{ $record->parent_name }}
- Телефон батьків: {{ $record->parent_phone }}
- Примітка: {{ $record->notes }}
- Скаргу зареєстровано у системі за номером: `{{ $record->uuid }}`

@component('mail::button', ['url' => route('admin.previousrecords.edit', [$city->slug, $record->id])])
    Переглянути
@endcomponent

З повагою,<br>
{{ config('app.name') }}
@endcomponent