<div class="form-group row">
    <label for="{{ $field['name'] }}" class="col-md-2 col-form-label text-md-right">{{ $field['title'] }}</label>

    <div class="col-md-10">
        <additional-fields fields-json="{{ base64_encode(json_encode(object_get($entity, $field['name'], []))) }}"></additional-fields>
    </div>
</div>

