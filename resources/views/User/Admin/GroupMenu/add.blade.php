@extends('Layout.Admin.User.master')

@push('css')
	<title>
		{{ __('Thêm nhóm menu') }}
	</title>
@endpush

@section('content')
<div class="content">
	<div class="container-fluid">

		@include('Layout.Admin.Notification.message_basic')

		<div class="row">
			
			<div class="col-md-6">
				<div class="card">
					<form method="post" action="{{ route('admin.group.menu.store') }}">
						@csrf
						<div class="card-header">
							<h4 class="card-title">
								{{ __('Thêm mới nhóm menu') }}
							</h4>
						</div>
						<div class="card-content">
							<div class="form-group">
								<label for="name">
									{{ __('Tên') }}
									<star>*</star>
								</label>
								<input type="text" placeholder="Tên nhóm menu" class="form-control" id="name" name="group_menu[name]" value="@if(!empty(old('group_menu')['name'])) {{ old('group_menu')['name'] }} @endif">
                				@if (!empty($errors) && $errors->has('name'))
                					<label class="error text-danger" for="name">
                						{{ $errors->first('name') }}
                					</label>
                				@endif
							</div>
							<button type="submit" class="btn btn-fill btn-info">
								{{ __('Thêm mới') }}
							</button>
						</div>
					</form>
				</div> <!-- end card -->
			</div>

		</div>
	</div>
</div>
@endsection

@push('js')
	<script type="text/javascript">
		$(document).ready(function() {
			$('#normal_menu, #sub_menu').click(function () {
				if($('#sub_menu').is(':checked'))
				{
					$('#index_sub_menu').parent('div').parent('div').removeClass('d-none');
				}
				else
				{
					$('#index_sub_menu').parent('div').parent('div').addClass('d-none');
				}
			})
		});
	</script>
@endpush