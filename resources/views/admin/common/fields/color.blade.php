<div class="form-group row">
	<label for="name" class="col-md-2 col-form-label text-md-right">{{ $field['title'] }}</label>

	<div class="col-md-10">
	    <input id="{{ $field['name'] }}" type="color" name="{{ $field['name'] }}" style="margin-top:7px;" value="{{ old($field['name'], object_get($entity, $field['name'], '#FFFFFF')) }}">
	    @if ($errors->has($field['name']))
	        <span class="invalid-feedback">
	            <strong>{{ $errors->first($field['name']) }}</strong>
	        </span>
	    @endif
	</div>
</div>