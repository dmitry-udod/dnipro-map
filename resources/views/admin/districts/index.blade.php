@extends('layouts.backend')

@section('content')
    @include('admin.common.list', [
        'title' => 'Райони',
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
                'title' => 'Активний',
            ],
        ],
        'actions' => [
            'edit',
            'delete',
        ]
    ])
@endsection