@extends('layouts.backend')

@section('content')
    @include('admin.common.list', [
        'title' => 'Адміністратори',
        'fields' => [
            [
                'name' => 'name',
                'title' => "Iм'я",
            ],
            [
                'name' => 'email',
                'title' => 'Email',
            ],
            [
                'name' => 'role',
                'title' => 'Роль',
            ],
            [
                'name' => 'city',
                'title' => 'Мiсто',
            ],
        ],
        'actions' => [
            'edit',
            'delete',
        ],
    ])
@endsection