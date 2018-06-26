@extends('layouts.backend')

@section('content')
    <div class="container">
        <import-csv cities-json="{{ base64_encode($cities) }}" categories-json="{{ base64_encode($categories) }}"></import-csv>
    </div>
@endsection