<div class="form-group row">
	<label for="name" class="col-md-2 col-form-label text-md-right">{{ $field['title'] }}</label>

	<div class="col-md-10">
	    <input id="name" type="text" class="form-control{{ $errors->has($field['name']) ? ' is-invalid' : '' }}" name="name" value="{{ old($field['name'], object_get($entity, $field['name'])) }}" {{ !empty($field['required']) ? 'required' : '' }}>

	    @if ($errors->has($field['name']))
	        <span class="invalid-feedback">
	            <strong>{{ $errors->first($field['name']) }}</strong>
	        </span>
	    @endif
	</div>
</div>