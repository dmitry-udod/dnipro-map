@extends('layouts.backend')

@section('content')
    @include('admin.common.list', [
        'title' => 'Мiста',
        'fields' => [
            [
                'name' => 'name',
                'title' => 'Назва',
            ],
            [
                'name' => 'slug',
                'title' => 'Slug',
            ],
            [
                'name' => 'created_at',
                'title' => 'Дата створення',
            ],
        ],
        'actions' => [
            'edit',
            'delete',
        ]
    ])
@endsection