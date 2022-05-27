@extends('staff.layouts.app')
@section('title')
	@lang('Testimonials')
@endsection
@section('styles')

	<link rel="stylesheet" href="{{ asset('staffFiles/assets/plugins/pagination/pagination.css') }}">
	{{-- expr --}}
@endsection
@section('content')
<div class="page-bar">
	<div class="page-title-breadcrumb">
		<div class=" pull-left">
			<div class="page-title">@lang('Testimonials Manager')</div>
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
			<li class="active">@lang('Testimonials Manager')</li>
		</ol>
	</div>
</div>

<div class="row">
	<div class="col-md-12 col-sm-12">
		<div class="card card-box">
			<div class="card-head">
				<header>Testimonial Images, After - Before</header>
				<div class="toolxs" style="float: right; padding-left: 16px;margin-left: 24px!important; line-height: normal; vertical-align: middle;margin-top: 7px; margin-bottom: 7px">
					<a class="fa fa-plus btn-color btn btn-success btn-sm button-add-image" href="javascript:;"> Agregar image</a>
				</div>
			</div>
			<div class="card-body" id="line-parent">
				<div class="row justify-content-center">
					<div class="col-4 d-none d-md-block"></div>
					<div class="col-12 col-md-4">
						<p class="font-weight-bold"><span>Select brand</span></p>
						<select name="brand" id="brand-search-select"></select>
						<br>
						<p class="font-weight-bold mt-5"><span>Select procedure</span></p>
						<select name="brand" id="procedure-search-select"></select>
					</div>
					<div class="col-4 d-none d-md-block"></div>
				</div>
				<div class="row" style="flex-flow: column;">
				    <h5 class="font-weight-bold mt-5 mb-3">Upload Images: <span id="brand-name-span" class="text-uppercase"></span><span id="procedure-name-span" class="text-uppercase"></span></h5>
				    <form class="" id="TestimonialsImagesForm">
				        <div class="row clone-area sortable" id="testimonialsImageArea">

				        </div>
				    </form>
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
		globalRouteSubmitTestimonials = '{{ route('staff.public_page.store') }}'
		globalRouteSearchBrand = "{{ route('staff.autocomplete.AutocompleteBrand') }}";
		globalRouteGetTestimonials = '{{ route('staff.public_page.getTestimonials') }}';
		globalRouteStore = "{{ route('staff.public_page.storeTestimonials') }}"
		globalUpdateOrder = '{{ route('staff.public_page.updateOrderTest') }}'
		globalRouteDestroy = '{{ route('staff.public_page.destroyTest') }}'

		globalRouteEditTestimonials = '{{ route('staff.public_page.update') }}'
		var sliderCount = '{{ count($slider) }}';
    </script>

    <script type="text/javascript" src="{{ asset('staffFiles/assets/plugins/pagination/pagination.js') }}"> </script>

    <script>

    		$('#testimonialsImageArea').sortable({  
	            update: function( event, ui ) {
	            	let $count = $(this).find('.cloneImageArea').length
	            	let $child = $(this).find('.cloneImageArea');
	            	$.each($child, function(index, val) {
	            		let $order = (index+1); 

	            		$(this).attr('data-clone', $order).addClass('updated')
	            		$(this).attr('data-order', $order)

	            		$(this).find("[id^='image_file-']").attr('id', "image_file-"+$order)
	            	});
	            	updateOrder()
	            },
	         });

    	$domain = window.location.origin+"/";
    	$('#brand-search-select').empty().attr('placeholder', "Select brand here").trigger('change')
    	$('#brand-search-select').select2({
    	    placeholder: "Select brand here",
    	    ajax: {
    	        url: globalRouteSearchBrand,
    	        type: 'post',
    	        dataType: 'json',
    	        data: function (params) {
    	        	return {
    	        		search: params.term,
    	        		procedures: true,
    	        	}
    	        },
    	        processResults: function(data) {
    	        	return {
    	        		results: $.map(data, function(obj) {
    	        			return {
    	        				id: obj.id,
    	        				text: obj.brand,
    	        				code: obj.code,
    	        				acronym: obj.acronym,
    	        				procedures: obj.procedure_brand,
    	        			};
    	        		})
    	        	};
    	        },
    	        cache: true,
    	    }
    	});
    	$(document.body).on("change","#brand-search-select",function(){
    		$('#procedure-search-select').val(null).trigger('change');
    		$('#procedure-search-select').empty().attr('placeholder', "Select procedure here").trigger('change');
    		$('#procedure-name-span').html('')
    		$('#brand-name-span').html('')
    	});
    	$('#procedure-search-select').empty().attr('placeholder', "Select procedure here").trigger('change')
    	$('#procedure-search-select').select2({
    		placeholder: "Select procedure here",
    	})
    	$('#brand-search-select').on('select2:select', function (e) {
    	    var data = e.params.data;
    	    var newData = [];
    	    $('#procedure-search-select').empty();
    	    $.each(data.procedures, function(index, val) {
    	    	var id = val.id;
    	        var text = val.procedure;
    	        var code = val.code;

    	        item = {}
    	        item ["id"] = id;
    	        item ["text"] = text;
    	        item ["code"] = code;
    	        newData.push(item);
    	    });
    	    $('#procedure-search-select').select2({
    	    	placeholder: "Select procedure here",
    	    	data : newData,
    	    })
			$('#procedure-search-select').val(null).trigger('change');
    	});

    	$('#procedure-search-select').on('select2:select', function (e) {
    		var data = e.params.data;
    		//console.log("data", data);
    	    getTestimonials()
    	});

    	$(document).on('click', '.addBtnImg', function(event) {
    		event.preventDefault();
    		$parent = $(this).parents('.cloneImageArea ')
    		$image  = $(this).parents('.cloneImageArea ').find('.dropify').prop('files')[0];
    		$random = Date.now();
    		if ($image) {
    			$parent.addClass(String($random));
    			uploadImage($image, $random, $parent);
    		}
    	});

    	$(document).on('click', '.button-add-image', function(event) {
    		event.preventDefault();
    		brandData = $('#brand-search-select').select2('data');
    		procedureData = $('#procedure-search-select').select2('data');
    		if (brandData.length > 0 && procedureData.length > 0) {
    			$('#testimonialsImageArea').prepend(addImageTestimonial(null, procedureData[0], brandData[0]));
    			$('.dropify').dropify();
    		}
    	});
    	$(document).on('click', '.delBtnImg', function(event) {
    		event.preventDefault();
    		var id = $(this).parents('.cloneImageArea').attr('data-testimonial');
    		var clone = $(this).parents('.cloneImageArea');
    		if (!id) {$(this).parents('.cloneImageArea').remove(); return}
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

    	function addImageTestimonial(testimonial = null, procedure = null, brand = null, $image = null, $order = null){
    		$testimonialCode = (testimonial === null)? "": testimonial.code;
    		$procedureCode = (procedure === null)? "": procedure.code;
    		$brandCode = (brand === null)? "": brand.code;
    		$imageCode = '';

    		if (testimonial != null) {
    			$imageCode = (testimonial.image_one === null)? "": testimonial.image_one.code;
    		}

    		let $html =`
    		<div class="col-md-3 cloneImageArea" style="cursor: move; border: 1px solod #555" data-parent="#testimonialsImageArea" data-clone="${$order}" data-order="${$order}" data-brand="${$brandCode}" data-procedure="${$procedureCode}" data-testimonial="${$testimonialCode}">
    		    <div class="form-group">
    		        <div class="error text-danger"></div>
    		        <input type="file" class="form-control dropify image_file-${$order}" count="" id="image_file-${$order}" name="image" code="" accept="image/*" data-image="${$imageCode}">
    		        <div class="error text-danger"></div>
    		    </div>
    		    <div class="col-12" id="delbtn">
                    <div class="form-group d-flex justify-content-around" id="delBtnDiv">
                        <button type="button" class="btn addBtnImg btn-success ">Add image</button>
                        <button type="button" class="btn actBtnImg btn-warning ">Activate image</button>
                        <button type="button" class="btn delBtnImg btn-danger">delete image</button>
                    </div>
                    <hr>
                </div>
			</div> 
    		`;

    		return $html;
    	}
    	function getTestimonials(){
    		brandData = $('#brand-search-select').select2('data');
    		procedureData = $('#procedure-search-select').select2('data');
    		var dataString = new FormData()
    		dataString.append('brand', JSON.stringify(brandData))
    		dataString.append('procedure', JSON.stringify(procedureData))
    		$.ajax({
    			type: "POST",
    			url: globalRouteGetTestimonials,
    			method:"POST",
    			data:dataString,
    			dataType:'JSON',
    			contentType: false,
    			cache: false,
    			headers: {
    				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    			},
    			processData: false,
    			beforeSend: function(){

    			},
    			success: function(data) {

    				$('#testimonialsImageArea').empty();
    				$('#procedure-name-span').html(data.procedure.procedure)
    				$('#brand-name-span').html(data.brand.brand+", ")
    				if (data.testimonial.length > 0) {
    					$.each(data.testimonial, function(index, testimonial) {
    						$order = (index+1);
    						if (testimonial.image_one !== null) { $image = testimonial.image_one.image;} else {$image = null;}
    						$('#testimonialsImageArea').prepend(addImageTestimonial(testimonial, data.procedure, data.brand, $image, $order));
					    	$('#image_file-'+$order).attr("data-default-file", $domain+$image);
    						$('#image_file-'+$order).dropify();
    					});
    				} else {
    					$('#testimonialsImageArea').prepend(addImageTestimonial(null, data.procedure, data.brand));
    					$('.dropify').dropify();
    				}
    				
    				if (data.reload) {
    					Toast.fire({
    						icon: data.icon,
    						title: data.msg
    					})

    					//socket.emit('eventCalendarRefetchToServer');
    				} else {
    					$.each( data.errors, function( key, value ) {
    						$('*[id^='+key+']').parent().find('.error').append('<p>'+value+'</p>')
    					});
    				}
    			}
    		});
    	}
    	function clearDropify($random){ 
    	}
    	function uploadImage(image, $random, $parent) {
    		brandData = $('#brand-search-select').select2('data');
    		procedureData = $('#procedure-search-select').select2('data');
    		var dataString = new FormData()
    		dataString.append('brand', JSON.stringify(brandData));
    		dataString.append('procedure', JSON.stringify(procedureData));
    		dataString.append('image', image);
    		$.ajax({
    			type: "POST",
    			url: globalRouteStore,
    			method:"POST",
    			data:dataString,
    			dataType:'JSON',
    			contentType: false,
    			cache: false,
    			headers: {
    				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    			},
    			processData: false,
    			beforeSend: function(){

    			},
    			success: function(data) {
    				if (!data.reload) {
    					Toast.fire({
    						icon: data.icon,
    						title: data.msg
    					})


    				if (data.testimonial) {
						if (data.testimonial.image_one !== null) { $image = data.testimonial.image_one.image;} else {$image = null;}
						if (data.testimonial.image_one !== null) { $code = data.testimonial.image_one.code;} else {$code = null;}
						let $getDrop = $("."+$random).find('.dropify')
						$parent.attr('data-testimonial', data.testimonial.code)
						console.log("data.testimonial.code", data.testimonial.code);
				    	
				    	$getDrop.attr("data-image", $code);
				    	var drDestroy = $($getDrop).dropify();
				    	drDestroy = drDestroy.data('dropify')
			    		if (drDestroy.isDropified()) {
			    			drDestroy.destroy();
			    			drDestroy.resetPreview();
			    			drDestroy.clearElement();
			    			drDestroy.settings.defaultFile = $domain+$image;
			    			drDestroy.init();

			    		}
    				}
    				$parent.removeClass($random)
    					//socket.emit('eventCalendarRefetchToServer');
    				} else {
    					$.each( data.errors, function( key, value ) {
    						$('*[id^='+key+']').parent().find('.error').append('<p>'+value+'</p>')
    					});
    				}
    			}
    		});
    	}
    	function updateOrder() {
    		
    		$parent = document.getElementById('sortable');
    		$count = document.querySelectorAll('.updated');
    		brandData = $('#brand-search-select').select2('data');
    		procedureData = $('#procedure-search-select').select2('data');
    		var dataString = new FormData()
    		dataString.append('brand', JSON.stringify(brandData));
    		dataString.append('procedure', JSON.stringify(procedureData));
			//return
    		$.ajax({
    			url: globalUpdateOrder,
    	       	method:"POST",
    	       	data:dataString,
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
    	       		  $('.cloneImageArea').removeClass('updated')
    	       		});
    	       		Toast.fire({
    	       			icon: data.icon,
    	       			title: data.title,
    	       		})
    	       },
    		})
    	}
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
    	        console.log("data", data);
    	            Toast.fire({
    	              icon: data.icon,
    	              title: data.msg
    	            })


    	            //if (data.reload) {
    	            	clone.remove()
    	            	$count_slider = $('#sortable > .clone').length;
    	            	//if ($count_slider == 0) {addSlider($count_slider+1)}
    	            //}
    	            
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
    	
    </script>
@endsection
