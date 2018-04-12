@extends('layouts.backend')

@section('content')
    @include('admin.common.list', [
        'title' => 'Users',
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