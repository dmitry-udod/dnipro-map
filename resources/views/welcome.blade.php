@extends('layouts.app')

@section('content')
    <div class="filter container d-flex">
        <div class="row justify-content-center align-self-center">
            <button class="btn btn-success mobile-filter" type="button" onclick="hideFilter();">
                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"><polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"></polygon></svg>
            </button>

            @if (! $types->isEmpty())
            <div class="filter-wrapper">
                <form action="" class="filter-form">
                    <div class="scroll-box">
                        <div class="form-group region">
                            <h5>Вид діяльності <em></em></h5>
                            <div class="slide-block">
                                @foreach($types as $type)
                                <div class="form-check">
                                    <div class="color-box" style="background:{{ $type->color }};"></div>
                                    <input name="types[]" type="checkbox" class="form-check-input"
                                           id="type{{ $type->id }}"
                                           value="{{ $type->id }}"
                                           {{ in_array($type->id, array_get(request(), 'types', [])) ? 'checked' : '' }}
                                    >
                                    <label class="form-check-label" for="type{{ $type->id }}">{{ $type->name }}</label>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary btn-block" type="submit">Показати</button>
                        </div>
                    </div>
                </form>
            </div>
            @endif
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
    <script src="/js/markerclusterer.js"></script>
    <script src="//maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_API_KEY') }}&language=uk&libraries=places"></script>

    <script>
        @empty(session('hide_category_modal'))
            document.addEventListener('DOMContentLoaded', function () {
                $('#categories').modal('show');
            }, false);
            @php session()->put('hide_category_modal', true); @endphp
        @endempty

        function hideFilter() {
            $('.mobile-filter').toggle();
            $('.filter-wrapper').toggle();
        }
    </script>
@endsection