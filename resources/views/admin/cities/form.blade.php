@extends('layouts.backend')

@section('content')
    @include('admin.common.form', [
        'title' => 'Редагування міста',
        'fields' => [
            [
                'name' => 'name',
                'title' => 'Назва',
                'required' => true,
            ],
            [
                'name' => 'slug',
                'title' => 'Slug',
            ]
        ],
        'entity' => empty($entity) ? null : $entity,
    ])
@endsection