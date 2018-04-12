<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    {{ $title }}
                    <a href="{{ route("admin.$viewName.create", $city->slug) }}" class="btn btn-primary float-right btn-sm">
                        Додати
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
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($entities as $entity)
                            <tr>
                            @foreach($fields as $field)
                                <td>{{ $entity->{$field['name']} }}</td>
                            @endforeach
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>