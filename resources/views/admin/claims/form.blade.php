@extends('layouts.backend')

@section('custom_html_form_top')
    @if ($entity->is_processed)
        <div class="form-group row">
            <label for="name" class="col-md-2 col-form-label text-md-right">Ким опрацьована</label>
            <div class="col-md-10 form-control border-0">{{ $entity->processed_by }}</div>
        </div>
        <div class="form-group row">
            <label for="name" class="col-md-2 col-form-label text-md-right">Дата опрацювання</label>
            <div class="col-md-10 form-control border-0">{{ $entity->processed_at}}</div>
        </div>
    @else
        <div class="form-group row">
            <label for="name" class="col-md-2 col-form-label text-md-right">Адреса</label>
            <div class="col-md-10 form-control border-0">{{ $entity->address}}</div>
        </div>

        <div class="form-group row">
            <label for="name" class="col-md-2 col-form-label text-md-right">Категорія</label>
            <div class="col-md-10 form-control border-0">{{ $entity->category}}</div>
        </div>
        <div class="form-group row">
            <label for="name" class="col-md-2 col-form-label text-md-right">ПІБ</label>
            <div class="col-md-10 form-control border-0">{{ $entity->name}}</div>
        </div>

        <div class="form-group row">
            <label for="name" class="col-md-2 col-form-label text-md-right">Телефон</label>
            <div class="col-md-10 form-control border-0">{{ $entity->phone}}</div>
        </div>

        <div class="form-group row">
            <label for="name" class="col-md-2 col-form-label text-md-right">Email</label>
            <div class="col-md-10 form-control border-0">{{ $entity->email}}</div>
        </div>

        <div class="form-group row">
            <label for="name" class="col-md-2 col-form-label text-md-right">Опис проблеми</label>
            <div class="col-md-10 form-control border-0">{{ $entity->description}}</div>
        </div>
    @endif
@endsection

@section('content')
    @include('admin.common.form', [
        'title' => 'Опрацювання скарги',
        'fields' => [
            [
                'name' => 'response',
                'title' => 'Як відреагували',
                'required' => true,
                'type' => 'textarea',
                'disabled' => $entity->is_processed,
            ],
        ],
        'entity' => empty($entity) ? null : $entity,
        'hideButtons' => $entity->is_processed,
    ])
@endsection


