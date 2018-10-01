@include('layouts.header')
<link rel="stylesheet" type="text/css" href="{{env('APP_URL')}}/public/css/bootstrap-tagsinput.css">
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
					<div class="col-lg-6">
						<div class="m-portlet m-portlet--last m-portlet--head-lg m-portlet--responsive-mobile" id="main_portlet">
							<div class="m-portlet__head">
								<div class="m-portlet__head-progress">

									<!-- here can place a progress bar-->
								</div>
								<div class="m-portlet__head-wrapper">
									<div class="m-portlet__head-caption">
										<div class="m-portlet__head-title">
											<span class="m-portlet__head-icon">
												<i class="flaticon-map-location"></i>
											</span>
											<h3 class="m-portlet__head-text">
												New Post
											</h3>
										</div>
									</div>
									<div class="m-portlet__head-tools">
										<div class="btn-group">
											<button type="button" class="btn btn-brand  m-btn m-btn--icon m-btn--wide m-btn--md btn-post">
												<span>
													<i class="la la-check"></i>
													<span>Post Now</span>
												</span>
											</button>
										</div>
									</div>
								</div>
							</div>
							<div class="m-portlet__body">
								<form class="m-form m-form--fit m-form--label-align-right post-form" method="POST" action="{{env('APP_URL')}}/posts/add" enctype="multipart/form-data">
									{{ csrf_field() }}
									<div class="m-portlet__body">
										<div class="form-group m-form__group row">
											<label class="col-form-label" style="padding-left: 15px;">Title</label>
											<div class="col-lg-12 col-md-12 col-sm-12">
												<input type="text" class="form-control m-input" name="title" placeholder="Enter post title" value="{{ old('title') }}">
											</div>
										</div>
										<div class="form-group m-form__group row">
											<label class="col-form-label" style="padding-left: 15px;">Content</label>
											<div class="col-lg-12 col-md-12 col-sm-12">
												<textarea id="summernote" class="summernote" name="content">{{ old('content') }}</textarea>
											</div>
										</div>
										<div class="form-group m-form__group row">
											<label class="col-form-label" style="padding-left: 15px;">Short Description</label>
											<div class="col-lg-12 col-md-12 col-sm-12">
												<textarea class="form-control" id="m_autosize_1" rows="3" name="shortdes">{{ old('shortdes') }}</textarea>
											</div>
										</div>
										<div class="form-group m-form__group row">
											<label class="col-form-label" style="padding-left: 15px;">Category</label>
											<div class="col-lg-12 col-md-12 col-sm-12">
												<select class="form-control m-select2" id="m_select2_1" name="cat_id">
													@foreach($data['category'] as $key=>$value)
													@if($value['id'] == old('cat_id'))
													<option value="{{$value['id']}}" selected="selected">{{$value['name']}}</option>
													@else
													<option value="{{$value['id']}}">{{$value['name']}}</option>
													@endif
													@endforeach
												</select>
											</div>
										</div>
										<div class="form-group m-form__group row">
											<label class="col-form-label" style="padding-left: 15px;">Tags</label>
											<div class="col-lg-12 col-md-12 col-sm-12">
												<input type="text" name="tags" class="form-control m-input" placeholder="Add tags" data-role="tagsinput" value="{{ old('tags') }}">
											</div>
										</div>
										<div class="form-group m-form__group row">
											<label class="col-form-label" style="padding-left: 15px;">Avatar</label>
											<div class="col-lg-12 col-md-12 col-sm-12">
												<div class="custom-file">
													<input type="file" name="avatar" class="custom-file-input" id="customFile">
													<label class="custom-file-label" for="customFile">Choose file</label>
												</div>
												<div class="show-avatar" style="margin-top: 10px;border-radius: 4px;overflow: hidden;display: inline-block;border: 2px dashed #5867dd"><img src=""></div>
											</div>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="m-portlet">
							<div class="m-portlet__head">
								<div class="m-portlet__head-caption">
									<div class="m-portlet__head-title">
										<span class="m-portlet__head-icon">
											<i class="flaticon-eye"></i>
										</span>
										<h3 class="m-portlet__head-text preview-title"></h3>
									</div>
								</div>
							</div>
							<div class="m-portlet__body preview-content" style="width: 700px;margin: auto"></div>
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
<!-- end::Body -->
<script src="{{env('APP_URL')}}/public/assets/demo/default/custom/crud/forms/widgets/select2.js" type="text/javascript"></script>
<script src="{{env('APP_URL')}}/public/js/bootstrap-tagsinput.min.js" type="text/javascript"></script>
<script type="text/javascript">
	var Autosize={init:function(){var i,t;i=$("#m_autosize_1"),t=$("#m_autosize_2"),autosize(i),autosize(t),autosize.update(t)}};jQuery(document).ready(function(){Autosize.init()});
	$(document).ready(function () {

		function uploadImage(image) {
		    var data = new FormData();
		    data.append("image", image);
		    $.ajax({
		        url: '{{env('API_URL')}}/uploadAvatar',
		        cache: false,
		        contentType: false,
		        processData: false,
		        data: data,
		        type: "post",
		        success: function(res) {
		            var image = $('<img>').attr('src', '{{env('API_URL')}}/postThumb/' + res.data);
		            $('#summernote').summernote("insertNode", image[0]);
		        },
		        error: function(data) {
		            console.log(data);
		        }
		    });
		}

		$('#summernote').summernote({
		    height: 450,
		    callbacks: {
		        onImageUpload: function(image) {
		            uploadImage(image[0]);
		        }
		    }
		});

		$("[name='title']").blur(function () {
			var title = $(this).val();
			$(".preview-title").html("Preview: " + title);
		});

		$('#summernote').on('summernote.blur', function() {
		  	$(".preview-content").html($("#summernote").val());
		});

		$(".btn-post").click(function () {
			$(this).addClass('m-loader m-loader--right m-loader--light');
			$(this).attr('disabled', 'disabled');
			$(".post-form").submit();
		});

		$(".show-avatar").hide();
		$(".custom-file input").change(function () {
			$(".show-avatar").hide();
			input = this;
			if (input.files && input.files[0]) {
	            var reader = new FileReader();

	            reader.onload = function (e) {
	                $('.show-avatar img')
	                    .attr('src', e.target.result)
	                    .height(200);
                    $(".show-avatar").show('fast');
	            };

	            reader.readAsDataURL(input.files[0]);
	        }
		});
	});
</script>