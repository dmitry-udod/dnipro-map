@extends('layouts.backend')

@section('content')
    @include('admin.common.list', [
        'title' => 'Об\'екти',
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
            ],
            [
                'name' => 'order',
                'title' => 'Порядок',
            ],
            [
                'name' => 'logo',
                'title' => 'Iконка',
                'type' => 'image'
            ],
        ],
        'actions' => [
            'edit',
            'delete',
        ]
    ])
@endsection