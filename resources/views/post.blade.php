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
									<th>User</th>
									<th>Publish Date</th>
									<th>Status</th>
									<th width="150">Actions</th>
								</tr>
							</thead>
							<tbody>
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
var t;
$.fn.dataTable.Api.register("column().title()", function() {
    return $(this.header()).text().trim()
});
var DatatablesBasicPaginations = {
    init: function(data) {
        t = $("#m_table_1").DataTable({
        	"pageLength": 50,
        	"processing": true,
	        "serverSide": true,
	        "ajax": "{{env('APP_URL')}}/api/loadMorePost",
	        initComplete: function() {
                var a = $('<tr class="filter"></tr>').appendTo($(t.table().header()));
                this.api().columns().every(function() {
                    var e;
                    switch (this.title()) {
                        case "ID":
                        case "Title":
                        	e = $('<input type="text" class="form-control form-control-sm form-filter m-input" data-col-index="' + this.index() + '"/>');
                                break;
                        case "User":
                            var n = {!! $data['userJson'] !!};
                            e = $('<select class="form-control form-control-sm form-filter m-input" title="Select" data-col-index="' + this.index() + '"><option value="">Select</option></select>'), 
                            	$.each(n, function (key,val) {
                            		$(e).append('<option value="' + val.id + '">' + val.name + "</option>")
                            	})
                        	break;
                        case "Category":
                        	var n = {!! $data['categoryJson'] !!};
                            e = $('<select class="form-control form-control-sm form-filter m-input" title="Select" data-col-index="' + this.index() + '"><option value="">Select</option></select>'), 
                            	$.each(n, function (key,val) {
                            		$(e).append('<option value="' + val.id + '">' + val.name + "</option>")
                            	})
                        	break;
                        case "Status":
                        	var n = [{id: "pending", name: "Pending"}, {id: "publish", name: "Published"}, {id: "delete", name: "Deleted"}];
                            e = $('<select class="form-control form-control-sm form-filter m-input" title="Select" data-col-index="' + this.index() + '"><option value="">Select</option></select>'), 
                            	$.each(n, function (key,val) {
                            		$(e).append('<option value="' + val.id + '">' + val.name + "</option>")
                            	})
                        	break;
                        case "Actions":
                            var i = $('<button class="btn btn-brand m-btn btn-sm m-btn--icon" style="height: 20px;width: 39px;"><span><i class="la la-search"></i><span></span>  </span></button>'),
                                s = $('<button class="btn btn-secondary m-btn btn-sm m-btn--icon" style="height: 20px;width: 39px;margin-top:0px;margin-left:10px">\n\t\t\t\t\t\t\t  <span>\n\t\t\t\t\t\t\t    <i class="la la-close"></i>\n\t\t\t\t\t\t\t    <span></span>\n\t\t\t\t\t\t\t  </span>\n\t\t\t\t\t\t\t</button>');
                            $("<th>").append(i).append(s).appendTo(a), $(i).on("click", function(e) {
                                e.preventDefault();
                                var n = {};
                                $(a).find(".m-input").each(function() {
                                    var t = $(this).data("col-index");
                                    n[t] ? n[t] += "|" + $(this).val() : n[t] = $(this).val()
                                }), $.each(n, function(a, e) {
                                    t.column(a).search(e || "", !1, !1)
                                }), t.table().draw()
                            }), $(s).on("click", function(e) {
                                e.preventDefault(), $(a).find(".m-input").each(function(a) {
                                    $(this).val(""), t.column($(this).data("col-index")).search("", !1, !1)
                                }), t.table().draw()
                            })
                    }
                    $(e).appendTo($("<th>").appendTo(a))
                }), $("#m_datepicker_1,#m_datepicker_2").datepicker()
            },
        	order: [[0,'desc']],
        	paging: true,
            responsive: !0,
            pagingType: "full_numbers",
            "columns": [
		        { "name": "id"},
		        { "name": "cat_id"},
		        { "name": "name"},
		        { "name": "user_id"},
		        { "name": "publish_at"},
		        { "name": "status"},
		        { "name": "action"},
		    ],
            columnDefs: [{
                targets: -1,
                title: "Actions",
                orderable: !1,
                render: function(a, e, n, t) {

                	console.log(n);

                	var html = '\n<a style="margin-right:5px" href="{{env('APP_URL')}}/posts/edit/'+n[0]+'" class="m-portlet__nav-link btn m-btn btn btn-outline-primary m-btn--icon m-btn--icon-only m-btn--pill" title="Edit">\n<i class="la la-edit"></i>\n</a>';

                	if(n[5] != 'pending') {
                		html += '<a style="margin-right:5px" href="{{env('APP_URL')}}/posts/status_pending/'+n[0]+'" class="m-portlet__nav-link btn btn-outline-warning m-btn--icon m-btn--icon-only m-btn--pill" title="Pending">\n<i class="la la-clock-o"></i>\n</a>';
                	} else {
                		html += '<a style="margin-right:5px" href="{{env('APP_URL')}}/posts/status_publish/'+n[0]+'" class="m-portlet__nav-link btn btn-outline-success m-btn--icon m-btn--icon-only m-btn--pill btn-publish" title="Publish"><i class="la la-check"></i>\n</a>';
                	}

                    html += '<a href="{{env('APP_URL')}}/posts/status_delete/'+n[0]+'" class="m-portlet__nav-link btn btn-outline-danger m-btn--icon m-btn--icon-only m-btn--pill" title="Delete">\n<i class="la la-trash"></i>\n</a>'

                    return html;
                }
            }, {
            	targets: 2,
            	render : function (a,e,n,t){
            		return '<b>'+a+'</b>';
            	}
            },
            {
                targets: 5,
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
	DatatablesBasicPaginations.init();

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