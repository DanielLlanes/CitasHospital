@extends('staff.layouts.app')
@section('title')
	@lang('Facilities')
@endsection
@section('content')
<div class="page-bar">
	<div class="page-title-breadcrumb">
		<div class=" pull-left">
			<div class="page-title">@lang('Facilities Manager')</div>
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
			<li class="active">@lang('Facilities Manager')</li>
		</ol>
	</div>
</div>
<div class="row">
	<div class="col-md-12 col-sm-12">
		<div class="card card-box">
			<div class="card-head">
				<header>Facilities</header>
				<div class="toolxs" style="float: right; padding-left: 16px;margin-left: 24px!important; line-height: normal; vertical-align: middle;margin-top: 7px; margin-bottom: 7px">
					<a class="fa fa-plus btn-color btn btn-success btn-sm button-add-facilities" href="javascript:;"> Agregar facilities</a>
				</div>
			</div>
			<div class="card-body" id="line-parent">
				<div class="panel-group accordion" id="sortable">
					@if (count($facilities) > 0)
						@foreach ($facilities as $facility)
						<form class="panel panel-default form clone" data-clone="{{ $facility->order }}" code="{{ $facility->code }}">
							<div class="panel-heading panel-heading-gray">
								<h4 class="panel-title">
									<a class="accordion-toggle accordion-toggle-styled" data-toggle="collapse"  data-parent="#sortable" href="#facilities-{{ $facility->order }}">New Facility {{ $facility->order }}</a>
									<div class="toolxs" style="float: right; padding-left: 16px;margin-left: 24px!important; line-height: normal; vertical-align: middle;margin-top: 7px; margin-bottom: 7px">
										<a class="fa fa-trash btn-color btn btn-danger btn-sm delete-global" id="delete-{{ $facility->order }}" code="{{ $facility->code }}" href="javascript:;"> Eliminar</a>
									</div>
								</h4>
							</div>
							<div id="facilities-{{ $facility->order }}" class="panel-collapse in collapse">
								<div class="panel-body">
									<form class="form-horizontal" enctype="multipart/form-data">
										<div class="form-body">
											<div class="row">
												<div class="col-md-6">
													<div class="form-group mb-2">
														<label class="control-label col-form-label-sm col-md-3 text-left text-nowrap">Title En
															<span class="required"> * </span>
														</label>
														<div class="col-md-12">
															<input type="text" name="title_en" id="title_en-${order}" placeholder="Title En" class="form-control input-sm" value="{{ $facility->name_en }}">
															<div class="error text-danger col-form-label-sm"></div>
														</div>
													</div>
													<div class="form-group mb-2">
														<label class="control-label col-form-label-sm col-md-3 text-left text-nowrap">Title Es
															<span class="required"> * </span>
														</label>
														<div class="col-md-12">
															<input type="text" name="title_es" id="title_es-{{ $facility->order }}" placeholder="Title Es" class="form-control input-sm" value="{{ $facility->name_es }}">
															<div class="error text-danger col-form-label-sm"></div>
														</div>
													</div>
													<div class="form-group mb-2">
														<label class="control-label col-form-label-sm col-md-3 text-left text-nowrap">Description En
															<span class="required"> * </span>
														</label>
														<div class="col-md-12">
															<textarea cols="15" rows="10" type="text" name="description_en" id="description_en-${order}" placeholder="Description En" class="form-control input-sm">{{ $facility->description_en }}</textarea>
															<div class="error text-danger col-form-label-sm"></div>
														</div>
													</div>
													<div class="form-group mb-2">
														<label class="control-label col-form-label-sm col-md-3 text-left text-nowrap">Description Es
															<span class="required"> * </span>
														</label>
														<div class="col-md-12">
															<textarea cols="15" rows="10" type="text" name="description_es" id="description_es-{{ $facility->order }}" placeholder="Description Es" class="form-control input-sm">{{ $facility->description_es }}</textarea>
															<div class="error text-danger col-form-label-sm"></div>
														</div>
													</div>
													<div class="form-group mb-2">
														<label class="control-label col-form-label-sm col-md-3 text-left text-nowrap">Activar?
															<span class="required"> * </span>
														</label>
														<div class="col-md-12">
															<div class=" bt-switch">
																<input type="checkbox" checked data-on-color="success" data-off-color="warning">
															</div>
															<div class="error text-danger col-form-label-sm"></div>
														</div>
													</div>
												</div>
												<div class="col-md-6">
													<div class="row sortable" id="image-area" parent="{{ $facility->order }}" code="{{ $facility->code }}">
														@foreach ($facility->imageMany as $image)
														<div class="col-md-6 item">
															<div class="card">
																<div class="form-group mb-2">
																	<label class="control-label col-form-label-sm col-md-3 text-left text-nowrap">Facility Image {{ $image->order }}            
																		<span class="required"> * </span>
																	</label>
																	<div class="col-md-12">
																		<input type="file" code="{{ $image->code }}" name="image[]" parent="{{ $facility->order }}" data-default-file="{{ asset($image->image) }}" id="image-{{ $image->order }}" class="dropify" accept="image/*"/>
																		<div class="error text-danger col-form-label-sm"></div>
																	</div>
																</div>
																<div class="form-group mb-2">
																	<label class="control-label col-form-label-sm col-md-3 text-left text-nowrap">Caption En
																		<span class="required"> * </span>
																	</label>
																	<div class="col-md-12">
																		<input type="text" name="caption_en[]" parent="{{ $facility->order }}" id="caption_en-{{ $image->order }}" placeholder="Caption En" class="form-control input-sm" value="{{ $image->caption_en }}">
																		<div class="error text-danger col-form-label-sm"></div>

																	</div>
																</div>
																<div class="form-group mb-2">
																	<label class="control-label col-form-label-sm col-md-3 text-left text-nowrap">Caption Es 
																		<span class="required"> * </span>
																	</label>
																	<div class="col-md-12">
																		<input type="text" name="caption_es[]" parent="${order}" id="caption_es-{{ $image->order }}" placeholder="Caption Es" class="form-control input-sm" value="{{ $image->caption_en }}">
																		<div class="error text-danger col-form-label-sm"></div>
																	</div>
																</div>
																<div class="col-12 mb-2 d-flex justify-content-end">
																	<button type="button" class="btn btn-danger btn-del" code="{{ $image->code }}">Delete</button>
																</div>
															</div>
														</div>
														@endforeach
													</div>
													<div class="col-12 d-flex justify-content-end">
														<button type="button" class="btn btn-warning btn-add">Add image</button>
													</div>
												</div>
											</div>
										</div>
										<div class="form-group">
											<div class="offset-md-10 col-md-12">
												<button type="submit" code="{{ $facility->code }}" class="btn btn-info btn-edit">Edit</button>
												<button type="button" class="btn btn-default btn-cancel">Cancel</button>
											</div>
										</div>
									</form>
								</div>
							</div>
						</form>
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
		globalRouteSubmitFaclities = '{{ route('staff.public_page.storeFacilities') }}'
		globalRouteDestroy = '{{ route('staff.public_page.destroyFacilities') }}'
		globalRouteEditFaclities = '{{ route('staff.public_page.updateFacilities') }}'
		globalUpdateOrder = '{{ route('staff.public_page.updateOrderFacilities') }}'
		var facilitiesCount = '{{ count($facilities) }}';
    </script>

    {{-- <script type="text/javascript" src="{{ asset('staffFiles/assets/js/customjs/page/facilities.min.js') }}"> </script> --}}

    <script>
    	
    </script>

@endsection