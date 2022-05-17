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
	<div class="col-md-12 col-sm-12">
		<div class="card card-box">
			<div class="card-head">
				<header>Silider</header>
				<div class="toolxs" style="float: right; padding-left: 16px;margin-left: 24px!important; line-height: normal; vertical-align: middle;margin-top: 7px; margin-bottom: 7px">
					<a class="fa fa-plus btn-color btn btn-success btn-sm button-add-slider" href="javascript:;"> Agregar slider</a>
				</div>
			</div>
			<div class="card-body" id="line-parent">
				<div class="panel-group accordion" id="sortable">
					@if (count($slider) > 0)
						@foreach ($slider as $item)
							<div class="panel panel-default clone" data-clone="{{ $item->order }}">
								<div class="panel-heading panel-heading-gray">
									<h4 class="panel-title">
										<a class="accordion-toggle accordion-toggle-styled" data-toggle="collapse"  data-parent="#sortable" href="#slider-{{ $item->order }}">View Slider Item</a>
										<div class="toolxs" style="float: right; padding-left: 16px;margin-left: 24px!important; line-height: normal; vertical-align: middle;margin-top: 7px; margin-bottom: 7px">
											<a class="fa fa-trash btn-color btn btn-danger btn-sm delete-button-slider" code="{{ $item->code }}" id="delete-{{ $item->order }}" href="javascript:;"> Eliminar</a>
										</div>
									</h4>
								</div>
								<div id="slider-{{ $item->order }}" class="panel-collapse collapse">
									<div class="panel-body">
										<form class="form-horizontal" enctype="multipart/form-data">
											<div class="form-body">
												<div class="row">
													<div class="col-md-6">
														<div class="form-group mb-2">
															<label class="control-label col-form-label-sm col-md-3 text-left text-nowrap">Title 
																<span class="required"> * </span>
															</label>
															<div class="col-md-12">
																<input type="text" name="title" id="title-{{ $item->order }}" placeholder="Title" class="form-control input-sm" value="{{ $item->title }}">
																<div class="error text-danger col-form-label-sm"></div>
															</div>
														</div>
														<div class="form-group mb-2">
															<label class="control-label col-form-label-sm col-md-3 text-left text-nowrap">Cover Image              
																<span class="required"> * </span>
															</label>
															<div class="col-md-12">
																<input type="file" name="image" id="image-{{ $item->order }}" class="dropify" />
																<div class="error text-danger col-form-label-sm"></div>
															</div>
														</div>
														<div class="form-group mb-2" id="imagePreview-{{ $item->order }}">
															<label class="control-label col-form-label-sm col-md-3 text-left text-nowrap">Cover Image              
																<span class="required"> * </span>
															</label>
															<div class="col-md-12">
															 <img src="{{ asset($item->imageOne->image) }}" style="width: 100%; height:240px" alt="" id="image-view-{{ $item->order }}" class="">
															</div>
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group mb-2">
															<label class="control-label col-form-label-sm col-md-3 text-left text-nowrap"><br>
																<span class="required">  </span>
															</label>
															<div class="col-md-12">
																<br>
															</div>
														</div>
														<div class="form-group mb-2">
															<label class="control-label col-form-label-sm col-md-3 text-left text-nowrap">Video Image
																<span class="required"> * </span>
															</label>
															<div class="col-md-12">
																<input type="file" name="video" id="video-{{ $item->order }}" class="dropify" />
																<div class="error text-danger col-form-label-sm"></div>
															</div>
														</div>
														<div class="form-group mb-2" id="videoPreview-{{ $item->order }}">
															<label class="control-label col-form-label-sm col-md-3 text-left text-nowrap">Video Preview 
																<span class="required"> * </span>
															</label>
															<div class="col-md-12">
																<video width="100%" id="preview-{{ $item->order }}" height="240" controls>
																	<source src="{{ asset($item->videoOne->video) }}" type=" {{ $item->videoOne->mime }}">
																</video>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="form-group">
												<div class="offset-md-10 col-md-12">
													<button type="submit" class="btn btn-info btn-edit" code-id="{{ $item->code }}">Edit</button>
													<button type="button" class="btn btn-default btn-cancel">Cancel</button>
												</div>
											</div>
										</form>
									</div>
								</div>
							</div>
						@endforeach
					@endif
				</div>
			</div>
		</div>
	</div>
</div>
</div>
</div>
@endsection
@section('styles')
@endsection
@section('scripts')
    @if (\Session::has('sys-message'))
        <script>
            Toast.fire({
              icon: '{{\Session::get('icon')}}',
              title: '{{\Session::get('msg')}}',
            })
        </script>
    @endif

	<script>
		globalRouteSubmitSlider = '{{ route('staff.public_page.store') }}'
		globalRouteDestroy = '{{ route('staff.public_page.destroy') }}'
		globalRouteEditSlider = '{{ route('staff.public_page.update') }}'
		globalUpdateOrder = '{{ route('staff.public_page.updateOrder') }}'
		var sliderCount = '{{ count($slider) }}';
    </script>

    <script type="text/javascript" src="{{ asset('staffFiles/assets/js/customjs/page/slider.min.js') }}"> </script>

@endsection
