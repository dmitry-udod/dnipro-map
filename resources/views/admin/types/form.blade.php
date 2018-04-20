@extends('layouts.backend')

@section('content')
    @include('admin.common.form', [
        'title' => 'Види діяльності',
        'fields' => [
            [
                'name' => 'is_active',
                'title' => 'Відображати на сайті',
                'type' => 'checkbox',
            ],
            [
                'name' => 'category_id',
                'title' => 'Категорія',
                'type' => 'select',
                'values' => $user->categoriesForDropDown(),
            ],
            [
                'name' => 'name',
                'title' => 'Назва',
                'required' => true,
            ],
            [
                'name' => 'city_id',
                'title' => 'Miсто',
                'type' => 'select',
                'values' => $user->citiesForDropDown(),
            ],
            [
                'name' => 'color',
                'title' => 'Колір об\'єкту',
                'type' => 'color',
            ],
            [
                'name' => 'order',
                'title' => 'Порядок',
            ],
            [
                'name' => 'icon',
                'title' => 'Iконка',
                'type' => 'file',
                'note' => 'Будь яке зображення',
            ],

        ],
        'entity' => empty($entity) ? new $model : $entity,
    ])
@endsection