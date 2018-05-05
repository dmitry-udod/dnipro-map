@extends('layouts.app')

@section('css')

@endsection

@section('content')
    <div class="filter container d-flex h-100">
        <div class="row justify-content-center align-self-center">
            <button aria-controls="bs-navbar" aria-expanded="false" class="navbar-toggle collapsed mobile-filter" data-target="#bs-navbar" data-toggle="collapse" type="button" onclick="hideFilter();">
                <em class="ico ico-search"></em>
            </button>

            <div class="filter-wrapper">
                <form action="/?category_id=10" class="filter-form" id="StructureIndexForm" method="get" accept-charset="utf-8"><div class="scroll-box"><div class="form-group region"><h4 class="opened">Район міста <em></em></h4><div class="slide-block opened"><div class="checkbox"><label><input type="checkbox" name="district_id[]" value="1" id="StructureDistrictId[]"> Новокодацький</label></div><div class="checkbox"><label><input type="checkbox" name="district_id[]" value="2" id="StructureDistrictId[]"> Центральний</label></div><div class="checkbox"><label><input type="checkbox" name="district_id[]" value="3" id="StructureDistrictId[]"> Чечелівський</label></div><div class="checkbox"><label><input type="checkbox" name="district_id[]" value="4" id="StructureDistrictId[]"> Соборний</label></div><div class="checkbox"><label><input type="checkbox" name="district_id[]" value="5" id="StructureDistrictId[]"> Шевченківський</label></div><div class="checkbox"><label><input type="checkbox" name="district_id[]" value="6" id="StructureDistrictId[]"> Амур-Нижньодніпровський</label></div><div class="checkbox"><label><input type="checkbox" name="district_id[]" value="7" id="StructureDistrictId[]"> Індустріальний</label></div><div class="checkbox"><label><input type="checkbox" name="district_id[]" value="8" id="StructureDistrictId[]"> Самарський</label></div></div></div><div class="form-group"><button class="btn btn-primary btn-block" type="submit">Показати</button></div></div><input type="hidden" name="category_id" value="10" id="StructureCategoryId"></form>
            </div>
        </div>
    </div>

    @include('categories._modal')
    @include('claims._modal')
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
        @empty(session('hide_category_modal'))
        document.addEventListener('DOMContentLoaded', function(){
            $('#categories').modal('show');
        }, false);
        @endempty
    </script>
@endsection