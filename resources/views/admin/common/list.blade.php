<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    {{ $title }}
                    <a href="{{ route("admin.$viewName.create", $city->slug) }}" class="btn btn-primary float-right btn-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" width="8" height="8" viewBox="0 0 8 8">
                            <path d="M3 0v3h-3v2h3v3h2v-3h3v-2h-3v-3h-2z" style="fill:white" />
                        </svg> Додати
                    </a>
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
                                <td>{{ $entity->{$field['name']} }}</td>
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
                </div>
            </div>
        </div>
    </div>
</div>