$(document).ready(function() {
	var lang = globalAuthUserLang
	if (lang == 'es') {
	    dataTablesLangEs = globalRouteDatatablesLang;
	}

	let ip_address = window.location.hostname;
	let socket_port = '3000';
	let socket = io(ip_address + ':' + socket_port );
	let user_id = globalAuthUserId;
	socket.on('connect', function() {
	   socket.emit('user_connected', user_id);
	});
	
	socket.on('sendMesageDebateToClient', (data) => {
	    let $notifyAra = $('.debateNotifications')
	    $.each(data.members, function(i, val) {
	        if (data.user_id == val.member_id) {
	            $thisData = data.members[i]
	            debateItem($thisData, data)
	        }
	    });
	});

	socket.on('sendNewNotificationToClient', (data) => {
	    if (data.staff_id == user_id) {
	        notifyItem(data);
	    }
	})

	function notifyItem(data) {
	    let notifyList = "";
	    notifyList += '<li>',
	    notifyList += '<a href="javascript:;">',
	    notifyList += '<span class="time">' + data.timeDiff + '</span>',
	    notifyList += '<span class="details">',
	    notifyList += '<span class="notification-icon circle deepPink-bgcolor"><i class="fa fa-check"></i></span> ' + data.message + ' </span>',
	    notifyList += '</a>'
	    notifyList += '</li>'

	    $('.notyNotifications').prepend(notifyList);
	    beep( notification_new )
	}

	function debateItem($thisData, data){
	    let debateList = '';
	    debateList += '<li>';
	    debateList += '<a href="http://prado.test/staff/applications/view/' + data.group_id + ' ">';
	    debateList += '<span class="photo">';
	    debateList += '<img src=" ' + $thisData.member_avatar + ' " class="img-circle" alt=""> </span>';
	    debateList += '<span class="subject">';
	    debateList += '<span class="from"> ' + $thisData.member_name  + ' </span>';
	    debateList += '<span class="time"> ' + data.timeDiff + ' </span>';
	    debateList += '<br>';
	    debateList += '<span class="read" id="msgRead"><i class="fa fa-circle text-primary" title="Unread" aria-hidden="true"></i> </span>';
	    debateList += '</span>';
	    debateList += '<span class="message"> ' + data.msgStrac + ' </span>';
	    debateList += '</a>';
	    debateList += '</li>';

	    var actual = parseInt($('#new-messages-span').html());
	    console.log("actual", actual);

	    if (!isNaN(actual)) {$('#new-messages-span').html((actual + 1))}
	    

	    $('.debateNotifications li .message p').css({
	        'margin-block-start': '0',
	        'margin-inline-start': '0'
	    });
	    $('.debateNotifications').prepend(debateList);
	    beep( message_new )
	}

	const Toast = Swal.mixin({
	    toast: true,
	    position: 'top-end',
	    showConfirmButton: false,
	    timer: 3000,
	    timerProgressBar: true,
	    didOpen: (toast) => {
	        toast.addEventListener('mouseenter', Swal.stopTimer)
	        toast.addEventListener('mouseleave', Swal.resumeTimer)
	    }
	})

	$('.table').magnificPopup({
	      delegate: 'a.a',
	      type: 'image',
	      removalDelay: 500, //delay removal by X to allow out-animation
	      callbacks: {
	        beforeOpen: function() {
	          // just a hack that adds mfp-anim class to markup
	           this.st.image.markup = this.st.image.markup.replace('mfp-figure', 'mfp-figure mfp-with-anim');
	           this.st.mainClass = this.st.el.attr('data-effect');
	        }
	      },
	      closeOnContentClick: true,
	      midClick: true // allow opening popup on middle mouse click. Always set it to true if you don't provide alternative source.
	});

	var drEvent = $('.dropify').dropify();

	var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
	var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
	    return new bootstrap.Tooltip(tooltipTriggerEl)
	})
	var url = window.location;
	$('.sidemenu .nav-item a').each( function(index, val) {
	    if (this.href === url.href || url.href.indexOf(this.href) === 0) {
	        $(this).parent().addClass('active open');
	        $(this).parents('.nav-item').addClass('active open')
	    }
	});
	var sub = $('.sub-menu')
	$.each(sub, function(index, val) {
	    let len = $(this).find('.nav-item').length;
	    if (len == 0) {
	        $(this).parent().remove();
	    }
	});

	var masterMenuSub = $('.master-menu>.sub-menu')
	var masterMenu = $('.master-menu')

	$.each(masterMenuSub, function(index, val) {
	     let count = $(this).find('.nav-item').length
	     if (count == 0) {
	         $(this).parent().remove();
	     }
	});
});