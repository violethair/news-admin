@include('layouts.header')
<!-- begin::Body -->
<body class="m-page--fluid m--skin- m-content--skin-light2 m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--fixed m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default">

<!-- begin:: Page -->
<div class="m-grid m-grid--hor m-grid--root m-page">

	<!-- BEGIN: Header -->
	@include('layouts.topbar')
	<!-- END: Header -->

	<!-- begin::Body -->
	<div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-body">

		<!-- BEGIN: Left Aside -->
		<button class="m-aside-left-close  m-aside-left-close--skin-dark " id="m_aside_left_close_btn"><i class="la la-close"></i></button>
		<div id="m_aside_left" class="m-grid__item	m-aside-left  m-aside-left--skin-dark ">
			@include('layouts.sidebar')
		</div>

		<!-- END: Left Aside -->
		<div class="m-grid__item m-grid__item--fluid m-wrapper">
			<div class="m-content">
				@include('layouts.searchPost')
				<div class="m-portlet ">
					<div class="m-portlet__body  m-portlet__body--no-padding">
						<div class="row m-row--no-padding m-row--col-separator-xl">
							<div class="col-md-12 col-lg-6 col-xl-3">
								<!--begin::Total Profit-->
								<div class="m-widget24" style="padding-bottom: 40px;">					 
								    <div class="m-widget24__item">
								        <h4 class="m-widget24__title">
								            Total Post
								        </h4><br>
								        <span class="m-widget24__desc">
								            All Post Value
								        </span>
								        <span class="m-widget24__stats m--font-brand">
								            {{$data['totalPost']}}
								        </span>		
								        <div class="m--space-10"></div>
										<div class="progress m-progress--sm">
											<div class="progress-bar m--bg-brand" role="progressbar" style="width: 100%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
										</div>
								    </div>				      
								</div>
								<!--end::Total Profit-->
							</div>
							<div class="col-md-12 col-lg-6 col-xl-3">
								<!--begin::New Feedbacks-->
								<div class="m-widget24">
									 <div class="m-widget24__item">
								        <h4 class="m-widget24__title">
								            Total Category
								        </h4><br>
								        <span class="m-widget24__desc">
								            All Category Value
								        </span>
								        <span class="m-widget24__stats m--font-info">
								            {{$data['totalCategory']}}
								        </span>		
								        <div class="m--space-10"></div>
										<div class="progress m-progress--sm">
											<div class="progress-bar m--bg-info" role="progressbar" style="width: 100%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
										</div>
								    </div>		
								</div>
								<!--end::New Feedbacks--> 
							</div>
							<div class="col-md-12 col-lg-6 col-xl-3">
								<!--begin::New Orders-->
								<div class="m-widget24">
									<div class="m-widget24__item">
								        <h4 class="m-widget24__title">
								            Total Press Release
								        </h4><br>
								        <span class="m-widget24__desc">
								            All Press Release Value
								        </span>
								        <span class="m-widget24__stats m--font-danger">
								            {{$data['totalPressRelease']}}
								        </span>		
								        <div class="m--space-10"></div>
										<div class="progress m-progress--sm">
											<div class="progress-bar m--bg-danger" role="progressbar" style="width: 100%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
										</div>
								    </div>		
								</div>
								<!--end::New Orders--> 
							</div>
							<div class="col-md-12 col-lg-6 col-xl-3">
								<!--begin::New Users-->
								<div class="m-widget24">
									 <div class="m-widget24__item">
								        <h4 class="m-widget24__title">
								            Total Video
								        </h4><br>
								        <span class="m-widget24__desc">
								            All Video Value
								        </span>
								        <span class="m-widget24__stats m--font-success">
								            {{$data['totalVideo']}} 
								        </span>		
								        <div class="m--space-10"></div>
								        <div class="progress m-progress--sm">
											<div class="progress-bar m--bg-success" role="progressbar" style="width: 100%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
										</div>
								    </div>		
								</div>
								<!--end::New Users--> 
							</div>
						</div>
					</div>
				</div>
				<div style="text-align: center">
					<a href="{{env('APP_URL')}}/category/add" class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--pill m-btn--air" style="margin-right: 20px;">
						<span>
							<i class="fa flaticon-add"></i>
							<span>New Category</span>
						</span>
					</a>
					<a href="{{env('APP_URL')}}/posts/new" class="btn btn-success m-btn m-btn--custom m-btn--icon m-btn--pill m-btn--air">
						<span>
							<i class="fa flaticon-add-circular-button"></i>
							<span>New Post</span>
						</span>
					</a>
				</div>
			</div>
		</div>
	</div>

	<!-- end:: Body -->
</div>

<!-- end:: Page -->

<!-- begin::Scroll Top -->
<div id="m_scroll_top" class="m-scroll-top">
	<i class="la la-arrow-up"></i>
</div>

<!-- end::Scroll Top -->

@include('layouts.footer')
</body>

<!-- end::Body -->