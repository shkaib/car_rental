<?php
class Thumbnailer {
	private $image = ''; //image filename and path 
	private $sizes = null;
	public function __construct($image = false){
		if($image){
			 $this->setImage($image);			
		}
	}
 
	public function setImage($image){
		if (is_file($image) && ($this->sizes = getimagesize($image))) $this->image = $image;
	}
 
	/*  createThumb creates and saves a thumbnail 
	*	requires an $outputPath including filename to save thumbnail  file to;	
	*	specifications = array(maxLength=>100,width=>100,height=100,mime=>'image/jpeg')
	*/
	public function createThumb(Array $specifications,$outputPath){		
		if (!strlen($this->image)) return;
		$sizes = $this->sizes; 
		$originalImage = $this->loadImage($this->image, $sizes['mime']);
		$newWidth = 0; 
		$newHeight = 0; 
 
		if (isset($specifications['width']) && !isset($specifications['height'])){
			$newWidth = $specifications['width'];
			$newHeight = $sizes[1]*($newWidth/$sizes[0]); 
		}elseif(isset($specifications['height']) && !isset($specifications['width'])){
			$newHeight = $specifications['height'];			
			$newWidth = $sizes[0]*($newHeight/$sizes[1]);
		}elseif(isset($specifications['height']) && isset($specifications['width'])){
			$newWidth = $specifications['width'];
			$newHeight = $specifications['height'];			
		}elseif(isset($specifications['maxLength'])){
 
 
 			
				
			if ($sizes[0] >= $sizes[1]){
				$newWidth = $specifications['maxLength'];
				$newHeight = $sizes[1]*($newWidth/$sizes[0]); 
			}else{
				$newHeight = $specifications['maxLength'];
				$newWidth = $sizes[0]*($newHeight/$sizes[1]);
			}
		}else{
			$newWidth = $sizes[0];
			$newHeight = $sizes[1];	
		}
 
		$im = @imagecreatetruecolor($newWidth,$newHeight);
		imagecopyresampled($im,$originalImage,0,0,0,0,$newWidth,$newHeight,$sizes[0],$sizes[1]);
 
		$type = !isset($specifications['mime']) ? $sizes['mime'] : $specifications['mime'];
		$this->saveImage($im,$outputPath,$type);
 
		// Free up memory		
		imagedestroy($im);
		imagedestroy($originalImage);
	}
 
	private function saveImage($image, $imgname, $type) 
	{
		switch ($type) {
			case 'image/gif' :
				$im = imagegif($image,$imgname);
			break;
			case 'image/jpeg':
				$im = imagejpeg($image,$imgname,100);
			break; 
			case 'image/png':
				$im = imagepng($image,$imgname,9);
		}
		return $im; 
	}
 
	private function loadImage($imgname, $type) 
	{
		switch ($type) {
			case 'image/gif' :
				$im = $this->LoadGif($imgname);
			break;
			case 'image/jpeg':
				$im = $this->LoadJpeg($imgname);
			break; 
			case 'image/png':
				$im = $this->LoadPNG($imgname);
		}
		return $im; 
	}
 
	private function imageerror()
	{
     $im  = imagecreatetruecolor(150, 30); /* Create a black image */
     $bgc = imagecolorallocate($im, 255, 255, 255);
     $tc  = imagecolorallocate($im, 0, 0, 0);
     imagefilledrectangle($im, 0, 0, 150, 30, $bgc);
     /* Output an errmsg */
     imagestring($im, 1, 5, 5, "Error loading $imgname", $tc);
     return $im; 
	}
 
	private function LoadJpeg($imgname)
	{
	   $im =@imagecreatefromjpeg($imgname); /* Attempt to open */
	   if (!$im) { /* See if it failed */
		 	$im = $this->imageerror(); 
	   }
	   return $im;
	}
 
	private function LoadGif ($imgname)
	{
	   $im = @imagecreatefromgif ($imgname); /* Attempt to open */
	   if (!$im) { /* See if it failed */
		 	$im = $this->imageerror(); 
	   }
	   return $im;
	}
 
	private function LoadPNG($imgname)
	{
	   $im = @imagecreatefrompng($imgname); /* Attempt to open */
	   if (!$im) { /* See if it failed */
			 	$im = $this->imageerror(); 	 	
		 }
	  return $im;
	}
}
?>