@extends('Layout.Admin.User.master')

@push('css')
	<title>
		{{ __('Thêm menu') }}
	</title>
@endpush

@section('content')
<div class="content">
	<div class="container-fluid">
		
		@include('Layout.Admin.Notification.message_basic')

		<div class="row">
			
			<div class="col-md-6">
				<div class="card">
					<form method="post" action="{{ route('admin.menu.store') }}">
						@csrf
						<div class="card-header">
							<h4 class="card-title">
								{{ __('Thêm mới menu') }}
							</h4>
						</div>
						<div class="card-content">
							<div class="form-group">
								<label for="name">
									{{ __('Tên') }}
								</label>
								<input type="text" placeholder="Tên menu" class="form-control" id="name" name="menu[name]" value="@if(!empty(old('menu')['name'])) {{ old('menu')['name'] }} @endif">
                				@if (!empty($errors) && $errors->has('name'))
                					<label class="error text-danger" for="name">
                						{{ $errors->first('name') }}
                					</label>
                				@endif
							</div>
							<div class="form-group">
								<label for="link">
									{{ __('Link') }}
								</label>
								<input type="text" placeholder="Link menu" class="form-control" id="link" name="menu[link]" value="@if(!empty(old('menu')['link'])) {{ old('menu')['link'] }} @endif">
                				@if (!empty($errors) && $errors->has('link'))
                					<label class="error text-danger" for="link">
                						{{ $errors->first('link') }}
                					</label>
                				@endif
							</div>
							{{-- <div class="form-group">
								<label>
									{{ __('Menu liên quan') }}
								</label>
								<br>
								<div class="checkbox checkbox-inline">
								    <input type="checkbox" id="checkbox-relevant-menu" name="menu[checkbox_relevant_menu]" @if (isset(old('menu')['checkbox_relevant_menu'])) checked="checked" @endif>
									<label for="checkbox-relevant-menu">
										{{ __('Có') }}
									</label>
								</div>
							</div>
							<div class="row d-none" id="input-relevant-menu">
								<div class="col-sm-6">
									<select class="selectpicker" data-style="btn btn-block" title="Menu liên quan" data-size="5" name="menu[relevant_menu]">
										@if (!empty($menu) && count($menu) > 0)
											@php
												Helpers::optionSelectLinkMenu($menu, null);
											@endphp
										@else
											<option>Chưa có nhóm menu</option>
										@endif
									</select>
	                				@if (!empty($errors) && $errors->has('relevant_menu'))
	                					<label class="error text-danger">
	                						{{ $errors->first('relevant_menu') }}
	                					</label>
	                				@endif
								</div>
							</div> --}}
							<div class="form-group" id="menu-level">
								<label>
									{{ __('Loại menu') }}
								</label>
								<br>
								<div class="radio radio-inline">
								    <input type="radio" id="normal_menu" value="{{ MENU }}" name="menu[level]" @if(!isset(old('menu')['level']) || old('menu')['level'] == MENU) checked="checked" @endif>
									<label for="normal_menu">
										{{ __('Menu thường') }}
									</label>
								</div>
								<div class="radio radio-inline">
								    <input type="radio" id="sub_menu" value="{{ SUB_MENU }}" name="menu[level]" @if(isset(old('menu')['level']) && old('menu')['level'] == SUB_MENU) checked="checked" @endif>
									<label for="sub_menu">
										{{ __('Menu con') }}
									</label>
								</div>
								<br>
                				@if (!empty($errors) && $errors->has('level'))
                					<label class="error text-danger">
                						{{ $errors->first('level') }}
                					</label>
                				@endif
							</div>
							<div class="row" id="option-menu-level">
								<div class="col-md-6">
									<div class="form-group">
										<label for="icon-menu">
											{{ __('Icon menu') }}
										</label>
										<input type="text" placeholder="VD: ti-panel" class="form-control index-menu" id="icon-menu" name="menu[icon]" value="@if(!empty(old('menu')['icon'])) {{ old('menu')['icon'] }} @endif">
		                				@if (!empty($errors) && $errors->has('icon'))
		                					<label class="error text-danger">
		                						{{ $errors->first('icon') }}
		                					</label>
		                				@endif
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="index-menu">
											{{ __('Thứ tự menu') }}
										</label>
										<input type="text" placeholder="VD: 1 - số lớn xếp xuống cuối" class="form-control  index-menu" id="index-menu" name="menu[index_menu]" value="@if(!empty(old('menu')['index_menu'])) {{ old('menu')['index_menu'] }} @endif">
		                				@if (!empty($errors) && $errors->has('index_menu'))
		                					<label class="error text-danger">
		                						{{ $errors->first('index_menu') }}
		                					</label>
		                				@endif
									</div>
								</div>
								<div class="col-md-6 d-none">
									<div class="form-group">
										<label for="sub-name">
											{{ __('Tên rút gọn') }}
										</label>
										<input type="text" placeholder="VD: HĐ - Hóa đơn" class="form-control index-sub-menu" id="sub-name" name="menu[sub_name]" value="@if(!empty(old('menu')['sub_name'])) {{ old('menu')['sub_name'] }} @endif">
		                				@if (!empty($errors) && $errors->has('sub_name'))
		                					<label class="error text-danger">
		                						{{ $errors->first('sub_name') }}
		                					</label>
		                				@endif
									</div>
								</div>
								<div class="col-md-6 d-none">
									<div class="form-group">
										<label for="index-sub-menu">
											{{ __('Thứ tự menu con') }}
										</label>
										<input type="text" placeholder="VD: 1 - số lớn xếp xuống cuối" class="form-control index-sub-menu" id="index-sub-menu" name="menu[index_sub_menu]" value="@if(!empty(old('menu')['index_sub_menu'])) {{ old('menu')['index_sub_menu'] }} @endif">
		                				@if (!empty($errors) && $errors->has('index_sub_menu'))
		                					<label class="error text-danger">
		                						{{ $errors->first('index_sub_menu') }}
		                					</label>
		                				@endif
									</div>
								</div>
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
			if($('#sub_menu').is(':checked'))
			{
				$('.index-sub-menu').parent('div').parent('div').removeClass('d-none');
				$('.index-menu').parent('div').parent('div').addClass('d-none');
			}
			else
			{
				$('.index-sub-menu').parent('div').parent('div').addClass('d-none');
				$('.index-menu').parent('div').parent('div').removeClass('d-none');
			}

			$('#normal_menu, #sub_menu').click(function () {
				if($('#sub_menu').is(':checked'))
				{
					$('.index-sub-menu').parent('div').parent('div').removeClass('d-none');
					$('.index-menu').parent('div').parent('div').addClass('d-none');
				}
				else
				{
					$('.index-sub-menu').parent('div').parent('div').addClass('d-none');
					$('.index-menu').parent('div').parent('div').removeClass('d-none');
				}
			})

			if($('#checkbox-relevant-menu').is(':checked'))
			{
				$('#menu-level').addClass('d-none');
				$('#option-menu-level').addClass('d-none');
				$('#input-relevant-menu').removeClass('d-none');
			}
			else
			{
				$('#menu-level').removeClass('d-none');
				$('#option-menu-level').removeClass('d-none');
				$('#input-relevant-menu').addClass('d-none');
			}
			$('#checkbox-relevant-menu').click(function () {
				if($('#checkbox-relevant-menu').is(':checked'))
				{
					$('#menu-level').addClass('d-none');
					$('#option-menu-level').addClass('d-none');
					$('#input-relevant-menu').removeClass('d-none');
				}
				else
				{
					$('#menu-level').removeClass('d-none');
					$('#option-menu-level').removeClass('d-none');
					$('#input-relevant-menu').addClass('d-none');
				}
			})
		});
	</script>
@endpush