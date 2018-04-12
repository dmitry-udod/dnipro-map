@extends('layouts.backend')

@section('content')
    @include('admin.common.form', [
        'title' => 'Редагувати адміністратора',
        'fields' => [
            [
                'name' => 'name',
                'title' => 'Ім\'я',
            ],
            [
                'name' => 'email',
                'title' => 'E-mail',
            ],
            [
                'name' => 'password',
                'title' => 'Пароль',
            ],
        ],
        'entity' => '',
    ])
@endsection