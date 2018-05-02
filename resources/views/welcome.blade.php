@extends('layouts.app')

@section('css')

@endsection

@section('content')
    @include('categories._modal')

    <div style="position: absolute;top: 60px;bottom: 0;right: 0;left: 0;">
        <google-map name="structures"></google-map>
    </div>


@endsection

@section('js')
    <script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_API_KEY') }}"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function(){
            $('#categories').modal('show');
        }, false);
    </script>
@endsection