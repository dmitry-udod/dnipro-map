@extends('layouts.app')

@section('content')
    <div class="modal fade blue" id="cities" tabindex="-1" role="dialog" aria-labelledby="cities">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Оберіть Місто</h5>
                </div>
                <div class="modal-body">
                    <ul class="list-unstyled categories-modal">
                        @foreach($cities as $c)
                            <li class="col-md-6">
                                <div class="row">
                                    <a href="{{ route('main', $c->slug) }}">{{ $c->name }}</a>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            $('#cities').modal('show');
        }, false);
    </script>
@endsection