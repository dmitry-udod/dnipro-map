@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row mt-3">
        <form class="col-12">
            <div class="input-group">
                <input name="q" class="form-control border-secondary py-2" type="search" placeholder="Пошук..." value="{{ request('q') }}">

                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="submit">
                        <svg height="20px" version="1.1" viewBox="0 0 32 32" width="20px" xmlns="http://www.w3.org/2000/svg"><g fill="none" fill-rule="evenodd" stroke="none" stroke-width="1"><g fill="#929292" id="icon-111-search"><path d="M19.4271164,21.4271164 C18.0372495,22.4174803 16.3366522,23 14.5,23 C9.80557939,23 6,19.1944206 6,14.5 C6,9.80557939 9.80557939,6 14.5,6 C19.1944206,6 23,9.80557939 23,14.5 C23,16.3366522 22.4174803,18.0372495 21.4271164,19.4271164 L27.0119176,25.0119176 C27.5621186,25.5621186 27.5575313,26.4424687 27.0117185,26.9882815 L26.9882815,27.0117185 C26.4438648,27.5561352 25.5576204,27.5576204 25.0119176,27.0119176 L19.4271164,21.4271164 L19.4271164,21.4271164 Z M14.5,21 C18.0898511,21 21,18.0898511 21,14.5 C21,10.9101489 18.0898511,8 14.5,8 C10.9101489,8 8,10.9101489 8,14.5 C8,18.0898511 10.9101489,21 14.5,21 L14.5,21 Z" id="search"/></g></g></svg>
                    </button>
                </div>
            </div>
        </form>
    </div>

    @foreach($entities as $entity)
    <div class="card mt-3">
        <div class="card-body">
            <h5 class="card-title">{{ $entity->address }}</h5>
            <p class="card-text">
                <ul>
                    <li>Номер: {{ $entity->uuid }}</li>
                    {!! $entity->name ?  "<li>Назва: $entity->name</li>" : '' !!}
                    {!! $entity->category_id ?  "<li>Категорiя: $category->name</li>" : '' !!}
                    {!! $entity->type_id ?  "<li>Вид діяльності: $entity->typeAsText</li>" : '' !!}
                    {!! $entity->area ?  "<li>Площа об'єкта: $entity->area</li>" : '' !!}
                    {!! $entity->business ?  "<li>Основна сфера: $entity->business</li>" : '' !!}
                    {!! $entity->owner ?  "<li>Власник: $entity->owner</li>" : '' !!}
                    {!! $entity->director ?  "<li>Керівник: $entity->director</li>" : '' !!}
                    {!! $entity->renter ?  "<li>Орендар: $entity->renter</li>" : '' !!}
                    {!! $entity->has_contract ?  "<li>Наявність договору: Так</li>" : '' !!}
                    {!! $entity->phone ?  "<li>Телефон: $entity->phone</li>" : '' !!}
                    {!! $entity->working_hours ?  "<li>Графiк роботи: $entity->working_hours</li>" : '' !!}
                    {!! $entity->url ?  "<li>Посилання: $entity->url</li>" : '' !!}
                    {!! $entity->notes ?  "<li>Нотатки: $entity->notes</li>" : '' !!}
                    @if (!empty($entity->additional_fields) && !empty($category->additional_fields))
                        @foreach($entity->additional_fields as $entityField)
                            @foreach($category->additional_fields as $categoryField)
                                @if ($categoryField['id'] === $entityField['id'])
                                    <li>{{ $categoryField['name'] }}: {{ $entityField['value'] }}</li>
                                    @continue
                                @endif
                            @endforeach
                        @endforeach
                    @endif
                </ul>
            </p>
        </div>
    </div>
    @endforeach

    @if($entities->isEmpty())
        <div class="mt-3 col-12 text-center">Нiчого не знайдено</div>
    @endempty
</div>
@endsection