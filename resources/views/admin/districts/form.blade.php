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
        ],
        'entity' => empty($entity) ? new $model : $entity,
    ])
@endsection