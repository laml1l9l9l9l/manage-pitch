<div class="row">
    <div class="col-md-12">

    	@if (session('success'))
	    	<div class="alert alert-success">
	            <button type="button" aria-hidden="true" class="close">×</button>
	            <span>
	            	<i class="ti-check"></i>
	            	<b> Thành công - </b> {{ session('success') }}
	            </span>
	        </div>
    	@endif

    	@if (session('error'))
	        <div class="alert alert-danger">
	            <button type="button" aria-hidden="true" class="close">×</button>
	            <span>
	            	<i class="ti-close"></i>
	            	<b> Thất bại - </b> {{ session('error') }}
	            </span>
	        </div>
    	@endif

    </div>
</div>