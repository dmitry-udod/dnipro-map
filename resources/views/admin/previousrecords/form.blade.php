@extends('layouts.backend')

@section('custom_html_form_top')
    <div class="form-group row">
        <label for="name" class="col-md-2 col-form-label text-md-right">Номер (id)</label>
        <div class="col-md-10 form-control border-0">{{ $entity->uuid }}</div>
    </div>
    @if ($entity->is_processed)
        <div class="form-group row">
            <label for="name" class="col-md-2 col-form-label text-md-right">Ким опрацьована</label>
            <div class="col-md-10 form-control border-0">{{ $entity->processed_by }}</div>
        </div>
        <div class="form-group row">
            <label for="name" class="col-md-2 col-form-label text-md-right">Дата опрацювання</label>
            <div class="col-md-10 form-control border-0">{{ $entity->processed_at}}</div>
        </div>
    @endif
    <div class="form-group row">
        <label for="name" class="col-md-2 col-form-label text-md-right">Назва</label>
        <div class="col-md-10 form-control border-0">{{ $entity->structure_name}}</div>
    </div>

    <div class="form-group row">
        <label for="name" class="col-md-2 col-form-label text-md-right">ПІБ дитини</label>
        <div class="col-md-10 form-control border-0">{{ $entity->name }}</div>
    </div>

    <div class="form-group row">
        <label for="name" class="col-md-2 col-form-label text-md-right">Вік дитини</label>
        <div class="col-md-10 form-control border-0">{{ $entity->age}}</div>
    </div>


    <div class="form-group row">
        <label for="name" class="col-md-2 col-form-label text-md-right">ПІБ дорослого</label>
        <div class="col-md-10 form-control border-0">{{ $entity->parent_name }}</div>
    </div>

    <div class="form-group row">
        <label for="name" class="col-md-2 col-form-label text-md-right">Телефон батьків</label>
        <div class="col-md-10 form-control border-0">{{ $entity->parent_phone}}</div>
    </div>

    <div class="form-group row">
        <label for="name" class="col-md-2 col-form-label text-md-right">Примітка</label>
        <div class="col-md-10 form-control border-0">{{ $entity->notes}}</div>
    </div>
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


