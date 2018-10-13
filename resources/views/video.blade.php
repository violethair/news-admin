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
				<div class="m-portlet m-portlet--full-height ">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <a data-toggle="modal" data-target="#m_modal_5" href="#" class="btn btn-info m-btn btn-sm m-btn m-btn--icon m_sweetalert_demo_8">
                                    <span>
                                        <i class="fa flaticon-plus"></i>
                                        <span>Add Video</span>
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__body">

                            <!--begin::Content-->
                            <div class="tab-content">
                                <!--begin::m-widget5-->
                                <div class="m-widget5">
                                </div>
                                <button data-page="1" type="button" class="btn m-btn--pill m-btn--air btn-primary btn-block btn-load-more">Load more</button>
                                <!--end::m-widget5-->
                            </div>

                            <!--end::Content-->
                        </div>
                    </div>
                    <!--end:: Widgets/Best Sellers-->
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
<!--begin::Modal-->
<div class="modal fade" id="m_modal_5" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add new video</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form-add" method="POST" action="{{env('APP_URL')}}/videos/add">
            <div class="modal-body">
                {{csrf_field()}}
                <div class="form-group">
                    <label for="recipient-name" class="form-control-label">Title:</label>
                    <input type="text" class="form-control" name="title">
                </div>
                <div class="form-group">
                    <label for="recipient-name" class="form-control-label">Video URL:</label>
                    <input type="text" class="form-control" name="src_video">
                </div>
                <div class="view-preview">
                    <iframe style="width: 100%;display: none" height="250" src="#"></iframe>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Add new</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- end::Body -->
<!--begin::Modal-->
<div class="modal fade" id="m_modal_6" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit video</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form-edit" method="POST" action="{{env('APP_URL')}}/videos/edit">
            <div class="modal-body">
                {{csrf_field()}}
                <input type="hidden" name="id" value="0">
                <div class="form-group">
                    <label for="recipient-name" class="form-control-label">Title:</label>
                    <input type="text" class="form-control" name="title">
                </div>
                <div class="form-group">
                    <label for="recipient-name" class="form-control-label">Video URL:</label>
                    <input type="text" class="form-control" name="src_video">
                </div>
                <div class="view-preview">
                    <iframe style="width: 100%;display: none" height="250" src="#"></iframe>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- end::Body -->
<script type="text/javascript">
    $(document).ready(async function () {

        $("body").on('click', '.btn-delete', function (e) {
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

        $("body").on('click', '.btn-edit', function () {
            var id = $(this).attr('data-id');
            var title = $(this).attr('data-title');
            var src_video = $(this).attr('data-src_video');
            $(".form-edit").find("[name='id']").val(id);
            $(".form-edit").find("[name='title']").val(title);
            $(".form-edit").find("[name='src_video']").val(src_video);
            var video_id = getYoutubeID(src_video);
            $("#m_modal_6 .view-preview iframe").attr('src', 'https://www.youtube.com/embed/' + video_id);
            $("#m_modal_6 .view-preview iframe").show();
        });

        function getYoutubeID (url) {
            var regExp = /^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#\&\?]*).*/;
            var match = url.match(regExp);
            return (match&&match[7].length==11)? match[7] : false;
        }

        $("#m_modal_5 [name='src_video']").blur(async function () {
            mApp.block("#m_modal_5 .modal-content", {
                type: "loader",
                state: "primary",
                message: "Processing..."
            });
            var url = $(this).val();
            var video_id = getYoutubeID(url);
            $("#m_modal_5 .view-preview iframe").attr('src', 'https://www.youtube.com/embed/' + video_id);
            $("#m_modal_5 .view-preview iframe").show();
            mApp.unblock("#m_modal_5 .modal-content");
        });

        $("#m_modal_6 [name='src_video']").blur(async function () {
            mApp.block("#m_modal_6 .modal-content", {
                type: "loader",
                state: "primary",
                message: "Processing..."
            });
            var url = $(this).val();
            var video_id = getYoutubeID(url);
            $("#m_modal_6 .view-preview iframe").attr('src', 'https://www.youtube.com/embed/' + video_id);
            $("#m_modal_6 .view-preview iframe").show();
            mApp.unblock("#m_modal_6 .modal-content");
        });

        async function addElement (data) {
            for(var i = 0; i < data.length; i++) {
                var temp = data[i];
                var html = `<div class="m-widget5__item">
                                <div class="m-widget5__content">
                                    <div class="m-widget5__pic">
                                        <img class="m-widget7__img" src="`+temp.images+`" alt="">
                                    </div>
                                    <div class="m-widget5__section">
                                        <h4 class="m-widget5__title">`+temp.name+`</h4>
                                        <a target="_blank" href="`+temp.src_video+`">`+temp.src_video+`</a>
                                        <br>
                                        <span class="m-widget5__desc">`+temp.created+`</span>
                                    </div>
                                </div>
                                <div class="m-widget5__content">
                                    <div class="m-widget5__stats1" style="padding:0px">
                                        <span class="m-widget5__number">`+temp.view+`</span><br>
                                        <span style="display:block;margin-top:-4px" class="m-widget5__sales">view</span>
                                    </div>
                                    <div class="m-widget5__stats1" style="margin-left:10px;padding:0px">
                                        <button data-toggle="modal" data-target="#m_modal_6" data-id="`+temp.id+`" data-title="`+temp.name+`" data-src_video="`+temp.src_video+`" type="button" class="btn m-btn--square btn-primary btn-edit">EDIT</button>
                                    </div>
                                    <div class="m-widget5__stats1" style="margin-left:10px;padding:0px">
                                        <button href="{{env('APP_URL')}}/videos/delete/`+temp.id+`" type="button" class="btn m-btn--square btn-danger btn-delete">DELELTE</button>
                                    </div>
                                </div>
                            </div>`
                await $(".m-widget5").append(html);
            }
            mApp.unblock('.m-portlet');
        }

        $(".btn-load-more").click(async function () {
            mApp.block(".btn-load-more", {
                type: "loader",
                state: "primary",
                message: "Processing..."
            });

            var page = $(this).attr('data-page');
            $(this).attr('data-page', parseInt(page) + 1);

            let data = await $.get("{{env('APP_URL')}}/api/loadMoreVideo/" + page);
            data = JSON.parse(data);
            addElement(data);
            mApp.unblock('.btn-load-more');
        });

        mApp.block(".m-portlet", {
            type: "loader",
            state: "primary",
            message: "Processing..."
        });
        let data = await $.get("{{env('APP_URL')}}/api/loadMoreVideo");
        data = JSON.parse(data);
        addElement(data);
        
    });
</script>