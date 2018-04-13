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
                            @if (empty($field['type']))
                                <?php $field['type'] = 'text' ?>
                            @endif
                            @include("admin.common.fields.{$field['type']}")
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