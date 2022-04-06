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

$(function() {
    $(".intTextBox").inputFilter(function(value) { // solo numeros
      return /^-?\d*$/.test(value); });
    $(".uintTextBox").inputFilter(function(value) { // solo enteros > 0
      return /^\d*$/.test(value); });
    $(".intLimitTextBox").inputFilter(function(value) { // limitado a 500
      return /^\d*$/.test(value) && (value === "" || parseInt(value) <= 500); });
    $(".floatTextBox").inputFilter(function(value) { // con decimales
      return /^-?\d*[.,]?\d*$/.test(value); });
    $(".currencyTextBox").inputFilter(function(value) { //modeda
      return /^-?\d*[.,]?\d{0,2}$/.test(value); });
    $(".latinTextBox").inputFilter(function(value) { // solo letas
      return /^[a-z]*$/i.test(value); });
    $(".hexTextBox").inputFilter(function(value) { // exadecimal letas y numeros
      return /^[0-9a-f]*$/i.test(value); });
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    })
});;

