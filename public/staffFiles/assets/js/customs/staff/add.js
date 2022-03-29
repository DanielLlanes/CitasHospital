$(function() {
	$("#selectAll").click(function() {
	    $("input[type=checkbox]").prop("checked", $(this).prop("checked"));
	});
	$("input[type=checkbox]").click(function() {
	    if (!$(this).prop("checked")) {
	        $("#selectAll").prop("checked", false);
	        $(this).parents('.card-body').siblings().find('.selectAllGroup').prop("checked", false);
	    }
	});
	$(".selectAllGroup").click(function() {
	    var input = $(this).parents('.card-head').siblings().find('.check-group')
	    var checked = $(this).is(":checked")
	    if (checked) {
	        input.prop('checked', true);
	    } else {
	        input.prop('checked', false);
	    }
	});

	$("#checkbox-selectAll").click(function() {
	    $(".specialtyCheckbox").prop("checked", $(this).prop("checked"));
	});

	var domain = window.location.protocol+"//"+window.location.hostname+"/";
	$('#basic-url-span').html(domain)
	$(document).on('keyup', '#name', function(){
	    var value = $(this).val();
	    
	    $("#url").val(value.stringToSlug(value))
	})

	function get_assignable(id){
	    var form_data = new FormData();
	    form_data.append('id', id);
	    $.ajax({
	        url: globalRouteGetAssignation,
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
	            $("#valAutocomplete").html('');
	        },
	        success:function(data)
	        {
	            if (data.data.length > 0) {
	                $('.assignable_area_div').show('fast').html('');

	                if (data.data.length == 1) {
	                    $('.assignable_area').hide('fast')
	                    add_asiggnable()
	                    $('[name^="assigned_to"]').val(data.data[0].service)
	                } else {
	                    $('.assignable_area').show('fast')
	                }
	                $.each(data.data, function (indexInArray, val) {
	                    $("#valAutocomplete").append('<option  value="'+val.service+'">'+val.service+'</option>')
	                });

	            }
	        },
	    })
	}

	function getSpecialty(id){
	    var form_data = new FormData();
	    var assignableArray = [];
	    form_data.append('id', id);
	    $.ajax({
	        url: globalRouteGetSpecialty,
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
	            $("#specialtiesArea .col-12:not(:first)").remove();
	            $("#specialty").prop("selectedIndex", 0);
	            $('.assignable_area').hide('fast')
	            $('.assignable_area_div').hide('fast').html('');
	        },
	        success:function(data)
	        {
	            if (data.reload) {
	                Toast.fire({
	                    icon: data.icon,
	                    title: data.msg
	                })
	                location.reload(true);
	            } else {
	                var selected = '';
	                var one = false;
	                if (data.data.length == 1) {
	                    selected = 'checked'
	                    one = true;
	                }
	                var assignables = [];
	                $.each(data.data, function(index, val) {
	                    var  ckhbx = '<div class="col-12">';
	                         ckhbx += '<div class="checkbox checkbox-icon-red form-check form-check-inline">';
	                         ckhbx += '<input id="checkbox-'+val.id+'" '+selected+' assignable="'+val.assignable+'"  name="specialties[]" class="form-check-input specialtyCheckbox" type="checkbox" value="'+val.id+'">';
	                         ckhbx += '<label for="checkbox-'+val.id+'" class="form-check-label" style="font-size: 12px">'+val.name+'</label>';
	                         ckhbx += '</div">';
	                         ckhbx += '</div">';

	                    if (val.assignable) {
	                        assignableArray.push(val.assignable)
	                    }
	                    $('#specialtiesArea').append(ckhbx);
	                });

	                $('#specialyiesRow').show('fast');
	                if (assignableArray.length > 0) {
	                    $('.assignable_area').show('fast')
	                    $('.assignable_area_div').show('fast').html('');
	                    add_asiggnable()
	                }
	            }
	        },
	    })
	}

	$(document).on('change', '#role', function(event) {
	    event.preventDefault();
	    var id = $( "#role option:selected" ).val()
	    if (!isNaN(id)) {
	        getSpecialty(id)
	        //$('.assignable_area').hide('fast')
	        //$('.assignable_area_div').hide('fast').html('');
	    } else {
	        location.reload(true);
	    }
	});

	$(document).on("click", ".btn-remove-assign", function () {
	    $(this).parents('.assigned_cloned').remove();

	    if(document.getElementsByClassName("assigned_cloned").length == 0){
	        add_asiggnable()
	    }
	});

	$('#add_asiggnament').on('click', function(e){
	    add_asiggnable()
	})
});