<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    {{ $title }}
                </div>
                <div class="card-body">
                    <form method="POST" enctype="multipart/form-data"
                      action="{{ route(!object_get($entity, 'id') ? "admin.$viewName.store"  : "admin.$viewName.update", [$city->slug, object_get($entity, 'id')]) }}"
                    >
                        @yield('custom_html_form_top')

                        @csrf

                        @if(object_get($entity, 'id'))
                            @method('PUT')
                        @endif

                        @foreach($fields as $field)
                            @if (empty($field['type']))
                                <?php $field['type'] = 'text' ?>
                            @endif
                            @include("admin.common.fields.{$field['type']}")
                        @endforeach

                        <div class="form-group row mb-0">
                            <div class="col-md-7 offset-md-5">
                                @if (empty($hideButtons))
                                    <button type="submit" class="btn btn-primary">
                                        Зберегти
                                    </button>
                                @endif

                                <a href="{{ route("admin.$viewName.index", $city->slug) }}" style="margin-left: 10px">Назад</a>
                            </div>
                        </div>
                    </form>
                    @yield('custom_html')
                </div>
            </div>
        </div>
    </div>
</div>