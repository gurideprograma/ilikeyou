function ilikeyou(pkey,loading){
	$(".ui-icon ui-icon-heart").addClass("red");
	$('#ratemsg').show();
	$('#ratemsg').html(loading);
	$('#ratemsg').load("rate.php", {pkey: pkey});
}
