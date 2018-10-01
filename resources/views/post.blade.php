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
				@include('layouts.searchPost')
				<div class="m-portlet m-portlet--mobile">
					<div class="m-portlet__head">
						<div class="m-portlet__head-caption">
							<div class="m-portlet__head-title">
								<h3 class="m-portlet__head-text">
									Pending Post
								</h3>
							</div>
						</div>
						<div class="m-portlet__head-tools">
							<ul class="m-portlet__nav">
								<li class="m-portlet__nav-item">
									<a href="{{env('APP_URL')}}/posts/add" class="btn btn-success m-btn m-btn--custom m-btn--icon m-btn--air">
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
						<table class="table table-striped- table-bordered table-hover table-checkable" id="m_table_2">
							<thead>
								<tr>
									<th>ID</th>
									<th>Category</th>
									<th>Title</th>
									<th>Status</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody>
								@foreach($data as $key=>$value)
								<tr>
									<td>{{ $value['id'] }}</td>
									<td>{{ $value['category'] }}</td>
									<td><b>{{ $value['name'] }}</b></td>
									<td>{{ $value['status'] }}</td>
									<td nowrap></td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
				<div class="m-portlet m-portlet--mobile">
					<div class="m-portlet__head">
						<div class="m-portlet__head-caption">
							<div class="m-portlet__head-title">
								<h3 class="m-portlet__head-text">
									List Post
								</h3>
							</div>
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
									<th>Publish Date</th>
									<th>Status</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody>
							</tbody>
						</table>
						<center><button type="button" data-page=1 class="btn m-btn--pill m-btn--air m-btn m-btn--gradient-from-info m-btn--gradient-to-accent btn-load-more">Load more</button></center>
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
var dataTable = null;
var DatatablesBasicPaginations = {
    init: function(data) {
        dataTable = $("#m_table_1").DataTable({
        	data: data,
        	order: [[0,'desc']],
        	paging: false,
            responsive: !0,
            pagingType: "full_numbers",
            columnDefs: [{
                targets: -1,
                title: "Actions",
                orderable: !1,
                render: function(a, e, n, t) {
                	console.log(n);
                    return '\n<a href="{{env('APP_URL')}}/posts/edit/'+n[0]+'" class="m-portlet__nav-link btn m-btn btn btn-outline-primary m-btn--icon m-btn--icon-only m-btn--pill" title="Edit">\n<i class="la la-edit"></i>\n</a>\n<a href="{{env('APP_URL')}}/posts/status_pending/'+n[0]+'" class="m-portlet__nav-link btn btn-outline-warning m-btn--icon m-btn--icon-only m-btn--pill" title="Pending">\n<i class="la la-clock-o"></i>\n</a>\n<a href="{{env('APP_URL')}}/posts/status_delete/'+n[0]+'" class="m-portlet__nav-link btn btn-outline-danger m-btn--icon m-btn--icon-only m-btn--pill" title="Delete">\n<i class="la la-trash"></i>\n</a>'
                }
            }, {
            	targets: 2,
            	render : function (a,e,n,t){
            		return '<b>'+a+'</b>';
            	}
            },
            {
                targets: 4,
                render: function(a, e, n, t) {
                    var s = {
                        'pending': {
                            title: "Pending",
                            class: "m-badge--warning"
                        },
                        'draff': {
                            title: "Draff",
                            class: "m-badge--primary"
                        },
                        'publish': {
                            title: "Published",
                            class: " m-badge--success"
                        },
                        'delete': {
                            title: "Deleted",
                            class: " m-badge--danger"
                        }
                    };
                    return void 0 === s[a] ? a : '<span class="m-badge ' + s[a].class + ' m-badge--wide">' + s[a].title + "</span>"
                }
            }]
        })
    }
};
var DatatablesBasicPaginations1 = {
    init: function(data) {
        $("#m_table_2").DataTable({
        	data: data,
        	order: [[0,'desc']],
        	paging: false,
            responsive: !0,
            pagingType: "full_numbers",
            columnDefs: [{
                targets: -1,
                title: "Actions",
                orderable: !1,
                render: function(a, e, n, t) {
                	console.log(n);
                    return '\n<a href="{{env('APP_URL')}}/posts/edit/'+n[0]+'" class="m-portlet__nav-link btn m-btn btn btn-outline-primary m-btn--icon m-btn--icon-only m-btn--pill" title="Edit">\n<i class="la la-edit"></i>\n</a>\n<a href="{{env('APP_URL')}}/posts/status_publish/'+n[0]+'" class="m-portlet__nav-link btn btn-outline-success m-btn--icon m-btn--icon-only m-btn--pill btn-publish" title="Publish">\n<i class="la la-check"></i>\n</a>\n<a href="{{env('APP_URL')}}/posts/status_delete/'+n[0]+'" class="m-portlet__nav-link btn btn-outline-danger m-btn--icon m-btn--icon-only m-btn--pill" title="Delete">\n<i class="la la-trash"></i>\n</a>'
                }
            }, {
            	targets: 2,
            	render : function (a,e,n,t){
            		return '<b>'+a+'</b>';
            	}
            },
            {
                targets: 3,
                render: function(a, e, n, t) {
                    var s = {
                        'pending': {
                            title: "Pending",
                            class: "m-badge--warning"
                        },
                        'draff': {
                            title: "Draff",
                            class: "m-badge--primary"
                        },
                        'publish': {
                            title: "Published",
                            class: " m-badge--success"
                        },
                        'delete': {
                            title: "Deleted",
                            class: " m-badge--danger"
                        }
                    };
                    return void 0 === s[a] ? a : '<span class="m-badge ' + s[a].class + ' m-badge--wide">' + s[a].title + "</span>"
                }
            }]
        })
    }
};
jQuery(document).ready(function() {
	$.get('{{env('APP_URL')}}/api/loadMorePost', function (res) {
		var res = JSON.parse(res);
		DatatablesBasicPaginations.init(res);
		DatatablesBasicPaginations1.init();
	});

	$(".btn-load-more").click(function () {
		$(this).addClass('m-loader m-loader--right m-loader--light');
		$(this).attr('disabled', 'disabled');
		var page = parseInt($(this).attr('data-page'));
		$.get('{{env('APP_URL')}}/api/loadMorePost/' + page, function (res) {
			var res = JSON.parse(res);
			$.each(res, function (key,val) {
				dataTable.row.add(val);
				if(key == res.length - 1) {
					dataTable.draw();
					$(".btn-load-more").removeClass('m-loader m-loader--right m-loader--light');
					$(".btn-load-more").attr('data-page',page+1);
					$(".btn-load-more").removeAttr('disabled');
				}
			})
		});
	});
});
</script>

<!-- end::Body -->