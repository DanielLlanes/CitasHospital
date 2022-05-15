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
		var sliderCount = '{{ count($slider) }}';
    </script>

    <script type="text/javascript">  
    	$( function() {
    	    $( "#sortable" ).sortable();
    	    if (sliderCount == 0) {addSlider(1)}

    	    $(document).on('click', '.button-add-slider', function(event) {
    	    	event.preventDefault();
    	    	$count_slider = $('#sortable > .clone').length;
    	    	addSlider($count_slider+1);
    	    });
    	    $(document).on('click', '.btn-submit', function(event) {
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
    	    	$(this).prop('id', 'btn-add-'+$order);
    	    	submitSlider($form_data);
    	    });
    	    $(document).on('click', '.delete-button-slider', function(e) {
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
    	    	editSlider($form_data);
    	    });
    	    $(document).on('click', '.delete-local', function(event) {
    	    	event.preventDefault();
    	    	var clone = $(this).parents('.clone')
    	    	clone.remove()
            	$count_slider = $('#sortable > .clone').length;
            	if ($count_slider == 0) {addSlider($count_slider+1)}
    	    });
    	});
    	
    	function clearDropify(){
    	    drEvents = drEvent.data('dropify');
    	    drEvents.resetPreview();
    	    drEvents.clearElement();
    	}
		function editSlider(formData) {
			$.ajax({
				url: globalRouteEditSlider,
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

	           			$('delete-' + data.order).prop('code', data.slider.code)
	           			$('btn-add-' + $order).removeClass('btn-submit').addClass('btn-edit').html('EDIT').prop('code-id', data.slider.code)

	           		}
	           		Toast.fire({
	           			icon: data.icon,
	           			title: data.title,
	           		})
	           },
			})
		}
    	function submitSlider(formData) {
    		$.ajax({
    			url: globalRouteSubmitSlider,
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

               		$('#delete-' + data.order).prop('code', data.slider.code)
               		$('#delete-' + data.order).removeClass('delete-local').addClass('delete-button-slider').attr('code', data.slider.code)
               		$('#btn-add-' + $order).removeClass('btn-submit').addClass('btn-edit').html('EDIT').prop('code-id', data.slider.code)

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
    	            	$count_slider = $('#sortable > .clone').length;
    	            	if ($count_slider == 0) {addSlider($count_slider+1)}
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
    	function addSlider(order) {
    		$slider = `
    			<div class="panel panel-default clone" data-clone="${order}">
    				<div class="panel-heading panel-heading-gray">
    					<h4 class="panel-title">
    						<a class="accordion-toggle accordion-toggle-styled" data-toggle="collapse"  data-parent="#sortable" href="#slider-${order}">Add New</a>
    						<div class="toolxs" style="float: right; padding-left: 16px;margin-left: 24px!important; line-height: normal; vertical-align: middle;margin-top: 7px; margin-bottom: 7px">
    							<a class="fa fa-trash btn-color btn btn-danger btn-sm delete-local" id="delete-${order}" href="javascript:;"> Eliminar</a>
    						</div>
    					</h4>
    				</div>
    				<div id="slider-${order}" class="panel-collapse in">
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
    												<input type="text" name="title" id="title-${order}" placeholder="Title" class="form-control input-sm">
    												<div class="error text-danger col-form-label-sm"></div>
    											</div>
    										</div>
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
    											 <img src="" alt="" id="image-view-${order}" class="img-fluid">
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
    												<input type="file" name="video" id="video-${order}" class="dropify" accept="video/*"/>
    												<div class="error text-danger col-form-label-sm"></div>
    											</div>
    										</div>
    										<div class="form-group mb-2" id="videoPreview-${order}" style="display: none">
    											<label class="control-label col-form-label-sm col-md-3 text-left text-nowrap">Video Preview 
    												<span class="required"> * </span>
    											</label>
    											<div class="col-md-12">
    												<video width="100%" id="preview-${order}" height="240" controls>
    												  Your browser does not support the video tag.
    												</video>
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
    		$('#sortable').append($slider);
    		$('.dropify').dropify();
    	}
    </script>
@endsection
