@include('layouts.header')
<style type="text/css">
	.category_nav .m-nav__link-text,
	.category_nav .m-nav__link-icon {
		font-size: 22px !important;

	}

	.category_nav .m-nav__item {
		position: relative;
	}

	.category_nav .btn-edit {
		position: absolute;
		z-index: 1;
	    right: 16px;
    	top: 5px;
	}

	.category_nav .m-nav__link-text{
		display: inline !important;
	}

	.category_nav .m-nav__link-wrap {
		display: block !important;
	}
	.category_nav .m-nav__sub .m-nav__link-text {
		font-size: 18px !important;
	}
</style>
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
				<div class="m-demo" data-code-preview="true" data-code-html="true" data-code-js="false">
					<div class="m-demo__preview">
						<ul class="m-nav m-nav--active-bg category_nav" id="m_nav" role="tablist">
							@foreach($data as $key=>$value)
							<li class="m-nav__item m-nav__item--active">
								<a title="Edit" href="{{env('APP_URL')}}/category/edit/{{ $value['id'] }}" class="btn btn-success m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air btn-edit">
									<i class="fa flaticon-edit"></i>
								</a>
								<a class="m-nav__link" role="tab" id="m_nav_link_{{$key + 1}}" data-toggle="collapse" href="#m_nav_sub_{{$key + 1}}" aria-expanded=" false">
									<i class="m-nav__link-icon flaticon-list-2"></i>
									<span class="m-nav__link-title">
										<span class="m-nav__link-wrap">
											<span class="m-nav__link-text">{{ $value['name'] }}</span>
										</span>
									</span>
									<span style="float:right;margin-top: 5px;margin-right: 27px;" class="m-badge m-badge--success m-badge--wide">{{ $value['numberPost'] }} posts</span>
								</a>
								<ul class="m-nav__sub collapse show" id="m_nav_sub_{{$key + 1}}" role="tabpanel" aria-labelledby="m_nav_link_{{$key + 1}}" data-parent="#m_nav">
									@foreach($value['child'] as $key1=>$value1)
									<li class="m-nav__item">
										<a href="{{env('APP_URL')}}/category/edit/{{ $value1['id'] }}" class="m-nav__link">
											<span class="m-nav__link-bullet m-nav__link-bullet--line"><span></span></span>
											<span class="m-nav__link-text">{{$value1['name']}}</span>
											<span style="float:right;margin-right: 17px;" class="m-badge m-badge--info m-badge--wide">{{ $value1['numberPost'] }} posts</span>
											<a title="Edit" href="{{env('APP_URL')}}/category/edit/{{ $value1['id'] }}" style="width: 30px;height: 30px;" class="btn btn-info m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air btn-edit">
												<i class="fa flaticon-edit"></i>
											</a>
										</a>
									</li>
									@endforeach
								</ul>
							</li>
							@endforeach
						</ul>
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