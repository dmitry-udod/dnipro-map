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
                'name' => 'category',
                'title' => 'Категорія',
            ],
            [
                'name' => 'color',
                'title' => 'Колір об\'єкту',
            ],
            [
                'name' => 'active',
                'title' => 'Активна',
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