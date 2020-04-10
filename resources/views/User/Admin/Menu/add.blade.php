@extends('Layout.Admin.User.master')

@push('css')
	<title>
		{{ __('Thêm menu') }}
	</title>
@endpush

@section('content')
<div class="content">
	<div class="container-fluid">
		<div class="row">
			
			<div class="col-md-6">
				<div class="card">
					<form method="#" action="#">
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
								<input type="text" placeholder="Tên menu" class="form-control" id="name">
							</div>
							<div class="form-group">
								<label for="link">
									{{ __('Link') }}
								</label>
								<input type="text" placeholder="Link menu" class="form-control" id="link">
							</div>
							<div class="form-group">
								<label>
									{{ __('Loại menu') }}
								</label>
								<br>
								<div class="radio radio-inline">
								    <input type="radio" name="radio1" id="normal_menu" value="0" checked="checked">
									<label for="normal_menu">
										{{ __('Menu thường') }}
									</label>
								</div>
								<div class="radio radio-inline">
								    <input type="radio" name="radio1" id="sub_menu" value="1">
									<label for="sub_menu">
										{{ __('Menu con') }}
									</label>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="index_menu">
											{{ __('Thứ tự menu') }}
										</label>
										<input type="text" placeholder="VD: 1 - số lớn xếp xuống cuối" class="form-control" id="index_menu">
									</div>
								</div>
								<div class="col-md-6 d-none">
									<div class="form-group">
										<label for="index_sub_menu">
											{{ __('Thứ tự menu con') }}
										</label>
										<input type="text" placeholder="VD: 1 - số lớn xếp xuống cuối" class="form-control" id="index_sub_menu">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-6">
									<select class="selectpicker" data-style="btn btn-block" title="Nhóm menu" data-size="5">
										<option value="id">Bahasa Indonesia</option>
										<option value="ms">Bahasa Melayu</option>
										<option value="ca">Català</option>
										<option value="da">Dansk</option>
										<option value="de">Deutsch</option>
										<option value="en">English</option>
										<option value="es">Español</option>
										<option value="el">Eλληνικά</option>
										<option value="fr">Français</option>
										<option value="it">Italiano</option>
										<option value="hu">Magyar</option>
										<option value="nl">Nederlands</option>
										<option value="no">Norsk</option>
										<option value="pl">Polski</option>
										<option value="pt">Português</option>
										<option value="fi">Suomi</option>
										<option value="sv">Svenska</option>
										<option value="tr">Türkçe</option>
										<option value="is">Íslenska</option>
										<option value="cs">Čeština</option>
										<option value="ru">Русский</option>
										<option value="th">ภาษาไทย</option>
										<option value="zh">中文 (简体)</option>
										<option value="zh-TW">中文 (繁體)</option>
										<option value="ja">日本語</option>
										<option value="ko">한국어</option>
									</select>
								</div>
								<div class="col-md-6">
									<button type="button" class="btn btn-wd btn-info">
										<span class="btn-label">
											<i class="ti-plus"></i>
										</span>
										{{ __('Thêm nhóm menu') }}
									</button>
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