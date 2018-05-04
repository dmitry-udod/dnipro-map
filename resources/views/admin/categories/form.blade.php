@extends('layouts.backend')

@section('content')
    @include('admin.common.form', [
        'title' => 'Редагування категорii',
        'fields' => [
            [
                'name' => 'name',
                'title' => 'Назва',
                'required' => true,
            ],
            [
                'name' => 'city_id',
                'title' => 'Miсто',
                'type' => 'select',
                'values' => $user->citiesForDropDown(),
            ],
            [
                'name' => 'is_active',
                'title' => 'Активна',
                'type' => 'checkbox',
            ],
            [
                'name' => 'user_can_create_claims',
                'title' => 'Користувач може створювати скарги',
                'type' => 'checkbox',
            ],
                        [
                'name' => 'order',
                'title' => 'Порядок',
            ],
            [
                'name' => 'logo',
                'title' => 'Iконка',
                'type' => 'file',
                'note' => 'Файл формату SVG',
            ],

        ],
        'entity' => empty($entity) ? new $model : $entity,
    ])
@endsection