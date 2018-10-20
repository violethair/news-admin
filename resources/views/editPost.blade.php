@include('layouts.header')
<style type="text/css">
	.preview-content img {
		max-width: 100%;
	}
</style>
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
					<div class="col-lg-12">
						<div class="m-portlet m-portlet--last m-portlet--head-lg m-portlet--responsive-mobile" id="main_portlet">
							<div class="m-portlet__head">
								<div class="m-portlet__head-progress">
								</div>
								<div class="m-portlet__head-wrapper">
									<div class="m-portlet__head-caption">
										<div class="m-portlet__head-title">
											<span class="m-portlet__head-icon">
												<i class="flaticon-map-location"></i>
											</span>
											<h3 class="m-portlet__head-text">
												Edit Post
											</h3>
										</div>
									</div>
									<div class="m-portlet__head-tools">
										<button type="button" style="margin-right: 10px;" class="btn btn-brand  m-btn m-btn--icon m-btn--wide m-btn--md btn-preview">
											<span>
												<i class="flaticon-eye"></i>
												<span>Preview</span>
											</span>
										</button>
										<button type="button" class="btn btn-accent  m-btn m-btn--icon m-btn--wide m-btn--md btn-post">
											<span>
												<i class="la la-check"></i>
												<span>Save</span>
											</span>
										</button>
									</div>
								</div>
							</div>
							<div class="m-portlet__body">
								<form class="m-form m-form--fit m-form--label-align-right post-form" method="POST" action="{{env('APP_URL')}}/posts/edit/{{$data['id']}}" enctype="multipart/form-data">
									{{ csrf_field() }}
									<input type="hidden" name="id" value="{{ $data['id'] }}">
									<div class="m-portlet__body">
										<div class="form-group m-form__group row">
											<label class="col-form-label" style="padding-left: 15px;">Title</label>
											<div class="col-lg-12 col-md-12 col-sm-12">
												<input type="text" class="form-control m-input" name="title" placeholder="Enter post title" value="{{ $data['name'] }}">
											</div>
										</div>
										<div class="form-group m-form__group row">
											<label class="col-form-label" style="padding-left: 15px;">Content</label>
											<div class="col-lg-12 col-md-12 col-sm-12">
												<textarea id="summernote" class="summernote" name="content">{{ $data['content'] }}</textarea>
											</div>
										</div>
										<div class="form-group m-form__group row">
											<label class="col-form-label" style="padding-left: 15px;">Short Description</label>
											<div class="col-lg-12 col-md-12 col-sm-12">
												<textarea class="form-control" id="m_autosize_1" rows="3" name="shortdes">{{$data['shortdes']}}</textarea>
											</div>
										</div>
										<div class="form-group m-form__group row">
											<label class="col-form-label" style="padding-left: 15px;">Category</label>
											<div class="col-lg-12 col-md-12 col-sm-12">
												<select class="form-control m-select2" id="m_select2_1" name="cat_id">
													@foreach($data['category'] as $key=>$value)
													@if($value['id'] == $data['cat_id'])
													<option value="{{$value['id']}}" selected="selected">{{$value['name']}}</option>
													@else
													<option value="{{$value['id']}}">{{$value['name']}}</option>
													@endif
													@endforeach
												</select>
											</div>
										</div>
										<div class="form-group m-form__group row">
											<label class="col-form-label" style="padding-left: 15px;">Sub Category</label>
											<div class="col-lg-12 col-md-12 col-sm-12">
												<select class="form-control m-select2" id="m_select2_3" name="sub_cat_id[]" multiple="multiple">
													@foreach($data['category'] as $key=>$value)
													@if(in_array($value['id'],$data['cat_after']))
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
												<input type="text" name="tags" class="form-control m-input" placeholder="Add tags" data-role="tagsinput" value="{{ $data['tag'] }}">
											</div>
										</div>
										<div class="form-group m-form__group row">
											<label class="col-form-label" style="padding-left: 15px;">Avatar</label>
											<div class="col-lg-12 col-md-12 col-sm-12">
												<div class="custom-file">
													<input type="hidden" name="avatar">
													<input type="file" name="avatar" class="custom-file-input" id="customFile">
													<label class="custom-file-label" for="customFile">Choose file</label>
												</div>
												<div class="show-avatar" style="margin-top: 10px;border-radius: 4px;overflow: hidden;display: inline-block;border: 2px dashed #5867dd"><img src="{{env('API_URL')}}/postThumb/{{ $data['images'] }}" style="height: 200px"></div>
											</div>
										</div>
										<div class="form-group m-form__group row">
											<label class="col-form-label" style="padding-left: 15px;">Reference link</label>
											<div class="col-lg-12 col-md-12 col-sm-12">
												<input type="text" name="reference_link" class="form-control m-input" placeholder="Reference link" value="{{ $data['link_thamkhao'] }}">
											</div>
										</div>
										<div class="form-group m-form__group row">
											<label class="col-form-label" style="padding-left: 15px;">Related Post</label>
											<div class="col-lg-12 col-md-12 col-sm-12">
												<select class="form-control m-select2" id="m_select2_4" name="related_id[]" multiple="multiple">
												@foreach ($data['relate_id'] as $value)
												<option value="{{$value['id']}}" selected="selected">{{$value['name']}}</option>
												@endforeach
												</select>
											</div>
										</div>
										<div class="form-group m-form__group row">
											<label class="col-form-label" style="padding-left: 15px;">Publish Schedule</label>
											<div class="col-lg-12 col-md-12 col-sm-12">
												<input value="{{ $data['publish_schedule'] }}" type="text" name="publish_schedule" class="form-control" id="m_datetimepicker_1" placeholder="Select date & time to publish schedule" />
											</div>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
					<div class="col-lg-12">
						<div class="m-portlet preview-wrap" style="margin-top: 20px">
							<div class="m-portlet__head">
								<div class="m-portlet__head-caption">
									<div class="m-portlet__head-title">
										<span class="m-portlet__head-icon">
											<i class="flaticon-eye"></i>
										</span>
										<h3 class="m-portlet__head-text preview-title">Preview: {{ $data['name'] }}</h3>
									</div>
								</div>
							</div>
							<div class="m-portlet__body preview-content" style="width: 700px;margin: auto">{!! $data['content'] !!}</div>
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

		$("#m_datetimepicker_1").datetimepicker({
            todayHighlight: !0,
            autoclose: !0,
            format: "yyyy-mm-dd hh:ii:00"
        });

		function formatRepo (repo) {
			return repo.name;
		}

		function formatRepoSelection (repo) {
		  	return repo.name || repo.text;
		}

		$('#m_select2_4').select2({
			ajax: {
			  	url: function (params) {
			      return '{{env('APP_URL')}}/posts/search/' + params.term;
			    },
			    processResults: function (data) {
			      return {
			        results: JSON.parse(data)
			      };
			    }
			},
		   	templateResult: formatRepo,
  			templateSelection: formatRepoSelection
		});


		$('.summernote').summernote({
			height: 450,
			popover: {
			  image: [
			    ['imagesize', ['imageSize100', 'imageSize50', 'imageSize25']],
			    ['float', ['floatLeft', 'floatRight', 'floatNone']],
			    ['remove', ['removeMedia']]
			  ],
			  link: [
			    ['link', ['linkDialogShow', 'unlink']]
			  ],
			  air: [
			    ['color', ['color']],
			    ['font', ['bold', 'underline', 'clear']],
			    ['para', ['ul', 'paragraph']],
			    ['table', ['table']],
			    ['insert', ['link', 'picture']]
			  ]
			},
			fontSizes : ["8","10","12","14","16","18","20","22","24","26","28","30","32","34","36","38","40","42","44","46","48","50","52","54","56","58","60","62","64","66","68","70","72"],
		  	toolbar: [
		  		['fontname', ['fontname']],
				['style', ['bold', 'italic', 'underline', 'clear']],
			    ['font', ['strikethrough', 'superscript', 'subscript']],
			    ['fontsize', ['fontsize']],
			    ['color', ['color']],
			    ['para', ['ul', 'ol', 'paragraph']],
			    ['height', ['height']],
			    ['insert', ['picture','link', 'video', 'table']],
			    ['misc', ['fullscreen', 'codeview', 'undo', 'redo', 'help']]
			],
		    callbacks: {
		        onImageUpload: function(image) {
		            uploadImage(image[0], function (res) {
		            	var image = $('<img>').attr('src', '{{env('API_URL')}}/postThumb/' + res.data);
		            	$('#summernote').summernote("insertNode", image[0]);
		            });
		        }
		    }
		});

		$(".btn-preview").click(function() {
		    $([document.documentElement, document.body]).animate({
		        scrollTop: $(".preview-wrap").offset().top
		    }, 500);
		});

		function uploadImage(image, callback) {
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
		            callback(res);
		        },
		        error: function(data) {
		            console.log(data);
		        }
		    });
		}

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

		$(".show-avatar").show();
		$(".custom-file input").change(function () {
			$(".show-avatar").hide();
			input = this;
			if (input.files && input.files[0]) {
				uploadImage(input.files[0], function (res) {
					$("[name='avatar']").attr('value', res.data);
					$('.show-avatar img')
	                    .attr('src', '{{env('API_URL')}}/postThumb/' + res.data)
	                    .height(200);
                    $(".show-avatar").show('fast');
	            });
	        }
		});
	});
</script>