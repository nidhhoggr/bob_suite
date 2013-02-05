
$(document).ready(function(){
	$('#cropbox').Jcrop({
		aspectRatio: cwidth/cheight,
	
		onChange: showCoords,
		onSelect: showCoords  //no ',' here due to IE issue
		//onChange: showPreview,
	});

});

function showCoords(c)
{
	$('#edit-x1').val(c.x);
	$('#edit-y1').val(c.y);
	$('#edit-x2').val(c.x2);
	$('#edit-y2').val(c.y2);
	$('#edit-w').val(c.w);
	$('#edit-h').val(c.h);
};

/*
function showPreview(coords)
{
	var rx = 100 / coords.w;
	var ry = 100 / coords.h;

	$('#preview').css({
		width: Math.round(rx * 500) + 'px',
		height: Math.round(ry * 370) + 'px',
		marginLeft: '-' + Math.round(rx * coords.x) + 'px',
		marginTop: '-' + Math.round(ry * coords.y) + 'px'
	});
}
*/
