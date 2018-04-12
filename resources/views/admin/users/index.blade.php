@extends('layouts.backend')

@section('content')
    @include('admin.common.list', [
        'title' => 'Мiста',
        'fields' => [
            [
                'name' => 'name',
                'title' => 'Name',
            ],
            [
                'name' => 'email',
                'title' => 'Em',
            ],
        ],
    ])
@endsection