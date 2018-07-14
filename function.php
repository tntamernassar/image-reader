<!DOCTYPE HTML>
<html>
<head>
<script src="jquery-1.12.2.min.js"></script>
<title>Function</title>
<style type="text/css">
#function{
	border:1px solid black;
}
</style>
</head>
<body>

<!-- [f(x) = 3x] -->

<canvas id="function" width="500" height="500"></canvas>


<script type="text/javascript">
function drawline(x1,y1,x2,y2){
	
	var c=document.getElementById("function");
	var ctx=c.getContext("2d");
	ctx.beginPath();
	ctx.moveTo(x1,y1);
	ctx.lineTo(x2,y2);
	ctx.stroke();
	
}

function putdot(x,y){
	var c=document.getElementById("function");
	var ctx=c.getContext("2d");
	ctx.fillRect(x,y,1,1);
}

drawline(20,20,20,480);
drawline(20,480,480,480);

var i;
var x,y;

for(i=0;i<=480;i++){
	x = i + 20;
	y = 500 - ( 1 * x) + (2 * x);
	putdot(x,y);
}

</script>

</body>
</html>