<!-- example of getting the blurred image using js -->
<script type="text/javascript">
	var blurBg="/cache"+featured[index-1].image.replace(/^.*\/\/[^\/]+/, '');
		$.get(blurBg)
	    	.done(function() { 
        	//cached file exists
		document.getElementById("featured").style.backgroundImage="url("+blurBg+")";
    			}).fail(function() { 
		        // generate blured bg
			var request = $.ajax({
	    			url: "/blur.php",
			    	type: "GET",
    				data: {
		        	image: featured[index-1].image
    				}
			});
			request.done(function(msg) {
			document.getElementById("featured").style.backgroundImage="url(data:image/jpg;base64,"+msg+")";
			});
   		})
</script>

<!--example of getting the blurred image using php -->
<div style="background: url('data:image/jpg;base64,<?php 
	$path='/cache'.parse_url(dirname($video['thumb']), PHP_URL_PATH).'/'.basename($video['thumb']);
		if (file_exists($path)) 
		{
		$dump=file_get_contents($path);
		echo base64_encode($dump);
		} else {
			$image = new Imagick();
			$image->readImage($video['slika']);
			$image->motionBlurImage(20, 10, 45, 134217727);
			$bgImage = $image->getImageBlob();
			echo base64_encode($bgImage);
			$file=basename($video['slika']);
			$urlpart=dirname($video['slika']);
			$dirs=parse_url($urlpart, PHP_URL_PATH);
			$image->setImageFormat('jpeg');
			mkdir("/var/www/cache/$dirs", 0774, true);
			$image->writeImage("/var/www/cache$dirs/$file");
			$image->clear();
		}
?>') no-repeat;background-size:100%;"> 

