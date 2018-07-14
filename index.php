<!DOCTYPE HTML>
<html>
<head>
<title>Analyzing Image</title>
<script src="jquery-1.12.2.min.js"></script>
<script type="application/javascript" language="javascript">
window.onload = draw;
function rgbToHex(r, g, b) {
    if (r > 255 || g > 255 || b > 255)
        throw "Invalid color component";
    return ((r << 16) | (g << 8) | b).toString(16);
}
function draw() {
	
	var canvas = document.getElementById("canvas1");
	var ctx = canvas.getContext("2d");
   var imageObj = new Image();
	imageObj.src = 'test_image.jpg'; //replace any image you want
	
	
	imageObj.onload = function() {
        ctx.drawImage(imageObj, 0, 0, canvas.width, canvas.height);
      };
	

}
function getPixelColor(x,y) {
	var canvas = document.getElementById("canvas1");
	var ctx = canvas.getContext("2d");
	var p = ctx.getImageData(x, y, 1, 1).data;
		var	 hex = ("000000" + rgbToHex(p[0], p[1], p[2])).slice(-6);
		hex = hex.toUpperCase();
		return hex;
	
}

function detectstopreason(x){
	var canvas = document.getElementById("canvas1");
	var ctx = canvas.getContext("2d");
	
	return (x == canvas.width);
}

function GenerateIC(x,y,pc,v,PIC)
{
	var IC;
	if(v==x)
		IC = PIC + "("+v+","+y+")"+pc+".";
	else 
		IC = PIC + "("+x+"-"+v+","+y+")"+pc+".";
	
	return IC;
}

function GetImageCode(x,y,imagecode){
	var canvas = document.getElementById("canvas1");
	var ctx = canvas.getContext("2d");
	var PC,PCNext;
	var IC;
	var k,v;
	
	PC = getPixelColor(x,y);
	PCNext = getPixelColor(x+1,y);
	
	IC = imagecode;
	k = x+1;
	v=x;

	while((k <= canvas.width) && (PC == PCNext))
	{
		v=k;
		k++;
		if (k<=canvas.width)
			PCNext = getPixelColor(k,y);
		else
			PCNext = getPixelColor(v,y);
	}
	
	if(detectstopreason(v) == true)
		return GenerateIC(x,y,PC,v,IC);
	else
	{
		IC = GenerateIC(x,y,PC,v,IC);
		return GetImageCode(v+1,y,IC);
	}
}

function getp() {
	var canvas = document.getElementById("canvas1");
	var ctx = canvas.getContext("2d");
	var i,x,y,k;
	x = y = 0;
	k = x;
	
	var imagecode;
	imagecode = "";
	
	for (i=y;i<=canvas.height;i++)
		imagecode = imagecode + GetImageCode(x,i,"");
	
	imagecode = imagecode + "";
	imagecode = imagecode.substring(0, imagecode.length -1 );
	  
	 $.post('insert.php',{postimagecode:imagecode , width:canvas.width , height:canvas.height},function (data){
		 $('#phpecho').html(data); 
	  });
}
</script>

</head>
<body>
<canvas id="canvas1" width="300" height="200" ></canvas>
<br/>

<input type="button" id="fun" value="c" width="20" height="30" onclick="getp();"/>
<br />
<br />
<div id="phpecho"></div>

</body>
</html>
