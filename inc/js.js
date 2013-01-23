function ilikeyou(pkey,loading){
	$(".ui-icon ui-icon-heart").addClass("red");
	$('#ratemsg').show();
	$('#ratemsg').html(loading);
	$('#ratemsg').load("rate.php", {pkey: pkey});
}

function loadPicture(pkey){
	$('#cont').html('<?= LOADING ?>');
	$('#cont').load('pic.php',{n: pkey});
}
