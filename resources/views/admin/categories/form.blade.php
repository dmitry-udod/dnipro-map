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
                'name' => 'city',
                'title' => 'Miсто',
                'type' => 'select',
                'values' => $user->cities(),
            ],
            [
                'name' => 'is_active',
                'title' => 'Активна',
                'type' => 'checkbox',
            ],

        ],
        'entity' => empty($entity) ? new $model : $entity,
    ])
@endsection