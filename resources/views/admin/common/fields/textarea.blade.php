<div class="form-group row">
	<label for="name" class="col-md-2 col-form-label text-md-right">{{ $field['title'] }}</label>

	<div class="col-md-10">
	    <textarea id="{{ $field['name'] }}" type="{{ array_get($field, 'field_type', 'text') }}" class="form-control{{ $errors->has($field['name']) ? ' is-invalid' : '' }}"
               name="{{ $field['name'] }}"
			   rows="5"
			   {{ !empty($field['disabled']) ? 'disabled' : '' }}
			   {{ !empty($field['required']) ? 'required' : '' }}
        >{{ old($field['name'], object_get($entity, $field['name'])) }}</textarea>

	    @if ($errors->has($field['name']))
	        <span class="invalid-feedback">
	            <strong>{{ $errors->first($field['name']) }}</strong>
	        </span>
	    @endif
	</div>
</div>