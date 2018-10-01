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
				<div class="m-portlet m-portlet--mobile">
					<div class="m-portlet__head">
						<div class="m-portlet__head-caption">
							<div class="m-portlet__head-title">
								<h3 class="m-portlet__head-text">
									List Post
								</h3>
							</div>
						</div>
						<div class="m-portlet__head-tools">
							<ul class="m-portlet__nav">
								<li class="m-portlet__nav-item">
									<a href="{{env('APP_URL')}}/post/new" class="btn btn-success m-btn m-btn--custom m-btn--icon m-btn--air">
										<span>
											<i class="la la-plus"></i>
											<span>New Post</span>
										</span>
									</a>
								</li>
								<li class="m-portlet__nav-item"></li>
							</ul>
						</div>
					</div>
					<div class="m-portlet__body">

						<!--begin: Datatable -->
						<table class="table table-striped- table-bordered table-hover table-checkable" id="m_table_1">
							<thead>
								<tr>
									<th>ID</th>
									<th>Category</th>
									<th>Title</th>
									<th>Short Description</th>
									<th>Publish Date</th>
									<th>Status</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>1</td>
									<td>61715-075</td>
									<td>China</td>
									<td>Tieba</td>
									<td>12/12/2018 12:00:00</td>
									<td>0</td>
									<td nowrap></td>
								</tr>
							</tbody>
						</table>
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
<script src="{{env('APP_URL')}}/public/assets/vendors/custom/datatables/datatables.bundle.js" type="text/javascript"></script>
<script type="text/javascript">
var DatatablesBasicPaginations = {
    init: function() {
        $("#m_table_1").DataTable({
            responsive: !0,
            pagingType: "full_numbers",
            columnDefs: [{
                targets: -1,
                title: "Actions",
                orderable: !1,
                render: function(a, e, n, t) {
                    return '\n<a href="#" class="m-portlet__nav-link btn m-btn btn btn-outline-primary m-btn--icon m-btn--icon-only m-btn--pill" title="Edit">\n<i class="la la-edit" style="top:48%;"></i>\n</a>\n<a href="#" class="m-portlet__nav-link btn btn-outline-danger m-btn--icon m-btn--icon-only m-btn--pill" title="Delete">\n<i class="la la-trash" style="top:48%;"></i>\n</a>'
                }
            }, {
                targets: 5,
                render: function(a, e, n, t) {
                    var s = {
                        0: {
                            title: "Pending",
                            class: "m-badge--warning"
                        },
                        1: {
                            title: "Published",
                            class: " m-badge--success"
                        }
                    };
                    return void 0 === s[a] ? a : '<span class="m-badge ' + s[a].class + ' m-badge--wide">' + s[a].title + "</span>"
                }
            }]
        })
    }
};
jQuery(document).ready(function() {
    DatatablesBasicPaginations.init()
});
</script>

<!-- end::Body -->