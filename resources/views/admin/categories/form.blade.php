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
                'name' => 'order',
                'title' => 'Порядок',
            ],

        ],
        'entity' => empty($entity) ? new $model : $entity,
    ])
@endsection