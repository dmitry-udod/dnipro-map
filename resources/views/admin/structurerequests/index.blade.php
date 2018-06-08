@extends('layouts.backend')

@section('content')
    @include('admin.common.list', [
        'title' => 'Скарги',
        'hideAddButton' => true,
        'containerClass' => 'container-fluid',
        'fields' => [
            [
                'name' => 'city',
                'title' => 'Miсто',
            ],
            [
                'name' => 'address',
                'title' => 'Адреса',
            ],
            [
                'name' => 'category',
                'title' => 'Категорія',
            ],
            [
                'name' => 'created_at',
                'title' => 'Створено',
            ],
            [
                'name' => 'name',
                'title' => 'ПІБ',
            ],
            [
                'name' => 'phone',
                'title' => 'Телефон',
            ],
            [
                'name' => 'email',
                'title' => 'E-mail ',
            ],
            [
                'name' => 'processed',
                'title' => 'Оброблено',
                'raw' => true,
            ],
            [
                'name' => 'processed_at',
                'title' => 'Дата обробки',
                'raw' => true,
            ],
            [
                'name' => 'photo_previews',
                'title' => 'Фото',
                'raw' => true
            ],
        ],
        'actions' => [
        ]
    ])
@endsection