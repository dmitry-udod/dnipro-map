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
                'name' => 'structure_name',
                'title' => 'Назва',
            ],
            [
                'name' => 'created_at',
                'title' => 'Створено',
            ],
            [
                'name' => 'name',
                'title' => 'ПІБ дитини',
            ],
            [
                'name' => 'parent_name',
                'title' => 'ПІБ дорослого',
            ],
            [
                'name' => 'parent_phone',
                'title' => 'Телефон батьків',
            ],
            [
                'name' => 'notes',
                'title' => 'Примітка',
            ],
            [
                'name' => 'processed',
                'title' => 'Оброблено',
                'raw' => true,
            ],
            [
                'name' => 'processed_by',
                'title' => 'Хто обробив',
            ],
        ],
        'actions' => [
            'process'
        ]
    ])
@endsection