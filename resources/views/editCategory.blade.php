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
				<div class="row">
					<div class="col-lg-4 col-md-4">
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
								<form action="{{env('APP_URL')}}/category/edit" method="POST">
									{{ csrf_field() }}
									<input type="hidden" name="id" value="{{ $data['id'] }}">
									@if($data['allCategory'])
									<div class="form-group m-form__group row">
										<label class="col-form-label" style="padding-left: 15px;">Parent</label>
										<div class="col-lg-12 col-md-12 col-sm-12">
											<select class="form-control m-select2" id="m_select2_1" name="parent_id">
												@foreach($data['allCategory'] as $key=>$value)
												@if($value['id'] == $data['parent_id'])
												<option value="{{$value['id']}}" selected="selected">{{$value['name']}}</option>
												@else
												<option value="{{$value['id']}}">{{$value['name']}}</option>
												@endif
												@endforeach
											</select>
										</div>
									</div>
									@endif
									<div class="form-group m-form__group">
										<label for="exampleInputEmail1">Name</label>
										<input type="text" class="form-control m-input" name="name" value="{{$data['name']}}">
									</div>
									<div class="form-group m-form__group">
										<label for="exampleInputEmail1">Description</label>
										<input type="text" class="form-control m-input" name="meta_des" value="{{$data['meta_des']}}">
									</div>
									<div class="form-group m-form__group">
										<label for="exampleInputEmail1">Keyword</label>
										<input type="text" class="form-control m-input" name="meta_key" value="{{$data['meta_key']}}">
									</div>
									<center><button type="submit" class="btn btn-primary">SAVE</button></center>
								</form>
							</div>
						</div>
					</div>
					<div class="col-lg-8 col-md-8">
						<div class="m-portlet m-portlet--mobile m-portlet--body-progress-">
							<div class="m-portlet__head">
								<div class="m-portlet__head-caption">
									<div class="m-portlet__head-title">
										<h3 class="m-portlet__head-text">
											List post in {{$data['name']}}
										</h3>
									</div>
								</div>
							</div>
							<div class="m-portlet__body">
								<table class="table table-striped- table-bordered table-hover table-checkable" id="m_table_1">
								<thead>
									<tr>
										<th>ID</th>
										<th>Category</th>
										<th>Title</th>
										<th style="width: 10%;">Status</th>
										<th style="width: 15%;">Actions</th>
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
<script src="{{env('APP_URL')}}/public/assets/vendors/custom/datatables/datatables.bundle.js" type="text/javascript"></script>
<!-- end::Body -->
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
                	if(n[3] == 'publish') {
                		return '\n<a href="{{env('APP_URL')}}/posts/edit/'+n[0]+'" class="m-portlet__nav-link btn m-btn btn btn-outline-primary m-btn--icon m-btn--icon-only m-btn--pill" title="Edit">\n<i class="la la-edit"></i>\n</a>\n<a href="{{env('APP_URL')}}/posts/status_pending/'+n[0]+'" class="m-portlet__nav-link btn btn-outline-warning m-btn--icon m-btn--icon-only m-btn--pill" title="Pending">\n<i class="la la-clock-o"></i>\n</a>\n<a href="{{env('APP_URL')}}/posts/status_delete/'+n[0]+'" class="m-portlet__nav-link btn btn-outline-danger m-btn--icon m-btn--icon-only m-btn--pill" title="Delete">\n<i class="la la-trash"></i>\n</a>'
                	} else {
                		return '\n<a href="{{env('APP_URL')}}/posts/edit/'+n[0]+'" class="m-portlet__nav-link btn m-btn btn btn-outline-primary m-btn--icon m-btn--icon-only m-btn--pill" title="Edit">\n<i class="la la-edit"></i>\n</a>\n<a href="{{env('APP_URL')}}/posts/status_publish/'+n[0]+'" class="m-portlet__nav-link btn btn-outline-success m-btn--icon m-btn--icon-only m-btn--pill btn-publish" title="Publish">\n<i class="la la-check"></i>\n</a>\n<a href="{{env('APP_URL')}}/posts/status_delete/'+n[0]+'" class="m-portlet__nav-link btn btn-outline-danger m-btn--icon m-btn--icon-only m-btn--pill" title="Delete">\n<i class="la la-trash"></i>\n</a>'
                	}
                    
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
$.get('{{env('APP_URL')}}/api/loadMorePostInCategory/{{$data['id']}}', function (res) {
	var res = JSON.parse(res);
	DatatablesBasicPaginations.init(res);
});

$(".btn-load-more").click(function () {
	$(this).addClass('m-loader m-loader--right m-loader--light');
	$(this).attr('disabled', 'disabled');
	var page = parseInt($(this).attr('data-page'));
	$.get('{{env('APP_URL')}}/api/loadMorePostInCategory/{{$data['id']}}/' + page, function (res) {
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
</script>