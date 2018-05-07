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
        ],
        'actions' => [
        ]
    ])
@endsection