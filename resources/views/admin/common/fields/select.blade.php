<div class="form-group row">
	<label for="name" class="col-md-2 col-form-label text-md-right">{{ $field['title'] }}</label>

	<div class="col-md-10">
		<select id="{{ $field['name'] }}"  name="{{ $field['name'] }}" class="form-control" required>
  			@foreach($field['values'] as $key => $value)
  				<option value="{{ $key }}" 
  				@if($key == $entity->{$field['name']}) selected @endif>{{ $value }}</option>
  			@endforeach
		</select>
	    @if ($errors->has($field['name']))
	        <span class="invalid-feedback">
	            <strong>{{ $errors->first($field['name']) }}</strong>
	        </span>
	    @endif
	</div>
</div>