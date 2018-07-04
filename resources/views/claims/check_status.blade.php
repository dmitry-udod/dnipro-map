@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mt-3">Перевiрка статусу скарги</h1>
        <div class="row mt-3">
            <form class="col-12">
                <div class="input-group">
                    <input name="q" class="form-control border-secondary py-2" type="search" placeholder="Введiть номер скарги виду 749a2c0c-c92b-4e87-8f0b-77df6462d385" value="{{ request('uuid') }}">

                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="submit">
                            <svg height="20px" version="1.1" viewBox="0 0 32 32" width="20px" xmlns="http://www.w3.org/2000/svg"><g fill="none" fill-rule="evenodd" stroke="none" stroke-width="1"><g fill="#929292" id="icon-111-search"><path d="M19.4271164,21.4271164 C18.0372495,22.4174803 16.3366522,23 14.5,23 C9.80557939,23 6,19.1944206 6,14.5 C6,9.80557939 9.80557939,6 14.5,6 C19.1944206,6 23,9.80557939 23,14.5 C23,16.3366522 22.4174803,18.0372495 21.4271164,19.4271164 L27.0119176,25.0119176 C27.5621186,25.5621186 27.5575313,26.4424687 27.0117185,26.9882815 L26.9882815,27.0117185 C26.4438648,27.5561352 25.5576204,27.5576204 25.0119176,27.0119176 L19.4271164,21.4271164 L19.4271164,21.4271164 Z M14.5,21 C18.0898511,21 21,18.0898511 21,14.5 C21,10.9101489 18.0898511,8 14.5,8 C10.9101489,8 8,10.9101489 8,14.5 C8,18.0898511 10.9101489,21 14.5,21 L14.5,21 Z" id="search"/></g></g></svg>
                        </button>
                    </div>
                </div>
            </form>
        </div>

        @if ($entity)
        <div class="card mt-3">
            <div class="card-body">
                <h5 class="card-title">Скарга {{ $entity ? '' : 'НЕ' }} знайдена</h5>

                    <p class="card-text">
                    <ul>
                        <li>Номер: {{ $entity->uuid }}</li>
                        <li>Статус: {!! $entity->is_processed ? "<span class='badge badge-success'>Розглянута</span>" : "<span class='badge badge-danger'>Розглядаєтся</span>" !!}</li>
                        @if ($entity->is_processed)
                            <li>Дата опрацювання: {{ $entity->processed_at }}</li>
                            <li>Рішення: {{ $entity->response }}</li>
                        @endif
                    </ul>
                    </p>
            </div>
        </div>
        @endif
    </div>
@endsection