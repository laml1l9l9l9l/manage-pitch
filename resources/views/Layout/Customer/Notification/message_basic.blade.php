<div class="row">
    <div class="col-md-12">

    	@if (session('success'))
	    	<div class="alert alert-success alert-rounded alert-message">
	    		<div class="alert-icon">
	    			<i class="material-icons">check</i>
	    		</div>
	    		<h4 class="m-0" id="message">
	    			{{ session('success') }}
	    		</h4>
	    		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
	    			<span aria-hidden="true">
	    				<i class="material-icons">clear</i>
	    			</span>
	    		</button>
	    	</div>
    	@endif

    	@if (session('error'))
	    	<div class="alert alert-danger alert-rounded alert-message">
	    		<div class="alert-icon">
	    			<i class="material-icons">close</i>
	    		</div>
	    		<h4 class="m-0" id="message">
	    			{{ session('error') }}
	    		</h4>
	    		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
	    			<span aria-hidden="true">
	    				<i class="material-icons">clear</i>
	    			</span>
	    		</button>
	    	</div>
    	@endif

    </div>
</div>