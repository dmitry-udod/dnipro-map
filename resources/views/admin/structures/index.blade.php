@extends('layouts.backend')

@section('content')
    @include('admin.common.list', [
        'title' => 'Об\'екти',
        'fields' => [
            [
                'name' => 'photo_previews',
                'title' => 'Фото',
                'raw' => true
            ],
            [
                'name' => 'city',
                'title' => 'Miсто',
            ],
            [
                'name' => 'address',
                'title' => 'Адреса',
            ],
            [
                'name' => 'name',
                'title' => 'Назва',
            ],
            [
                'name' => 'category',
                'title' => 'Категорія',
            ],
            [
                'name' => 'type',
                'title' => 'Вид діяльності',
            ],
            [
                'name' => 'active',
                'title' => 'Активний',
            ],
            [
                'name' => 'problem',
                'title' => 'Проблеми',
            ],
            [
                'name' => 'created_at_short',
                'title' => 'Створений',
            ],
        ],
        'actions' => [
            'edit',
            'delete',
        ],
        'containerClass' => 'container-fluid',
    ])
@endsection