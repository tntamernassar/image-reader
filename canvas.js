
var CV = CV || {};
pic = new Image();

CV.loadImage = function () {
	
	canvas.drawImage(pic, 0, 0);
	
};

CV.initialize = function ()
{
	console.log('start');
	cv = $('#canvas')[0];
	canvas = cv.getContext('2d');
	/** Load Image **/
     	pic.src = "pa.jpg";
		pic.addEventListener("load", CV.loadImage, false);
};