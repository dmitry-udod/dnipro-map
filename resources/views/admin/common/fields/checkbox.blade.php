<div class="form-group row">
	<label for="{{ $field['name'] }}" class="col-md-2 col-form-label text-md-right">{{ $field['title'] }}</label>

	<div class="col-md-10">
	    <input style="width:2%;margin-top:12px" id="{{ $field['name'] }}" type="checkbox" class="form-control{{ $errors->has($field['name']) ? ' is-invalid' : '' }}" name="{{ $field['name'] }}" value="{{ old($field['name'], object_get($entity, $field['name'])) }}">
	</div>
</div>