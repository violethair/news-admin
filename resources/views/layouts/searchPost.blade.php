<style type="text/css">
	.search-result {
		position: absolute;
		width: 100%;
		top: 60px;
		z-index: 1;
		left: 0px;
		background: white;
		opacity: 0;
		box-shadow: 0px 0px 15px 1px rgba(69, 65, 78, 0.2)
	}

	.search-result ul {
		list-style: none;
		margin: 0px;
		padding-left: 28px;
	}

	.search-result ul li {
		padding: 10px 0px;
		padding-right: 20px;
	}

	.search-result ul li a {
		font-size: 18px;
		text-decoration: none;
	}

	.search-result ul li a .category{
		font-size: 14px;
		color: #7b7e8a;
		float: right;
	}

	.search-result ul li:before {
		font-size: 18px;
	    position: relative;
    	left: -13px;
	}

	.search-result ul li.pending:before {
		content: "\f017";
		font-family: "Font Awesome 5 Free";
		color: #ffb822;
	}

	.search-result ul li.publish:before {
		content: "\f058";
		font-family: "Font Awesome 5 Free";
		color: #34bfa3;
	}

	.search-result ul li.delete:before {
		content: "\f057";
		font-family: "Font Awesome 5 Free";
		color: #f4516c;
	}
</style>

<div class="form-group m-form__group" style="position: relative;">
	<div class="m-input-icon m-input-icon--left">
		<input style="border-color: #716aca;" type="text" class="form-control form-control-lg m-input search-post" placeholder="Search post now...">
		<span class="m-input-icon__icon m-input-icon__icon--left"><span><i class="la la-search"></i></span></span>
	</div>
	<div class="search-result">
		<ul>
		</ul>
	</div>
</div>