<!--begin::Global Theme Bundle -->
<script src="{{ env('APP_URL') }}/public/assets/vendors/base/vendors.bundle.js" type="text/javascript"></script>
<script src="{{ env('APP_URL') }}/public/assets/demo/default/base/scripts.bundle.js" type="text/javascript"></script>

<!--end::Global Theme Bundle -->

<!--begin::Page Vendors -->
<script src="{{env('APP_URL')}}/public/assets/demo/default/custom/components/base/toastr.js" type="text/javascript"></script>
<!--end::Page Vendors -->
@include('layouts.alert')