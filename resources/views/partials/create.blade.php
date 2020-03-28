<div class="card card-success">
	<div class="card-header">
		<h3 class="card-title">创建{{ $modname ?? '' }}</h3>
	</div>

    <form role="form" id="create-form" name="create-form" method="post" action="{{ route($model . '.store') }}">
        @csrf
		<div class="card-body">
			@foreach ($components as $component)
				@if (!empty($component[$action]))
	                <div class="form-group row">
	                    <label for="{{ $component['field'] }}" class="col-sm-3 col-form-label">{{ __($model . '.' . $component['field']) }}</label>
	                    <div class="col-md-9">
							@if ('text' === $component['type'])
		                    	<input type="text" name="{{ $component['field'] }}" id="{{ $component['field'] }}" class="{{ empty($component['readonly']) ? 'form-control' : 'form-control-plaintext' }}{{ $errors->has($component['field']) ? ' is_invalid' : '' }}" placeholder="{{ __($model . '.' . $component['field']) }}" value="{{ old($component['field']) }}"{{ !empty($component['required']) ? ' required' : '' }}{{ !empty($component['readonly']) ? ' readonly' : '' }}{{ !empty($component['disabled']) ? ' readonly' : '' }}>
				            @elseif ('password' === $component['type'])
		                    	<input type="password" name="{{ $component['field'] }}" id="{{ $component['field'] }}" class="form-control{{ $errors->has($component['field']) ? ' is_invalid' : '' }}" placeholder="{{ __($model . '.' . $component['field']) }}"{{ !empty($component['required']) ? ' required' : '' }}{{ !empty($component['readonly']) ? ' readonly' : '' }}{{ !empty($component['disabled']) ? ' readonly' : '' }}>
				            @elseif ('textarea' === $component['type'])
				            	<textarea name="{{ $component['field'] }}" id="{{ $component['field'] }}" rows="5" class="form-control{{ $errors->has($component['field']) ? ' is_invalid' : '' }}"{{ !empty($component['required']) ? ' required' : '' }}{{ !empty($component['readonly']) ? ' readonly' : '' }}{{ !empty($component['disabled']) ? ' readonly' : '' }}>{{ old($component['field']) }}</textarea>
				            @elseif ('radio' === $component['type'])
				            	@foreach (explode('|', $component['values']) as $pair)
				            		@php
				            			$value = explode(':', $pair)
				            		@endphp
			                    	<div class="form-check form-check-inline">
			                    		<input type="radio" name="{{ $component['field'] }}" id="{{ $component['field']. $loop->index }}" class="form-check-input{{ $errors->has($component['field']) ? ' is_invalid' : '' }}" value="{{ $value[0] }}"{{ !empty($component['required']) ? ' required' : '' }}{{ isset($component['default']) && ($value[0] == $component['default']) ? ' checked' : '' }}{{ !empty($component['readonly']) ? ' readonly' : '' }}{{ !empty($component['disabled']) ? ' readonly' : '' }}>
			                    		<label class="form-check-label" for="{{ $component['field'] . $loop->index }}">{{ $value[1] }}</label>
			                    	</div>
				            	@endforeach
				            @elseif ('checkbox' === $component['type'])
				            	@foreach (explode('|', $component['values']) as $pair)
				            		@php
				            			$value = explode(':', $pair)
				            		@endphp
			                    	<div class="form-check form-check-inline">
			                    		<input type="checkbox" name="{{ $component['field'] }}" id="{{ $component['field']. $loop->index }}" class="form-check-input{{ $errors->has($component['field']) ? ' is_invalid' : '' }}" value="{{ $value[0] }}"{{ !empty($component['required']) ? ' required' : '' }}{{ isset($component['default']) && ($value[0] == $component['default']) ? ' checked' : '' }}{{ !empty($component['readonly']) ? ' readonly' : '' }}{{ !empty($component['disabled']) ? ' readonly' : '' }}>
			                    		<label class="form-check-label" for="{{ $component['field'] . $loop->index }}">{{ $value[1] }}</label>
			                    	</div>
				            	@endforeach
				            @elseif ('select' === $component['type'])
				            	<select name="{{ $component['field'] }}" id="{{ $component['field'] }}" class="form-control{{ $errors->has($component['field']) ? ' is_invalid' : '' }}"{{ !empty($component['required']) ? ' required' : '' }}{{ !empty($component['readonly']) ? ' readonly' : '' }}{{ !empty($component['disabled']) ? ' readonly' : '' }}>
				            		@foreach (${$component['collection']} as $collection)
				            			<option value="{{ $collection->id }}">{{ $collection->name }}</option>
				            		@endforeach
				            	</select>
				            @elseif ('datetime' === $component['type'])
				            	<div class="form-group">
				            		<div class="input-group date datetimepicker" id="{{ $component['field'] }}" data-target-input="nearest">
				            			<input type="text" name="{{ $component['field'] }}" class="{{ empty($component['readonly']) ? 'form-control datetimepicker-input' : 'form-control-plaintext' }}{{ $errors->has($component['field']) ? ' is_invalid' : '' }}" placeholder="{{ __($model . '.' . $component['field']) }}" value="{{ old($component['field']) }}"{{ !empty($component['required']) ? ' required' : '' }}{{ !empty($component['readonly']) ? ' readonly' : '' }}{{ !empty($component['disabled']) ? ' readonly' : '' }} data-target="#{{ $component['field'] }}">
				            			<div class="input-group-append" data-target="#{{ $component['field'] }}" data-toggle="datetimepicker">
                        					<div class="input-group-text">
                        						<i class="fa fa-calendar"></i>
                        					</div>
                    					</div>
                    				</div>
				            	</div>
			                @endif
	                    	@if (!empty($component['required']))
	                    		<span class="text-danger">（*必填项）</span>
	                    	@endif
			                @if (!empty($component['help']))
			                	<small class="form-text text-muted">{{ $component['help'] }}</small>
			                @endif
	                        @if ($errors->has($component['field']))
		                        <div class="invalid-feedback" role="alert">
		                            <strong>{{ $errors->first($component['field']) }}</strong>
		                        </div>
	                        @endif
	                    </div>
	                </div>
			    @endif
			@endforeach
		</div>

		<div class="card-footer">
	        <button type="submit" class="btn btn-success">
	            <i class="icon fa fa-save"></i> 创建
	        </button>
		</div>
	</form>
</div>