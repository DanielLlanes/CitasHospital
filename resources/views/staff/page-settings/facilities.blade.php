@extends('staff.layouts.app')
@section('title')
	@lang('Slider')
@endsection
@section('content')
<div class="page-bar">
	<div class="page-title-breadcrumb">
		<div class=" pull-left">
			<div class="page-title">@lang('Slider Manager')</div>
		</div>
		<ol class="breadcrumb page-breadcrumb pull-right">
			<li>
				<i class="fa fa-home"></i>&nbsp;
				<a class="parent-item" href="index-2.html">@lang('breadcrumb.Home')</a>&nbsp;
				<i class="fa fa-angle-right">

				</i>
			</li>
			<li class="active">@lang('Configuration')&nbsp;
				<i class="fa fa-angle-right"></i>
			</li>
			<li class="active">@lang('Slider Manager')</li>
		</ol>
	</div>
</div>
<div class="row">
</div>
</div>
</div>
@endsection