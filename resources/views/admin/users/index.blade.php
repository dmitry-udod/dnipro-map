@extends('layouts.backend')

@section('content')
    @include('admin.common.list', [
        'title' => 'Адміністратори',
        'fields' => [
            [
                'name' => 'name',
                'title' => "Iм'я",
            ],
            [
                'name' => 'email',
                'title' => 'Email',
            ],
        ],
        'actions' => [
            'edit',
            'delete',
        ],
    ])
    {{--[--}}
    {{--'name' => 'cities',--}}
    {{--'title' => 'Мiсто',--}}
    {{--],--}}

@endsection