@foreach (['success', 'danger', 'warning', 'info'] as $status)
	@if (session()->has($status))
		<div class="alert alert-dismissible alert-{{ $status }}" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close" aria-hidden="true">&times;</button>
			<h5>
				@if ('success' == $status)
					<i class="icon fa fa-check"></i> 成功!
				@elseif ('danger' == $status)
					<i class="icon fa fa-ban"></i> 错误!
				@elseif ('warning' == $status)
					<i class="icon fa fa-warning"></i> 警告!
				@elseif ('info' == $status)
					<i class="icon fa fa-info"></i> 消息!
				@endif
			</h5>
			{{ session()->get($status) }}
		</div>
	@endif
@endforeach

@if (count($errors))
	<div class="alert alert-dismissible alert-danger" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close" aria-hidden="true">&times;</button>
		<h5>
			<i class="icon fa fa-ban"></i> 验证错误!
		</h5>
		<ul>
			@foreach ($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
		</ul>
	</div>
@endif