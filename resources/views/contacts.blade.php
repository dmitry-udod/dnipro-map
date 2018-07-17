@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card mt-3">
            <div class="card-body">
                <h5 class="card-title">На з'вязку</h5>
                <div class="card-text">
                <ul>
                    <li>
                        Всі питання та пропозиції можна відправляти на пошту:
                        <a href="mailto:{{ env('CONTACTS_EMAIL', 'reedwalter24@gmail.com') }}">{{ env('CONTACTS_EMAIL', 'reedwalter24@gmail.com') }}</a>
                    </li>
                    <li>
                        Для багів та доопрацювань можна створювати тікети за поcиланням <a target="_blank" href="https://github.com/dmitry-udod/dnipro-map/issues">https://github.com/dmitry-udod/dnipro-map/issues</a>
                    </li>
                </ul>
                </div>
            </div>
        </div>
    </div>
@endsection