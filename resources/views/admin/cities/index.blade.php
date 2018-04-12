@extends('layouts.backend')

@section('content')
    @include('admin.common.list', [
        'title' => 'Адміністратори',
        'fields' => [
            [
                'name' => 'name',
                'title' => 'Name',
            ],
            [
                'name' => 'slug',
                'title' => 'Slug',
            ],
            [
                'name' => 'created_at',
                'title' => 'Created',
            ],
            
        ],
    ])
@endsection