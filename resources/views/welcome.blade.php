@extends('layouts.app')

@section('css')

@endsection

@section('content')
    @include('categories._modal')
    <div style="height:calc(100vh - 60px);">
        <google-map
            city="{{ $city->name }}"
            name="structures"
            markers-json="{{ base64_encode($entities->toJson()) }}"
            categories-json="{{ base64_encode(\App\Http\Resources\Category::collection($categories)->toJson()) }}"
            types-json="{{ base64_encode($types->toJson()) }}"
        ></google-map>
    </div>


@endsection

@section('js')
    <script src="//developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js"></script>
    <script src="//maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_API_KEY') }}&language=uk&libraries=places"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function(){
            $('#categories').modal('show');
        }, false);
    </script>
@endsection