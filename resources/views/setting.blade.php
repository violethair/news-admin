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
				<div class="m-portlet">
					<div class="m-portlet__head">
						<div class="m-portlet__head-caption">
							<div class="m-portlet__head-title">
								<h3 class="m-portlet__head-text">
									Settings
								</h3>
							</div>
						</div>
					</div>
					<div class="m-portlet__body">
						<form action="{{env('APP_URL')}}/settings" method="POST">
							{{ csrf_field() }}
							<ul class="nav nav-tabs" role="tablist">
								<li class="nav-item">
									<a class="nav-link active" data-toggle="tab" href="#m_tabs_1_1">
										<i class="la la-cog"></i> Basic Setting
									</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" data-toggle="tab" href="#m_tabs_1_2">
										<i class="la la-desktop"></i> SEO Setting
									</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" data-toggle="tab" href="#m_tabs_1_3">
										<i class="la la-share-alt"></i> Social Network Setting
									</a>
								</li>
							</ul>
							<div class="tab-content">
								<div class="tab-pane active" id="m_tabs_1_1" role="tabpanel">
									<div class="form-group m-form__group">
										<label for="exampleInputEmail1">Title</label>
										<input type="text" class="form-control m-input" name="title" value="{{ $data['title'] }}">
									</div>
									<div class="form-group m-form__group">
										<label for="exampleInputEmail1">Email</label>
										<input type="text" class="form-control m-input" name="email" value="{{ $data['email'] }}">
									</div>
									<div class="form-group m-form__group">
										<label for="exampleInputEmail1">Footer info</label>
										<input type="text" class="form-control m-input" name="footer" value="{{ $data['footer'] }}">
									</div>
									<div class="form-group m-form__group">
										<label for="exampleInputEmail1">Contact info</label>
										<textarea class="form-control m-input" name="contactinfo" id="exampleTextarea" rows="5">{!! $data['contactinfo'] !!}</textarea>
									</div>
								</div>
								<div class="tab-pane" id="m_tabs_1_2" role="tabpanel">
									<div class="form-group m-form__group">
										<label for="exampleInputEmail1">Keywords</label>
										<textarea class="form-control m-input" name="meta_key" id="exampleTextarea" rows="2">{!! $data['meta_key'] !!}</textarea>
									</div>
									<div class="form-group m-form__group">
										<label for="exampleInputEmail1">Description</label>
										<textarea class="form-control m-input" name="meta_des" id="exampleTextarea" rows="2">{!! $data['meta_des'] !!}</textarea>
									</div>
								</div>
								<div class="tab-pane" id="m_tabs_1_3" role="tabpanel">
									<div class="form-group m-form__group">
										<label for="exampleInputEmail1">Facebook</label>
										<input type="text" class="form-control m-input" name="facebook" value="{{ $data['facebook'] }}">
									</div>
									<div class="form-group m-form__group">
										<label for="exampleInputEmail1">Twitter</label>
										<input type="text" class="form-control m-input" name="tiwter" value="{{ $data['tiwter'] }}">
									</div>
									<div class="form-group m-form__group">
										<label for="exampleInputEmail1">Google Plus</label>
										<input type="text" class="form-control m-input" name="google" value="{{ $data['google'] }}">
									</div>
									<div class="form-group m-form__group">
										<label for="exampleInputEmail1">Youtube</label>
										<input type="text" class="form-control m-input" name="youtube" value="{{ $data['youtube'] }}">
									</div>
									<div class="form-group m-form__group">
										<label for="exampleInputEmail1">Reddit</label>
										<input type="text" class="form-control m-input" name="reddit" value="{{ $data['reddit'] }}">
									</div>
								</div>
							</div>
							<button type="submit" class="btn btn-primary btn-lg m-btn m-btn--custom">SAVE</button>
						</form>
					</div>
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