<div class="form-group row">
	<label for="name" class="col-md-2 col-form-label text-md-right">{{ $field['title'] }}</label>

	<div class="col-md-10">
	    <input id="{{ $field['name'] }}" type="{{ array_get($field, 'field_type', 'text') }}" class="form-control{{ $errors->has($field['name']) ? ' is-invalid' : '' }}"
               name="{{ $field['name'] }}"
               @if( ! (!empty($field['field_type']) && $field['field_type'] === 'password'))
               value="{{ old($field['name'], object_get($entity, $field['name'], array_get($field, 'default'))) }}"
               @endif
               {{ !empty($field['required']) ? 'required' : '' }}
        >

	    @if ($errors->has($field['name']))
	        <span class="invalid-feedback">
	            <strong>{{ $errors->first($field['name']) }}</strong>
	        </span>
	    @endif
	</div>
</div>