var imageCount = 1;
var total = 4;
window.setInterval(function photoA() {
	var image = document.getElementById('image');
	imageCount = imageCount + 1;
	if(imageCount > total){imageCount = 1;}
	if(imageCount < 1){imageCount = total;}	
	image.src = "./logos/slider/img"+ imageCount +".png";
	},3000);