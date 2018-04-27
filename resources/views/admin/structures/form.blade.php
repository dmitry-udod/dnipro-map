@extends('layouts.backend')

@section('content')
    <structure
            city="{{ $city->name }}"
            data="{{ base64_encode(json_encode(new \App\Http\Resources\Structure(empty($entity) ? new $model : $entity))) }}"
            categories-json="{{ base64_encode($structure->categoriesForDropDown()) }}"
            types-json="{{ base64_encode($structure->typesForDropDown()) }}"
            districts-json="{{ base64_encode($structure->districtsForDropDown()) }}"
    ></structure>
@endsection

@section('js')
    <script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_API_KEY') }}"></script>
@endsection