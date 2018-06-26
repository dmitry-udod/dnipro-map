<div class="form-group row">
    <label for="{{ $field['name'] }}" class="col-md-2 col-form-label text-md-right">{{ $field['title'] }}</label>

    <div class="col-md-10">
        @if (!empty(json_decode($entity->{$field['name']})->path))
            <img src="{{ json_decode($entity->{$field['name']})->path }}">
            <br>
        @endif
        <label for="{{ $field['name'] }}">{{ $field['note'] }}</label>
        <input type="file" class="form-control-file" id="{{ $field['name'] }}"  name="{{ $field['name'] }}" >
        @if ($errors->has($field['name']))
            <span class="invalid-feedback" style="display: block">
	            <strong>{{ $errors->first($field['name']) }}</strong>
	        </span>
        @endif
    </div>
</div>

