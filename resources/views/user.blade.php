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
									List User
								</h3>
							</div>
						</div>
					</div>
					<div class="m-portlet__body">

						<!--begin::Section-->
						<div class="m-section">
							<div class="m-section__content">
								<table class="table table-striped m-table">
									<thead>
										<tr>
											<th>#</th>
											<th>Username</th>
											<th>Email</th>
											<th>Group</th>
											<th></th>
										</tr>
									</thead>
									<tbody>
										@foreach ($data['user'] as $key=>$value)
										<tr>
											<th scope="row">{{$key+1}}</th>
											<td>{{$value['name']}}</td>
											<td>{{$value['email']}}</td>
											@if ($value['group'] == 'Admin')
												<td><span class="m-badge  m-badge--danger m-badge--wide">{{$value['group']}}</span></td>
											@elseif ($value['group'] == 'BTV')
												<td><span class="m-badge  m-badge--primary m-badge--wide">{{$value['group']}}</span></td>
											@elseif ($value['group'] == 'BTV2')
												<td><span class="m-badge  m-badge--info m-badge--wide">{{$value['group']}}</span></td>
											@elseif ($value['group'] == 'Editor')
												<td><span class="m-badge  m-badge--brand m-badge--wide">{{$value['group']}}</span></td>
											@else
												<td><span class="m-badge  m-badge--focus m-badge--wide">{{$value['group']}}</span></td>
											@endif
											<td>
												<a href="{{env('APP_URL')}}/user/delete/{{$value['id']}}" class="btn btn-danger m-btn btn-sm m-btn m-btn--icon m_sweetalert_demo_8">
													<span>
														<i class="fa flaticon-delete"></i>
														<span>Delete</span>
													</span>
												</a>
												<a href="#" data-id="{{$value['id']}}" class="btn btn-info m-btn btn-sm m-btn m-btn--icon btn-change-password" data-toggle="modal" data-target="#m_modal_5">
													<span>
														<i class="fa flaticon-list"></i>
														<span>Change password</span>
													</span>
												</a>
												<a href="#" data-id="{{$value['id']}}" data-group-id="{{$value['group_id']}}" class="btn btn-primary m-btn btn-sm m-btn m-btn--icon btn-change-group" data-toggle="modal" data-target="#m_modal_6">
													<span>
														<i class="fa flaticon-user"></i>
														<span>Change Group</span>
													</span>
												</a>
											</td>
										</tr>
										@endforeach
									</tbody>
								</table>
							</div>
						</div>

						<!--end::Section-->
					</div>

					<!--end::Form-->
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
<!--begin::Modal-->
<div class="modal fade" id="m_modal_5" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-sm" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Change password</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form class="form-change-password" method="POST" action="{{env('APP_URL')}}/user/changePassword">
			<div class="modal-body">
				{{csrf_field()}}
				<input type="hidden" name="id" value="0">
				<div class="form-group">
					<label for="recipient-name" class="form-control-label">New password:</label>
					<input type="password" class="form-control" name="new_password">
				</div>
				<div class="form-group">
					<label for="recipient-name" class="form-control-label">Retype New password:</label>
					<input type="password" class="form-control" name="retype_new_password">
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-primary">Change password</button>
			</div>
			</form>
		</div>
	</div>
</div>
<!--end::Modal-->
<!--begin::Modal-->
<div class="modal fade" id="m_modal_6" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Change group & permission</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form class="form-change-group" method="POST" action="{{env('APP_URL')}}/user/changeGroup">
			<div class="modal-body">
				{{csrf_field()}}
				<input type="hidden" name="id" value="0">
				<div class="form-group m-form__group">
					<label for="exampleSelect1">Select group</label>
					<select name="group_id" class="form-control m-input m-input--air" id="exampleSelect1">
						@foreach ($data['group'] as $value)
						<option value="{{$value['id']}}">{{$value['name']}}</option>
					@endforeach
					</select>
				</div>
				@foreach ($data['group'] as $value)
					<div class="row group_permission group_id_{{$value['id']}}" style="display: none">
						@foreach ($value['permission'] as $value1)
							<div class="col-md-6"><span class="m--font-bold m--font-success" style="font-family: 'Arial'"><i style="vertical-align: -1.8px;" class="la la-check-circle"></i> {{$value1}}</span></div>
						@endforeach
					</div>
				@endforeach
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-primary">Change group</button>
			</div>
			</form>
		</div>
	</div>
</div>
<!--end::Modal-->
@include('layouts.footer')
</body>

<!-- end::Body -->
<script type="text/javascript">
	$(document).ready(function () {

		$(".form-change-group [name='group_id']").change(function () {
			var group_id = $(this).val();
			$(".group_permission").hide();
			$(".group_id_" + group_id).show();
		});

		$(".btn-change-group").click(function () {
			var id = $(this).attr('data-id');
			var group_id = $(this).attr('data-group-id');
			$(".form-change-group").find("option[value='"+group_id+"']").attr("selected", "selected");
			$(".group_permission").hide();
			$(".group_id_" + group_id).show();
			$(".form-change-group").find("[name='id']").val(id);
		});

		$(".btn-change-password").click(function () {
			var id = $(this).attr('data-id');
			$(".form-change-password").find("[name='id']").val(id);
		});

		$(".m_sweetalert_demo_8").click(function(e) {
			var url = $(this).attr('href');
			e.preventDefault();
	        swal({
	            title: "Are you sure?",
	            type: "warning",
	            showCancelButton: !0,
	            confirmButtonText: "Yes, delete it!"
	        }).then(function (isConfirm) {
	        	console.log(isConfirm);
	        	if(isConfirm.value) {
	        		location.href = url;
	        	}
	        });
	    });
	});
</script>