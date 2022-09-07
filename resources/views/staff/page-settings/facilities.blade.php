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
	    $( function() {
		    $( "#sortable" ).sortable({
		    	update: function( event, ui ) {
		    		let $count = $(this).find('.clone').length
		    		let $child = $(this).find('.clone');
		    		$.each($child, function(index, val) {
		    			let $order = (index+1); 
		    			$(this).attr('data-clone', $order).addClass('updated')
		    			$(this).find('.accordion-toggle').attr('href', '#facilities-'+ $order)
		    			
		    			$(this).find("[id^='facilities-']").attr('id', "facilities-"+$order)
		    			$(this).find("[id^='delete-']").attr('id', "facilities-"+$order)
		    			$(this).find('input[name="title"]').attr('id', 'title-'+ $order)
		    			$(this).find('input[name="caption"]').attr('id', 'caption-'+ $order)
		    			//imagee
		    			$(this).find('input[name="image"]').attr('id', 'image-'+ $order)
		    			$(this).find("[id^='imagePreview-']").attr('id', "imagePreview-"+$order)
		    			$(this).find("[id^='view-']").attr('id', "view-"+$order)
		    			$(this).find("[id^='image-view-']").attr('id', "image-view-"+$order)
		    			//video
		    			$(this).find("[id^='videoPreview-']").attr('id', "videoPreview-"+$order)
		    			$(this).find("[id^='preview-']").attr('id', "preview-"+$order)
		    			$(this).find('input[name="video-"]').attr('id', 'video-'+ $order)

		    		});
		    		updateOrder()
		    	},
		    	axis: "y",
		    });
		    if (facilitiesCount == 0) {addFaclities(1)}

		    $(document).on('click', '.button-add-facilities', function(event) {
		    	event.preventDefault();
		    	$count_facilities = $('#sortable > .clone').length;
		    	addFaclities($count_facilities+1);
		    });
		    $(document).on('click', '.btn-submit', function(event) {
		    	event.preventDefault();
		    	$clone = $(this).parents('.clone');
		    	$order = $clone.attr('data-clone')
		    	$title_en = $clone.find('[name="title_en"]')
		    	$title_es = $clone.find('[name="title_es"]')
		    	$descripcion_en = $clone.find('[name="description_en"]')
		    	$descripcion_es = $clone.find('[name="description_es"]')
		    	$image = $clone.find('[name="image"]');
		    	$caption_en = $clone.find('[name="caption_en"]');
		    	$caption_es = $clone.find('[name="caption_es"]');
		    	$form_data = new FormData()
		    	$form_data.append('title_en', $title_en.val())
		    	$form_data.append('title_es', $title_es.val())
		    	$form_data.append('order', $order)
		    	$form_data.append('caption_en', $caption_en.val())
		    	$form_data.append('caption_es', $caption_es.val())
		    	$form_data.append('image', $image.prop('files')[0])
		    	$form_data.append('description_es', $descripcion_es.val())
		    	$form_data.append('description_en', $descripcion_en.val())
		    	$(this).prop('id', 'btn-add-'+$order);
		    	submitFacilities($form_data);
		    });
		    $(document).on('click', '.delete-button-facilities', function(e) {
		        e.preventDefault();
		        var id = $(this).attr('code');
		        var clone = $(this).parents('.clone')
		        Swal.fire({
		            title: '¿Esta seguro?',
		            icon: 'warning',
		            showCancelButton: true,
		            confirmButtonColor: '#3085d6',
		            cancelButtonColor: '#d33',
		            confirmButtonText: 'Si, borrarlo!'
		        }).then((result) => {
		            if (result.value) {
		                deleteRecord(id, clone)
		            } else if (result.dismiss) {
		                Swal.fire(
		                    'Cancelado!',
		                    'Ningun registro fue eliminado.',
		                    'error'
		                )
		                e.preventDefault()
		                e.stopPropagation();
		            }
		        })
		    });
		    $(document).on('click', '.btn-edit', function(event) {
		    	event.preventDefault();
		    	$clone = $(this).parents('.clone');
		    	$order = $clone.attr('data-clone')
		    	$title = $clone.find('[name="title"]').val()
		    	$slogan = $clone.find('[name="slogan"]').val()
		    	$image = $clone.find('[name="image"]');
		    	$video = $clone.find('[name="video"]');
		    	$form_data = new FormData()
		    	$form_data.append('title', $title)
		    	$form_data.append('order', $order)
		    	$form_data.append('slogan', $slogan)
		    	$form_data.append('image', $image.prop('files')[0])
		    	$form_data.append('video', $video.prop('files')[0])
		    	$form_data.append('code', $(this).attr('code-id'))
		    	$(this).prop('id', 'btn-add-'+$clone);
		    	editFaclities($form_data);
		    });
		    $(document).on('click', '.delete-local', function(event) {
		    	event.preventDefault();
		    	var clone = $(this).parents('.clone')
		    	clone.remove()
		    	$count_facilities = $('#sortable > .clone').length;
		    	if ($count_facilities == 0) {addFaclities($count_facilities+1)}
		    });
		});
		function updateOrder() {
			$parent = document.getElementById('sortable');
			$count = document.querySelectorAll('.updated');
			$count.forEach(function (item, index) {
			  	
			});
			$.ajax({
				url: globalUpdateOrder,
		       	method:"POST",
		       	data:{param1: 'value1'},
		       	dataType:'JSON',
				contentType: false,
				cache: false,
				headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				processData: false,
				beforeSend: function(){
				},
		       	success:function(data){
		       		$count.forEach(function (item, index) {
		       		  $(this).removeClass('updated')	
		       		});
		       		Toast.fire({
		       			icon: data.icon,
		       			title: data.title,
		       		})
		       },
			})
		}
		function clearDropify(){
		    drEvents = drEvent.data('dropify');
		    drEvents.resetPreview();
		    drEvents.clearElement();
		}
		function editFaclities(formData) {
			$.ajax({
				url: globalRouteEditFaclities,
		       	method:"POST",
		       	data:formData,
		       	dataType:'JSON',
				contentType: false,
				cache: false,
				headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				processData: false,
				beforeSend: function(){
				},
		       	success:function(data){
		       		if (data.hasOwnProperty('success') ){
		       			$.each( data.errors, function( key, value ) {
		       				var Nkey = key.replace('.', '-')
		       				$('#'+key.replace('.', '-')).parent().find('.error').text(value)
		       				$('#'+key.replace('.', '-')).parent().addClass('has-error has-danger')
		       			});
		       			return
		       		}

		       		if (data.reload) {
		       			if (data.hasOwnProperty('image')) {
		       				loadImage(data.order)
		       			}
		       			if (data.hasOwnProperty('video')) {
		       				loadVideo(data.order)
		       			}

		       			$('delete-' + data.order).prop('code', data.facilities.code)
		       			$('btn-add-' + $order).removeClass('btn-submit').addClass('btn-edit').html('EDIT').prop('code-id', data.facilities.code)

		       		}
		       		Toast.fire({
		       			icon: data.icon,
		       			title: data.title,
		       		})
		       },
			})
		}
		function submitFacilities(formData) {
			$.ajax({
				url: globalRouteSubmitFaclities,
		       method:"POST",
		       data:formData,
		       dataType:'JSON',
		       contentType: false,
		       cache: false,
		       headers: {
		           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		       },
		       processData: false,
		       beforeSend: function(){
		       },
		       success:function(data){
		       	console.log("data", data);

		       	if (data.hasOwnProperty('success') ){
		       		$.each( data.errors, function( key, value ) {
		       			var Nkey = key.replace('.', '-')
		       			$('#'+key.replace('.', '-')).parent().find('.error').text(value)
		       			$('#'+key.replace('.', '-')).parent().addClass('has-error has-danger')
		       		});
		       		return
		       	}

		       	if (data.reload) {
		       		if (data.hasOwnProperty('image')) {
		       			loadImage(data.order)
		       		}
		       		if (data.hasOwnProperty('video')) {
		       			loadVideo(data.order)
		       		}

		       		$('#delete-' + data.order).prop('code', data.facilities.code)
		       		$('#delete-' + data.order).removeClass('delete-local').addClass('delete-button-facilities').attr('code', data.facilities.code)
		       		$('#btn-add-' + $order).removeClass('btn-submit').addClass('btn-edit').html('EDIT').prop('code-id', data.facilities.code)

		       	}
		       	Toast.fire({
		       		icon: data.icon,
		       		title: data.title,
		       	})
		       },
			})
		}
		function loadImage(order) {
			const input = document.getElementById('image-'+ order);
			const image = document.getElementById('image-view-'+ order);
			let hidden = document.getElementById('imagePreview-'+ order)
			hidden.style.display = 'block';
			
			var reader = new FileReader();
			reader.onload = function(){
				image.src = reader.result;
			};
			reader.readAsDataURL(input.files[0]);
			$('#image-'+ order).parents(".form-group").find('.dropify-clear').click();
		};
		function loadVideo(order) {
			const input = document.getElementById('video-'+ order);
			const video = document.getElementById('preview-'+ order);
			let hidden = document.getElementById('videoPreview-'+ order)
			hidden.style.display = 'block';

			const videoSource = document.createElement('source');
			var reader = new FileReader();
			reader.onload = function (e) {
			    videoSource.setAttribute('src', e.target.result);
			    video.appendChild(videoSource);
			    video.load();
			    video.play();
			 };
			reader.readAsDataURL(input.files[0]);
			$('#video-'+ order).parents(".form-group").find('.dropify-clear').click();
		};
		function deleteRecord(id, clone){
		    var form_data = new FormData();
		    form_data.append('id', id);
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
		            Toast.fire({
		              icon: data.icon,
		              title: data.msg
		            })


		            if (data.reload) {
		            	clone.remove()
		            	$count_facilities = $('#sortable > .clone').length;
		            	if ($count_facilities == 0) {addFaclities($count_facilities+1)}
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
		function addFaclities(order) {
			$facilities = `
				<div class="panel panel-default clone" data-clone="${order}">
					<div class="panel-heading panel-heading-gray">
						<h4 class="panel-title">
							<a class="accordion-toggle accordion-toggle-styled" data-toggle="collapse"  data-parent="#sortable" href="#facilities-${order}">New Facility</a>
							<div class="toolxs" style="float: right; padding-left: 16px;margin-left: 24px!important; line-height: normal; vertical-align: middle;margin-top: 7px; margin-bottom: 7px">
								<a class="fa fa-trash btn-color btn btn-danger btn-sm delete-local" id="delete-${order}" href="javascript:;"> Eliminar</a>
							</div>
						</h4>
					</div>
					<div id="facilities-${order}" class="panel-collapse in collapse show">
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
													<input type="text" name="title_en" id="title_en-${order}" placeholder="Title En" class="form-control input-sm">
													<div class="error text-danger col-form-label-sm"></div>
												</div>
											</div>
											<div class="form-group mb-2">
												<label class="control-label col-form-label-sm col-md-3 text-left text-nowrap">Title Es
													<span class="required"> * </span>
												</label>
												<div class="col-md-12">
													<input type="text" name="title_es" id="title_es-${order}" placeholder="Title Es" class="form-control input-sm">
													<div class="error text-danger col-form-label-sm"></div>
												</div>
											</div>
											<div class="form-group mb-2">
												<label class="control-label col-form-label-sm col-md-3 text-left text-nowrap">Description En
													<span class="required"> * </span>
												</label>
												<div class="col-md-12">
													<textarea cols="15" rows="10" type="text" name="description_en" id="description_en-${order}" placeholder="Description En" class="form-control input-sm"></textarea>
													<div class="error text-danger col-form-label-sm"></div>
												</div>
											</div>
											<div class="form-group mb-2">
												<label class="control-label col-form-label-sm col-md-3 text-left text-nowrap">Description Es
													<span class="required"> * </span>
												</label>
												<div class="col-md-12">
													<textarea cols="15" rows="10" type="text" name="description_es" id="description_es-${order}" placeholder="Description Es" class="form-control input-sm"></textarea>
													<div class="error text-danger col-form-label-sm"></div>
												</div>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group mb-2">
												<label class="control-label col-form-label-sm col-md-3 text-left text-nowrap">Cover Image              
													<span class="required"> * </span>
												</label>
												<div class="col-md-12">
													<input type="file" name="image" id="image-${order}" class="dropify" accept="image/*"/>
													<div class="error text-danger col-form-label-sm"></div>
												</div>
											</div>
											<div class="form-group mb-2" id="imagePreview-${order}" style="display:none">
												<label class="control-label col-form-label-sm col-md-3 text-left text-nowrap">Cover Image              
													<span class="required"> * </span>
												</label>
												<div class="col-md-12">
												 <img src="" alt="" id="image-view-${order}" class="img-fluid" style="width: 100%; height:240px">
												</div>
											</div>
											<div class="form-group mb-2">
												<label class="control-label col-form-label-sm col-md-3 text-left text-nowrap">Caption En
													<span class="required"> * </span>
												</label>
												<div class="col-md-12">
													<input type="text" name="caption_en" id="caption_en-${order}" placeholder="Caption En" class="form-control input-sm">
													<div class="error text-danger col-form-label-sm"></div>

												</div>
											</div>
											<div class="form-group mb-2">
												<label class="control-label col-form-label-sm col-md-3 text-left text-nowrap">Caption Es 
													<span class="required"> * </span>
												</label>
												<div class="col-md-12">
													<input type="text" name="caption_es" id="caption_es-${order}" placeholder="Caption Es" class="form-control input-sm">
													<div class="error text-danger col-form-label-sm"></div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group">
									<div class="offset-md-10 col-md-12">
										<button type="submit" class="btn btn-info btn-submit">Submit</button>
										<button type="button" class="btn btn-default btn-cancel">Cancel</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			`;
			$('#sortable').append($facilities);
			$('.dropify').dropify();
		}
    </script>

@endsection