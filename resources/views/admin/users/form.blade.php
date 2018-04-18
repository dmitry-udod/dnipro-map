@extends('layouts.backend')

@section('content')
    @include('admin.common.form', [
        'title' => 'Редагувати адміністратора',
        'fields' => [
            [
                'name' => 'name',
                'title' => 'Ім\'я',
                'required' => true,
            ],
            [
                'name' => 'email',
                'title' => 'E-mail',
                'required' => true,
            ],
            [
                'name' => 'password',
                'title' => 'Пароль',
                'required' => true,
            ],
            [
                'name' => 'roles',
                'title' => 'Роль',
                'type'  => 'select',
                'values' => $user->rolesForDropDown(),
            ],
            [
                'name' => 'cities',
                'title' => 'Мiсто',
                'type'  => 'select',
                'values' => $user->citiesForDropDown(),
            ],
        ],
        'entity' => empty($entity) ? new $model : $entity,
    ])
@endsection