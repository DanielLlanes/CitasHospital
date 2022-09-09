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


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog  modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="col-md-12" data-order="">
			<div class="card card-box">
				<div class="col-12"><h1 class="fw-bold"></h1></div>
				<div class="form-group mb-2">
					<label class="control-label col-form-label-sm col-md-3 text-left text-nowrap">Question En
						<span class="required"> * </span>
					</label>
					<div class="col-md-12">
						<input type="text" name="question_en_add" id="question_en_add" placeholder="Question En" class="form-control input-sm" value="">
						<div class="error text-danger col-form-label-sm"></div>
					</div>
				</div>
				<div class="form-group mb-2">
					<label class="control-label col-form-label-sm col-md-3 text-left text-nowrap">Question Es
						<span class="required"> * </span>
					</label>
					<div class="col-md-12">
						<input type="text" name="question_es_add" id="question_es_add" placeholder="Question Es" class="form-control input-sm" value="">
						<div class="error text-danger col-form-label-sm"></div>
					</div>
				</div>
				<div class="form-group mb-2">
					<label class="control-label col-form-label-sm col-md-3 text-left text-nowrap">Awnser En
						<span class="required"> * </span>
					</label>
					<div class="col-md-12">
						<textarea cols="15" rows="10" type="text" name="awnser_en_add" id="awnser_en_add" placeholder="Awnser Es" class="form-control input-sm"></textarea>
						<div class="error text-danger col-form-label-sm"></div>
					</div>
				</div>
				<div class="form-group mb-2">
					<label class="control-label col-form-label-sm col-md-3 text-left text-nowrap">Awnser Es
						<span class="required"> * </span>
					</label>
					<div class="col-md-12">
						<textarea cols="15" rows="10" type="text" name="awnser_es_add" id="awnser_es_add" placeholder="Awnser Es" class="form-control input-sm"></textarea>
						<div class="error text-danger col-form-label-sm"></div>
					</div>
				</div>
			</div>
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="btn-faq-add">Save</button>
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
					<button type="button" class="fa fa-plus btn-color btn btn-success btn-sm button-add-faq" data-toggle="modal" data-target="#exampleModal">
  						Agregar faq
					</button>
				</div>
			</div>
			<div class="card-body" id="line-parent">
				<div class="panel-group accordion" >
					<div class="row" id="faq-area">
						@if (count($faqs) > 0)
							@foreach ($faqs as $faq)
								<div class="col-md-6 faq-item" data-order="{{ $faq->order }}" code="{{ $faq->code }}">
									<div class="card card-box">
										<div class="col-12"><h1 class="fw-bold order">{{ $faq->order }}</h1></div>
										<div class="form-group mb-2">
											<label class="control-label col-form-label-sm col-md-3 text-left text-nowrap">Question En
												<span class="required"> * </span>
											</label>
											<div class="col-md-12">
												<input type="text" name="question_en" id="question_en-{{ $faq->order }}" placeholder="Question En" class="form-control input-sm" value="{{ $faq->question_en }}">
												<div class="error text-danger col-form-label-sm"></div>
											</div>
										</div>
										<div class="form-group mb-2">
											<label class="control-label col-form-label-sm col-md-3 text-left text-nowrap">Question Es
												<span class="required"> * </span>
											</label>
											<div class="col-md-12">
												<input type="text" name="question_es" id="question_es-{{ $faq->order }}" placeholder="Question Es" class="form-control input-sm" value="{{ $faq->question_es }}">
												<div class="error text-danger col-form-label-sm"></div>
											</div>
										</div>
										<div class="form-group mb-2">
											<label class="control-label col-form-label-sm col-md-3 text-left text-nowrap">Awnser En
												<span class="required"> * </span>
											</label>
											<div class="col-md-12">
												<textarea cols="15" rows="10" type="text" name="awnser_en" id="awnser_en-{{ $faq->order }}" placeholder="Awnser Es" class="form-control input-sm">{{ $faq->awnser_en }}</textarea>
												<div class="error text-danger col-form-label-sm"></div>
											</div>
										</div>
										<div class="form-group mb-2">
											<label class="control-label col-form-label-sm col-md-3 text-left text-nowrap">Awnser Es
												<span class="required"> * </span>
											</label>
											<div class="col-md-12">
												<textarea cols="15" rows="10" type="text" name="awnser_es" id="awnser_es-{{ $faq->order }}" placeholder="Awnser Es" class="form-control input-sm">{{ $faq->awnser_es }}</textarea>
												<div class="error text-danger col-form-label-sm"></div>
											</div>
										</div>
										<div class="col-12 p-3 d-flex justify-content-end">
											<button class="btn {{ $faq->active == 1 ? "btn-success":"btn-warning" }} mr-1 active" code="{{ $faq->code }}">{{ $faq->active == 1 ? "Active":"Inactive" }}</button>
											<button class="btn btn-info btn-xs editar mr-1" code="{{ $faq->code }}">Edit</button>
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


@section('scripts')
	<script>
		globalRouteStore = '{{ route('staff.public_page.storefaqs') }}'
		globalRouteActivate = '{{ route('staff.public_page.activate') }}'
		globalRouteUpdate = '{{ route('staff.public_page.updatefaqs') }}'
		globalRouteUpdateOrder = '{{ route('staff.public_page.updateOrderfaqs') }}'
		globalRouteDestroy = '{{ route('staff.public_page.destroyFaq') }}'

	</script>
	<script type="text/javascript" src="{{ asset('staffFiles/assets/js/customjs/page/faqs.min.js') }}"> </script>
@endsection