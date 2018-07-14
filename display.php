<?php include "connection.php"; ?>
<html>
<head>
<style type="text/css">
#displayData{
	
	width:100%;
	border: 0px solid black;
	
}
#datafetch {
	
	width:100%;
	border : 1px solid green;
	margin-left:10px;
	margin-top:10px;
	
}
.imgcanvas {
	
	border:0px solid black;
	
}

</style>
<title>Display The Image</title>
<script src="jquery-1.12.2.min.js"></script>
 <div id="testo"></div>
<script type="application/javascript" language="javascript">

function analyzeX(coordinate){	
	return (coordinate.indexOf('-') > -1);
}
 
function dimage(data,id,width,height) {

		
var str = data;
var res = str.split(".");
var len = res.length;
var i,j;
var pcolor,px,py,x1,x2;
var canvas;
/**Creating The particular image canvas**/
canvas = document.getElementById("displayinging_"+id);
var ctx = canvas.getContext("2d");


	


	for(i=0;i<len;i++){
		
		/** get color **/
		var lvl_one_color,lvl_one_color_string;
		lvl_one_color_string = res[i];
		lvl_one_color = lvl_one_color_string.split(")");
		pcolor = lvl_one_color[1];
		pcolor = "#" + pcolor;
		
		/**get X coordinate**/
		var lvl_one_x,lvl_one_x_string,lvl_two_x;
		lvl_one_x_string = res[i];
		lvl_one_x = lvl_one_x_string.split(",");
		lvl_two_x = lvl_one_x[0].split("(");
		px = lvl_two_x[1];
		
		
		/**get Y coordinate**/
		var lvl_one_y,lvl_one_y_string,lvl_two_y;
		lvl_one_y_string = res[i];
		lvl_one_y = lvl_one_y_string.split(",");
		lvl_two_y = lvl_one_y[1].split(")");
		py = lvl_two_y[0];
		
		/** analyzing X again**/
		var check;
		check = analyzeX(px);
		if(check == true)
		{
			
			var temptst = px.split("-");
			x1 = temptst[0];
			x2 = temptst[1];
			
			/** Drawing with multi X**/
			for (j=x1-1;j<=x2+1;j++){
				ctx.fillStyle = pcolor;
			    ctx.fillRect(j,py,1,1);
			}
			
			
		}else{
			/** Drawing with one X**/
			ctx.fillStyle = pcolor;
			ctx.fillRect(px,py,1,1);
			
		}
	
	}

	
}




</script>

</head>


<div id="displayData">
<?php

$query = mysql_query("SELECT * FROM images ORDER BY id DESC");
while ($row = mysql_fetch_assoc($query))
{
	
	$id = $row['id'];
	$imagedata = $row['image_code'];
	$width = $row['width'];
	$height = $row['height'];
	
	
	?>
	<div id="image_holder">
	<canvas class="imgcanvas" id="displayinging_<?php echo $id; ?>" width="<?php echo $width; ?>" height="<?php echo $height; ?>"></canvas><br /><br />
	<script>dimage("<?php echo $imagedata; ?>",<?php echo $id; ?>,<?php echo $width; ?>,<?php echo $height; ?>);</script>
	<?php
	
	
}

?>
</div>
</div>
<script type="text/javascript">
/******************* Display Pixel Data **********************/
 function writeMessage(canvas, message) {
        var context = canvas.getContext('2d');
        $('#testo').html(message); 
      }
	  
	    function getMousePos(canvas, evt) {
        var rect = canvas.getBoundingClientRect();
        return {
          x: evt.clientX - rect.left,
          y: evt.clientY - rect.top
        };
      }

	  
	  function rgbToHex(r, g, b) {
    if (r > 255 || g > 255 || b > 255)
        throw "Invalid color component";
    return ((r << 16) | (g << 8) | b).toString(16);
}
function getPixelColor(x,y) {
	var canvas = document.getElementById("displayinging_47");
	var ctx = canvas.getContext("2d");
	var p = ctx.getImageData(x, y, 1, 1).data;
		var	 hex = ("000000" + rgbToHex(p[0], p[1], p[2])).slice(-6);
		hex = hex.toUpperCase();
		return hex;
	
}


	  
	   var canvas = document.getElementById('displayinging_47');
      var context = canvas.getContext('2d');

      canvas.addEventListener('mousemove', function(evt) {
        var mousePos = getMousePos(canvas, evt);
		var c = getPixelColor(mousePos.x,mousePos.y);
        var message = "("+mousePos.x+","+mousePos.y+")#"+c;
        writeMessage(canvas, message);
	
      }, true);
/*****************************************/	 


</script>

</body>
</html>