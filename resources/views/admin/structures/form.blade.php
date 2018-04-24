@extends('layouts.backend')

@section('content')
    <structure
            city="{{ $city->name }}"
            data="{{ base64_encode(json_encode(new \App\Http\Resources\Structure(new $model))) }}"
    ></structure>
@endsection

@section('js')
    <script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_API_KEY') }}"></script>
@endsection