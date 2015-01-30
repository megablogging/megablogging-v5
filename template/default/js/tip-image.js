/*
 * Url preview script 
 * powered by jQuery (http://www.jquery.com)
 * 
 * written by Alen Grakalic (http://cssglobe.com)
 * 
 * for more info visit http://cssglobe.com/post/1695/easiest-tooltip-and-image-preview-using-jquery
 *
 */
 
this.tipimagePreview = function(){	
	/* CONFIG */
		
		xOffset = 210;
		yOffset = 12;
		
		// these 2 variable determine popup's distance from the cursor
		// you might want to adjust to get the right result
		
	/* END CONFIG */
	$("a.tipimage").hover(function(e){
		this.t = this.title;
		this.title = "";	
		var c = (this.t != "") ? "<br/>" + this.t : "";
		$("body").append("<p id='tipimage'><img width='380px' height='200px' src='"+ this.rel +"' alt='url preview' />"+ c +"</p>");								 
		$("#tipimage")
			.css("top",(e.pageY - xOffset) + "px")
			.css("left",(e.pageX + yOffset) + "px")
			.fadeIn("slow");						
    },
	function(){
		this.title = this.t;	
		$("#tipimage").remove();
    });	
	$("a.tipimage").mousemove(function(e){
		$("#tipimage")
			.css("top",(e.pageY - xOffset) + "px")
			.css("left",(e.pageX + yOffset) + "px");
	});			
};


// starting the script on page load
$(document).ready(function(){
	tipimagePreview();
});