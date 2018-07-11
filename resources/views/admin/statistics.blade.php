@extends('layouts.backend')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @foreach ($user->citiesForDropDown() as $cityId => $cityName)
            <div class="card  mb-3">
                <div class="card-header">
                    {{ $cityName }}
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-sm">
                        <tbody>
                            <tr>
                                <td>Кiлькiсть категорiй</td>
                                <td>{{ App\Category::where('city_id', $cityId)->count() }}</td>
                            </tr>
                            <tr>
                                <td>Загальна кiлькiсть об'эктiв</td>
                                <td>{{ App\Structure::where('city_id', $cityId)->count() }}</td>
                            </tr>
                            <tr>
                                <td>Загальна кiлькiсть скарг</td>
                                <td>{{ App\Claim::where('city_id', $cityId)->count() }}</td>
                            </tr>
                            <tr>
                                <td>Кiлькiсть необроблених скарг</td>
                                <td>
                                    <span class="badge-danger badge">{{ App\Claim::where('city_id', $cityId)->where('is_processed', false)->count() }}</span>
                                </td>
                            </tr>
                            <tr>
                                <td>Кiлькiсть оброблених скарг</td>
                                <td>
                                    <span class="badge-success badge">{{ App\Claim::where('city_id', $cityId)->where('is_processed', true)->count() }}</span>
                                </td>
                            </tr>
                            <tr>
                                <td>Загальна запитiв на додавання нових структур</td>
                                <td>{{ App\StructureRequest::where('city_id', $cityId)->count() }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection

