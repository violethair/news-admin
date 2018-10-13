<!-- BEGIN: Aside Menu -->
@php
$path = request()->path();
$firstPath = explode('/', $path)[0];
if($path == '/') $firstPath = '/';
@endphp
<div id="m_ver_menu" class="m-aside-menu  m-aside-menu--skin-dark m-aside-menu--submenu-skin-dark " m-menu-vertical="1" m-menu-scrollable="1" m-menu-dropdown-timeout="500" style="position: relative;">
	<ul class="m-menu__nav  m-menu__nav--dropdown-submenu-arrow ">
		<li class="m-menu__item  {{$firstPath == '/' ? 'm-menu__item--active' : ''}}" aria-haspopup="true"><a href="{{env('APP_URL')}}" class="m-menu__link "><i class="m-menu__link-icon flaticon-line-graph"></i><span class="m-menu__link-title"> <span class="m-menu__link-wrap"> <span class="m-menu__link-text">Dashboard</span></span></span></a></li>
		<li class="m-menu__item {{$firstPath == 'posts' ? 'm-menu__item--active' : ''}}" aria-haspopup="true" m-menu-submenu-toggle="hover"><a href="{{env('APP_URL')}}/posts" class="m-menu__link m-menu__toggle"><i class="m-menu__link-icon flaticon-list-2"></i><span class="m-menu__link-text">Post</span></a>
		</li>
		<li class="m-menu__item {{$firstPath == 'videos' ? 'm-menu__item--active' : ''}}" aria-haspopup="true" m-menu-submenu-toggle="hover"><a href="{{env('APP_URL')}}/videos" class="m-menu__link m-menu__toggle"><i class="m-menu__link-icon la la-video-camera"></i><span class="m-menu__link-text">Video</span></a>
		</li>
		<li class="m-menu__item {{$firstPath == 'category' ? 'm-menu__item--active' : ''}}" aria-haspopup="true" m-menu-submenu-toggle="hover"><a href="{{env('APP_URL')}}/category" class="m-menu__link m-menu__toggle"><i class="m-menu__link-icon flaticon-map"></i><span class="m-menu__link-text">Category</span></a>
		</li>
		<li class="m-menu__item {{$firstPath == 'user' ? 'm-menu__item--active' : ''}}" aria-haspopup="true" m-menu-submenu-toggle="hover"><a href="{{env('APP_URL')}}/user" class="m-menu__link m-menu__toggle"><i class="m-menu__link-icon flaticon-user"></i><span class="m-menu__link-text">User</span></a>
		</li>
		<li class="m-menu__item {{$firstPath == 'settings' ? 'm-menu__item--active' : ''}}" aria-haspopup="true" m-menu-submenu-toggle="hover"><a href="{{env('APP_URL')}}/settings" class="m-menu__link m-menu__toggle"><i class="m-menu__link-icon flaticon-cogwheel"></i><span class="m-menu__link-text">Setting</span></a>
		</li>
	</ul>
</div>
<!-- END: Aside Menu -->