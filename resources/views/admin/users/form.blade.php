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
            [
                'name' => 'roles',
                'title' => 'Роль',
            ],
            [
                'name' => 'cities',
                'title' => 'Мiсто',
            ],
            [
                'name' => 'categories',
                'title' => 'Категорiя',
            ],
        ],
        'entity' => empty($entity) ? new $model : $entity,
    ])
@endsection