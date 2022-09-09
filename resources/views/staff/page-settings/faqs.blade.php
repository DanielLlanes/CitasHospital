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
	<script>
		$(document).on('click', "#btn-faq-add", function(event){
			var $question_en_add = $('#question_en_add').val();
			var $question_es_add = $('#question_es_add').val();
			var $awnser_en_add = $('#awnser_en_add').val();
			var $awnser_es_add = $('#awnser_es_add').val();

			var order = $('#faq-area > .faq-item').length;

			 var form_data = new FormData();
			 form_data.append('question_en', $question_en_add);
			 form_data.append('question_es', $question_es_add);
			 form_data.append('awnser_en', $awnser_en_add);
			 form_data.append('awnser_es', $awnser_es_add);
			 form_data.append('order', order+1);

			 addNewFaq(form_data);
		})

		$(document).on('click', '.editar', function(event){
			$question_es = $(this).parents('.faq-item').find('input[name=question_es]');
			$question_en = $(this).parents('.faq-item').find('input[name=question_en]');
			$awnser_es = $(this).parents('.faq-item').find('input[name=awnser_es]');
			$awnser_en = $(this).parents('.faq-item').find('input[name=awnser_en]');
			$code = $(this).attr('code');
			$order = $(this).parents('.faq-item').attr('data-order')

			var form_data = new FormData();
			 form_data.append('question_en', $question_en.val());
			 form_data.append('question_es', $question_es.val());
			 form_data.append('awnser_en', $awnser_en.val());
			 form_data.append('awnser_es', $awnser_es.val());
			 form_data.append('code', $code);
			 form_data.append('order', $order);

			 updateFaq(form_data, $order);
		})

		$(document).on('click', '.active', function(event){
			$code = $(this).attr('code')
			var form_data = new FormData();
			form_data.append('code', $code);
			activationFaq(form_data, $(this))
		})

		$(document).on('click', '.eliminar', function(event){
			$code = $(this).attr('code')
			$btn = $(this);
			var form_data = new FormData();
			form_data.append('code', $code);
			event.preventDefault();
			Swal.fire({
				title: '¿Esta seguro?',
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Si, borrarlo!'
			}).then((result) => {
				if (result.value) {
					deleteRecord(form_data, $btn)
				} else if (result.dismiss) {
					Swal.fire(
						'Cancelado!',
						'Ningun registro fue eliminado.',
						'error'
					)
					event.preventDefault()
					event.stopPropagation();
				}
        	 })
		})

		$(function() {
		    position_updated = false; //flag bit

		    $("#faq-area").sortable({
		        connectWith: "#faq-area",

		        update: function(event, ui) {
		        	console.log('update')
		            position_updated = !ui.sender; //if no sender, set sortWithin flag to true
		        },

		        stop: function(event, ui) {
		            if (position_updated) {

		                updateOrder()

		                position_updated = false;
		            }
		        },

		        receive: function(event, ui) {
		           
		           console.log('recive')
		        }

		    }).disableSelection();
		});

		function addNewFaq(form_data) {
			$.ajax({
	            url: globalRouteStore,
	            method:"POST",
	            data:form_data,
	            dataType:'JSON',
	            contentType: false,
	            cache: false,
	            headers: {
	                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	            },
	            processData: false,
	            beforeSend: function()
	            {
	            },
	            success:function(data)
	            {
	            	if (data.success) {
	                	$('#exampleModal').modal('hide')
	            		Toast.fire({
	                  		icon: data.icon,
	                  		title: data.msg
	                	})
	                	clearForm()
	                	addNewItem(data.faq)
	            	} else {
						$.each( data.errors, function( key, value ) {
	                        $('*[id^='+key+'_add]').parent().find('.error').append('<p>'+value+'</p>')
	                    });
	            	}
	             
	            },
	            error: function (err)
	            {
	                console.log('err', err)
	            },
	            complete: function()
	            {
	            },
	        })
		}

		function activationFaq(form_data, btn) {
			$.ajax({
	            url: globalRouteActivate,
	            method:"POST",
	            data:form_data,
	            dataType:'JSON',
	            contentType: false,
	            cache: false,
	            headers: {
	                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	            },
	            processData: false,
	            beforeSend: function()
	            {
	            },
	            success:function(data)
	            {
	            	if (data.success) {
	            		Toast.fire({
	                  		icon: data.icon,
	                  		title: data.msg
	                	})
	            	}

	             	if (data.faq.active == 0) {
	             		btn.removeClass('btn-success')
	             		btn.addClass('btn-warning')
	             		btn.html('Inactive')
             		} else {
             			btn.removeClass('btn-warning')
	             		btn.addClass('btn-success')
	             		btn.html('Active')
             		}
	            },
	            error: function (err)
	            {
	                console.log('err', err)
	            },
	            complete: function()
	            {
	            },
	        })
		}

		function updateFaq(form_data, order) {
			$.ajax({
	            url: globalRouteUpdate,
	            method:"POST",
	            data:form_data,
	            dataType:'JSON',
	            contentType: false,
	            cache: false,
	            headers: {
	                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	            },
	            processData: false,
	            beforeSend: function()
	            {
	            },
	            success:function(data)
	            {
	            	if (data.success) {
	            		Toast.fire({
	                  		icon: data.icon,
	                  		title: data.msg
	                	})
	            	} else {
						$.each( data.errors, function( key, value ) {
							$var = key+'-'+order;
	                        $('*[id^='+$var+']').parent().find('.error').append('<p>'+value+'</p>')
	                    });
	            	}
	             
	            },
	            error: function (err)
	            {
	                console.log('err', err)
	            },
	            complete: function()
	            {
	            },
	        })
		}

		function updateOrder() {
			$items = $('.faq-item');
			myobj = []
            $.each( $items, function( key, value ) {
            	$k = (key + 1);
            	$(this).attr('data-order', $k)
            	$question_es = $(this).find('input[name=question_es]');
				$question_en = $(this).find('input[name=question_en]');
				$awnser_es = $(this).find('input[name=awnser_es]');
				$awnser_en = $(this).find('input[name=awnser_en]');
				$order = $(this).find('.order');
				$order.html($k)
				$question_es.attr('id', 'question_es-'+$k)
				$question_en.attr('id', 'question_en-'+$k)
				$awnser_es.attr('id', 'awnser_es-'+$k)
				myobj.push(
					{
						code: $(this).attr('code'), 
						order: $k
					});
            });
           	form_data = new FormData();
           	form_data.append('obj', JSON.stringify(myobj))
			$.ajax({
		        url: globalRouteUpdateOrder,
		        method:"POST",
		        data:form_data,
		        dataType:'JSON',
		        contentType: false,
		        cache: false,
		        headers: {
		            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		        },
		        processData: false,
		        beforeSend: function()
		        {
		        },
		        success:function(data)
		        {
		        console.log("data", data);
		        	if (data.success) {
		        		Toast.fire({
			              	icon: data.icon,
			              	title: data.msg
			            })
		        	}
		        },
		        error: function (err)
		        {
		            console.log('err', err)
		        },
		        complete: function()
		        {
		        },
		    })
		}

		function deleteRecord(form_data, $btn){
		    $.ajax({
		        url: globalRouteDestroy,
		        method:"POST",
		        data:form_data,
		        dataType:'JSON',
		        contentType: false,
		        cache: false,
		        headers: {
		            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		        },
		        processData: false,
		        beforeSend: function()
		        {
		        },
		        success:function(data)
		        {
		        	if (data.success) {
		        		Toast.fire({
			              	icon: data.icon,
			              	title: data.msg
			            })
			            $btn.parents('.faq-item').remove();
			            $items = $('.faq-item');
			            $.each( $items, function( key, value ) {
			            	$k = (key + 1);
			            	$(this).attr('data-order', $k)
			            	$question_es = $(this).find('input[name=question_es]');
							$question_en = $(this).find('input[name=question_en]');
							$awnser_es = $(this).find('input[name=awnser_es]');
							$awnser_en = $(this).find('input[name=awnser_en]');
							$order = $(this).find('.order');
							$order.html($k)
							$question_es.attr('id', 'question_es-'+$k)
							$question_en.attr('id', 'question_en-'+$k)
							$awnser_es.attr('id', 'awnser_es-'+$k)
							$awnser_en.attr('id', 'awnser_en-'+$k)
	                    });
		        	}
		        },
		        error: function (err)
		        {
		            console.log('err', err)
		        },
		        complete: function()
		        {
		        },
		    })
		}

		function addNewItem($faq) {
			$newItem = ` 
				<div class="col-md-6 faq-item" data-order="${$faq.order}">
					<div class="card card-box">
						<div class="col-12"><h1 class="fw-bold">${$faq.order}</h1></div>
						<div class="form-group mb-2">
							<label class="control-label col-form-label-sm col-md-3 text-left text-nowrap">Question En
								<span class="required"> * </span>
							</label>
							<div class="col-md-12">
								<input type="text" name="questionitle_en" id="questionitle_en-${$faq.order}" placeholder="Question En" class="form-control input-sm" value="{$$faq.question_en}">
								<div class="error text-danger col-form-label-sm"></div>
							</div>
						</div>
						<div class="form-group mb-2">
							<label class="control-label col-form-label-sm col-md-3 text-left text-nowrap">Question Es
								<span class="required"> * </span>
							</label>
							<div class="col-md-12">
								<input type="text" name="question_es" id="question_es-${$faq.order}" placeholder="Question Es" class="form-control input-sm" value="${ $faq.question_es }">
								<div class="error text-danger col-form-label-sm"></div>
							</div>
						</div>
						<div class="form-group mb-2">
							<label class="control-label col-form-label-sm col-md-3 text-left text-nowrap">Awnser En
								<span class="required"> * </span>
							</label>
							<div class="col-md-12">
								<textarea cols="15" rows="10" type="text" name="awnser_es" id="awnser_es-${$faq.order}" placeholder="Awnser Es" class="form-control input-sm">${$faq.awnser_en }</textarea>
								<div class="error text-danger col-form-label-sm"></div>
							</div>
						</div>
						<div class="form-group mb-2">
							<label class="control-label col-form-label-sm col-md-3 text-left text-nowrap">Awnser Es
								<span class="required"> * </span>
							</label>
							<div class="col-md-12">
								<textarea cols="15" rows="10" type="text" name="awnser_es" id="awnser_es-${$faq.order}" placeholder="Awnser Es" class="form-control input-sm">${ $faq.awnser_es }</textarea>
								<div class="error text-danger col-form-label-sm"></div>
							</div>
						</div>
						<div class="col-12 p-3 d-flex justify-content-end">
							<button class="btn btn-success mr-1 active" code="${$faq.code }">Active</button>
							<button class="btn btn-info btn-xs editar mr-1" code="${ $faq.code }">Edit</button>
							<button class="btn btn-danger btn-xs eliminar mr-1" code="${$faq.code }">Delete</button>
						</div>
					</div>
				</div>
			`
			$('#faq-area').append($newItem)
		}

		function clearForm() {
			$('#question_en_add').val('');
			$('#question_es_add').val('');
			$('#awnser_en_add').val('');
			$('#awnser_es_add').val('');
		}
	</script>
@endsection