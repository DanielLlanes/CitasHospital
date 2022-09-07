@extends('staff.layouts.app')
@section('title')
	@lang('Faq"\s')
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
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal"  aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
<div class="row">
	<div class="col-md-12 col-sm-12">
		<div class="card card-box">
			<div class="card-head">
				<header>Faqs</header>
				<div class="toolxs" style="float: right; padding-left: 16px;margin-left: 24px!important; line-height: normal; vertical-align: middle;margin-top: 7px; margin-bottom: 7px">
					<a class="fa fa-plus btn-color btn btn-success btn-sm button-add-faq" href="javascript:;"> Agregar faq</a>
				</div>
			</div>
			<div class="card-body" id="line-parent">
				<div class="panel-group accordion" id="sortable">
					<div class="row">
						@if (count($faqs) > 0)
							@foreach ($faqs as $faq)
								<div class="col-md-6" data-order="{{ $faq->order }}">
									<div class="card card-box">
										<div class="col-12"><h1 class="fw-bold">{{ $faq->order }}</h1></div>
										<div class="form-group mb-2">
											<label class="control-label col-form-label-sm col-md-3 text-left text-nowrap">Question En
												<span class="required"> * </span>
											</label>
											<div class="col-md-12">
												<input type="text" name="title_en" id="title_en-${order}" placeholder="Question En" class="form-control input-sm" value="{{ $faq->question_en }}">
												<div class="error text-danger col-form-label-sm"></div>
											</div>
										</div>
										<div class="form-group mb-2">
											<label class="control-label col-form-label-sm col-md-3 text-left text-nowrap">Question Es
												<span class="required"> * </span>
											</label>
											<div class="col-md-12">
												<input type="text" name="title_es" id="title_es-${order}" placeholder="Question Es" class="form-control input-sm" value="{{ $faq->question_es }}">
												<div class="error text-danger col-form-label-sm"></div>
											</div>
										</div>
										<div class="form-group mb-2">
											<label class="control-label col-form-label-sm col-md-3 text-left text-nowrap">Awnser En
												<span class="required"> * </span>
											</label>
											<div class="col-md-12">
												<textarea cols="15" rows="10" type="text" name="awnser_es" id="awnser_es-${order}" placeholder="Awnser Es" class="form-control input-sm">{{ $faq->awnser_en }}</textarea>
												<div class="error text-danger col-form-label-sm"></div>
											</div>
										</div>
										<div class="form-group mb-2">
											<label class="control-label col-form-label-sm col-md-3 text-left text-nowrap">Awnser Es
												<span class="required"> * </span>
											</label>
											<div class="col-md-12">
												<textarea cols="15" rows="10" type="text" name="awnser_es" id="awnser_es-${order}" placeholder="Awnser Es" class="form-control input-sm">{{ $faq->awnser_es }}</textarea>
												<div class="error text-danger col-form-label-sm"></div>
											</div>
										</div>
										<div class="col-12 p-3 d-flex justify-content-end">
											<button class="btn btn-warning mr-1" code="{{ $faq->code }}">Activate</button>
											<button class="btn btn-success btn-xs editar mr-1" code="{{ $faq->code }}">Edit</button>
											<button class="btn btn-danger btn-xs eliminar mr-1" code="{{ $faq->code }}">Delete</button>
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
</div>
@endsection