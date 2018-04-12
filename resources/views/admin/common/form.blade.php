<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    {{ $title }}
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route(object_get($entity, 'id') ? "admin.$viewName.create"  : "admin.$viewName.update", [$city->slug, object_get($entity, 'id')]) }}">
                        @csrf
                        {{--@method('PUT')--}}

                        @foreach($fields as $field)
                            <div class="form-group row">
                                <label for="name" class="col-md-2 col-form-label text-md-right">{{ $field['title'] }}</label>

                                <div class="col-md-10">
                                    <input id="name" type="text" class="form-control{{ $errors->has($field['name']) ? ' is-invalid' : '' }}" name="name" value="{{ old($field['name'], object_get($entity, $field['name'])) }}" required autofocus>

                                    @if ($errors->has($field['name']))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first($field['name']) }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        @endforeach

                        <div class="form-group row mb-0">
                            <div class="col-md-7 offset-md-5">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Save') }}
                                </button>

                                <a href="{{ route("admin.$viewName.index", $city->slug) }}" style="margin-left: 10px">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>