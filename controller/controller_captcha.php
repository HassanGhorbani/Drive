<?php

/*
 * get 2 param, width and height
 * create empty image with width and height
 * create line
 * create dots
 * random number
 * create image with random number and dots and lines
 * echo the address
 */
	function create_captcha($width,$height)
	{
        session_start();
		//create image
		$image = imagecreatetruecolor($width,$height);
		
		//set the back color of image
		$bg_color = imagecolorallocate($image,255,255,255);
		imagefilledrectangle($image,0,0,$width,$height,$bg_color);
		
		//set the line color
		$line_color = imagecolorallocate($image,0,200,200);
		for($i=0;$i<10;$i++) {
 		   imageline($image,0,rand(0,$height),$width,rand(0,$height),$line_color);
		}
		
		//set the pixel color of image
		$pixel_color = imagecolorallocate($image, 0,0,255);
		for($i=0;$i<212;$i++) {
		    imagesetpixel($image,rand(0,$width),rand(0,$height),$pixel_color);
		} 
		 		
		//choose random series of number
		$text = "";
		for($i=0;$i<4;$i++) {
			$text = strval(rand(1,9)).$text;
		} 		
		
		//set the color of text in image
		$text_color = imagecolorallocate($image, 0,0,0);
		$_SESSION['captcha'] = $text; //for use in action pages
		imagettftext($image,25,0,75,25,$text_color,"../css/fonts/BRoya.ttf",$text);
		imagepng($image,"captcha.png");

        echo "captcha.png";
	}