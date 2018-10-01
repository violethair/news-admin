@include('layouts.header')
<link href="{{env('APP_URL')}}/public/assets/vendors/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
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
				<div class="col-lg-4 col-md-4" style="margin: auto">
					<div class="m-portlet m-portlet--mobile m-portlet--body-progress-">
						<div class="m-portlet__head">
							<div class="m-portlet__head-caption">
								<div class="m-portlet__head-title">
									<h3 class="m-portlet__head-text">
										Basic Info
									</h3>
								</div>
							</div>
						</div>
						<div class="m-portlet__body">
							<form action="{{env('APP_URL')}}/category/add" method="POST">
								{{ csrf_field() }}
								<div class="form-group m-form__group row">
									<label class="col-form-label" style="padding-left: 15px;">Parent</label>
									<div class="col-lg-12 col-md-12 col-sm-12">
										<select class="form-control m-select2" id="m_select2_1" name="parent_id">
											<option value="0">SELECT PARENT CATEGORY</option>
											@foreach($data as $key=>$value)
											<option value="{{$value['id']}}">{{$value['name']}}</option>
											@endforeach
										</select>
									</div>
								</div>
								<div class="form-group m-form__group">
									<label for="exampleInputEmail1">Name</label>
									<input type="text" class="form-control m-input" name="name">
								</div>
								<div class="form-group m-form__group">
									<label for="exampleInputEmail1">Description</label>
									<input type="text" class="form-control m-input" name="meta_des">
								</div>
								<div class="form-group m-form__group">
									<label for="exampleInputEmail1">Keyword</label>
									<input type="text" class="form-control m-input" name="meta_key">
								</div>
								<center><button type="submit" class="btn btn-primary">ADD NEW</button></center>
							</form>
						</div>
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
<script src="{{env('APP_URL')}}/public/assets/demo/default/custom/crud/forms/widgets/select2.js" type="text/javascript"></script>
<!-- end::Body -->