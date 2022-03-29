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
});