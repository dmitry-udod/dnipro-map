@extends('layouts.backend')

@section('content')
    @include('admin.common.list', [
        'title' => 'Категорії',
        'fields' => [
            [
                'name' => 'name',
                'title' => 'Назва',
            ],
            [
                'name' => 'city',
                'title' => 'Miсто',
            ],
            [
                'name' => 'active',
                'title' => 'Активна',
                'type' => 'bool',
            ],
            [
                'name' => 'order',
                'title' => 'Порядок',
            ],
        ],
        'actions' => [
            'edit',
            'delete',
        ]
    ])
@endsection