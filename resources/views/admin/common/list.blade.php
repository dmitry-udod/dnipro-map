<div class="{{ empty($containerClass) ? 'container' : $containerClass }}">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    {{ $title }}
                    @if (empty($hideAddButton))
                        <a href="{{ route("admin.$viewName.create", $city->slug) }}" class="btn btn-primary float-right btn-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" width="8" height="8" viewBox="0 0 8 8">
                                <path d="M3 0v3h-3v2h3v3h2v-3h3v-2h-3v-3h-2z" style="fill:white" />
                            </svg> Додати
                        </a>

                        @if(request('q'))
                            <a class="mr-3 btn btn-sm btn-primary float-right" href="{{ route("admin.$viewName.index", $city->slug) }}">X</a>
                        @endif

                        <div class="col-3 float-right">
                            <form>
                                <input type="search" class="form-control form-control-sm" placeholder="Пошук..." name="q" value="{{ request('q') }}">
                            </form>
                        </div>
                    @endif
                    @yield('buttons')
                </div>
                <div class="card-body">
                    <table class="table table-sm">
                        <thead>
                        <tr>
                            @foreach($fields as $field)
                                <th scope="col">{{ $field['title'] }}</th>
                            @endforeach
                            <th scope="col"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($entities as $entity)
                            <tr>
                            @foreach($fields as $field)
                                <td>
                                    @if(empty($field['type']))
                                        @if(empty($field['raw']))
                                            {{ $entity->{$field['name']} }}
                                        @else
                                            {!! $entity->{$field['name']} !!}
                                        @endif
                                    @else
                                        @if (!empty(json_decode($entity->{$field['name']})->path))
                                            <img width="20" height="20" src="{{ json_decode($entity->{$field['name']})->path }}">
                                            <br>
                                        @endif
                                    @endif
                                </td>
                            @endforeach
                                <td width="150">
                                    @foreach($actions as $action)
                                        @include("admin.common.actions.$action")
                                    @endforeach
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    {{ $entities->appends(['q' => request('q')])->links() }}
                </div>
            </div>
        </div>
    </div>
</div>