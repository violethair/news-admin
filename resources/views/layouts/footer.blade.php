<!--begin::Global Theme Bundle -->
<script src="{{ env('APP_URL') }}/public/assets/vendors/base/vendors.bundle.js" type="text/javascript"></script>
<script src="{{ env('APP_URL') }}/public/assets/demo/default/base/scripts.bundle.js" type="text/javascript"></script>

<!--end::Global Theme Bundle -->

<!--begin::Page Vendors -->
<script src="{{env('APP_URL')}}/public/assets/demo/default/custom/components/base/toastr.js" type="text/javascript"></script>

<script type="text/javascript">
	$(document).ready(function () {
		$(".search-post").blur(function () {
			var _this = this;
			$(".search-result ul").html('');
			var query = $(_this).val();
			$.get('{{env('APP_URL')}}/posts/search/' + query, function (res) {
				var res = JSON.parse(res);
				$.each(res, function (key,val) {
					var html = '<li class="'+val.status+'"><a href="{{env('APP_URL')}}/posts/edit/'+val.id+'">'+val.name+'<span class="category">'+val.category+'</span></a></li>';
					$(".search-result ul").append(html);
					if(key == res.length - 1) {
						$(".search-result").css('opacity', 1);
						$(".search-result").css('animation', 'm-dropdown-fade-in .3s ease 1, m-dropdown-move-up .3s ease-out 1');
					}
				});
			})
		});
	});
</script>
<!--end::Page Vendors -->
@include('layouts.alert')