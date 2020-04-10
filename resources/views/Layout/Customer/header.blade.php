<nav class="navbar navbar-default navbar-transparent navbar-fixed-top navbar-color-on-scroll" color-on-scroll=" " id="sectionsNav">
	<div class="container">
    	<!-- Brand and toggle get grouped for better mobile display -->
    	<div class="navbar-header">
    		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example">
        		<span class="sr-only">Toggle navigation</span>
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
    		</button>
    		<a class="navbar-brand" href="{{ route('customer.home') }}" title="{{ __('Trang chủ') }}">
				<img src="{{ asset('custom/img/logo_transparent.png') }}" alt="Logo" width="80px">
    		</a>
    	</div>

    	<div class="collapse navbar-collapse">
    		<ul class="nav navbar-nav navbar-right">

                @if(Auth::guard('web')->check())
					<li>
						<a href="../index.html">
							<i class="material-icons">apps</i> Components
						</a>
					</li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<i class="material-icons">view_day</i> Sections
							<b class="caret"></b>
						</a>
						<ul class="dropdown-menu dropdown-with-icons">
							<li>
								<a href="../sections.html#headers">
									<i class="material-icons">dns</i> Headers
								</a>
							</li>
							<li>
								<a href="../sections.html#features">
									<i class="material-icons">build</i> Features
								</a>
							</li>
							<li>
								<a href="../sections.html#blogs">
									<i class="material-icons">list</i> Blogs
								</a>
							</li>
							<li>
								<a href="../sections.html#teams">
									<i class="material-icons">people</i> Teams
								</a>
							</li>
							<li>
								<a href="../sections.html#projects">
									<i class="material-icons">assignment</i> Projects
								</a>
							</li>
							<li>
								<a href="../sections.html#pricing">
									<i class="material-icons">monetization_on</i> Pricing
								</a>
							</li>
							<li>
								<a href="../sections.html#testimonials">
									<i class="material-icons">chat</i> Testimonials
								</a>
							</li>
							<li>
								<a href="../sections.html#contactus">
									<i class="material-icons">call</i> Contacts
								</a>
							</li>

						</ul>
					</li>

					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<i class="material-icons">view_carousel</i> Examples
							<b class="caret"></b>
						</a>
						<ul class="dropdown-menu dropdown-with-icons">
							<li>
								<a href="../examples/about-us.html">
									<i class="material-icons">account_balance</i> About Us
								</a>
							</li>
							<li>
								<a href="../examples/blog-post.html">
									<i class="material-icons">art_track</i> Blog Post
								</a>
							</li>
							<li>
								<a href="../examples/blog-posts.html">
									<i class="material-icons">view_quilt</i> Blog Posts
								</a>
							</li>
							<li>
								<a href="../examples/contact-us.html">
									<i class="material-icons">location_on</i> Contact Us
								</a>
							</li>
							<li>
								<a href="../examples/landing-page.html">
									<i class="material-icons">view_day</i> Landing Page
								</a>
							</li>
							<li>
								<a href="../examples/login-page.html">
									<i class="material-icons">fingerprint</i> Login Page
								</a>
							</li>
							<li>
								<a href="../examples/pricing.html">
									<i class="material-icons">attach_money</i> Pricing Page
								</a>
							</li>
							<li>
								<a href="../examples/ecommerce.html">
									<i class="material-icons">shop</i> Ecommerce Page
								</a>
							</li>
							<li>
								<a href="../examples/product-page.html">
									<i class="material-icons">beach_access</i> Product Page
								</a>
							</li>
							<li>
								<a href="../examples/profile-page.html">
									<i class="material-icons">account_circle</i> Profile Page
								</a>
							</li>
							<li>
								<a href="../examples/signup-page.html">
									<i class="material-icons">person_add</i> Signup Page
								</a>
							</li>
						</ul>
					</li>

					<li>
						<a href="http://www.creative-tim.com/buy/material-kit-pro?ref=presentation" target="_blank" class="btn btn-white btn-simple">
							<i class="material-icons">shopping_cart</i> Buy Now
						</a>
					</li>
				@else
					<li>
						<a href="{{ route('customer.login') }}" title="{{ __('Đăng nhập') }}">
							<i class="material-icons">person</i> Đăng nhập
						</a>
					</li>
					<li>
						<a href="{{ route('customer.register') }}" title="{{ __('Đăng ký') }}">
							<i class="material-icons">list_alt</i> Đăng ký
						</a>
					</li>
				@endif
    		</ul>
    	</div>
	</div>
</nav>