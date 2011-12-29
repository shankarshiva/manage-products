<!-- Body Part Starts Here -->
<?php
  echo $this->Html->script('image_crop/jquery-pack.js');
  echo $this->Html->script('image_crop/jquery.imgareaselect.min.js');
?>


<?php 
$existImagePath = "img/";
$upload_dir = "img/crop_images"; 				// The directory for the images to be saved in
$upload_path = $upload_dir."/";				// The path to where the image will be saved
$thumb_image_prefix = "thumbnail_";			// The prefix name to the thumb image
$random_key = '444444';
$thumb_image_name = $thumb_image_prefix.$random_key;     // New name of the thumbnail image (append the timestamp to the filename)

$large_image_name = 'addBig.jpg';     // New name of the large image (append the timestamp to the filename)

//$max_file = "3"; 							// Maximum file size in MB
//$max_width = "500";							// Max width allowed for the large image

$thumb_width = "100";						// Width of thumbnail image
$thumb_height = "100";						// Height of thumbnail image

$large_image_location = $existImagePath.$large_image_name;
$thumb_image_location = $upload_path.$thumb_image_name.'.jpg';

$current_large_image_width = getWidth($large_image_location);
$current_large_image_height = getHeight($large_image_location);


//You do not need to alter these functions
function resizeThumbnailImage($thumb_image_name, $image, $width, $height, $start_width, $start_height, $scale){
  list($imagewidth, $imageheight, $imageType) = getimagesize($image);
  $imageType = image_type_to_mime_type($imageType);

  $newImageWidth = ceil($width * $scale);
  $newImageHeight = ceil($height * $scale);
  $newImage = imagecreatetruecolor($newImageWidth,$newImageHeight);
  switch($imageType) {
    case "image/gif":
      $source=imagecreatefromgif($image);
      break;
    case "image/pjpeg":
    case "image/jpeg":
    case "image/jpg":
      $source=imagecreatefromjpeg($image);
      break;
    case "image/png":
    case "image/x-png":
      $source=imagecreatefrompng($image);
      break;
  }
  imagecopyresampled($newImage,$source,0,0,$start_width,$start_height,$newImageWidth,$newImageHeight,$width,$height);
  switch($imageType) {
    case "image/gif":
      imagegif($newImage,$thumb_image_name);
      break;
    case "image/pjpeg":
    case "image/jpeg":
    case "image/jpg":
      imagejpeg($newImage,$thumb_image_name,90);
      break;
    case "image/png":
    case "image/x-png":
      imagepng($newImage,$thumb_image_name);
      break;
  }
  chmod($thumb_image_name, 0777);
  return $thumb_image_name;
}


// Fucntions 
//You do not need to alter these functions
function getHeight($image) {
  $size = getimagesize($image);
  $height = $size[1];
  return $height;
}
//You do not need to alter these functions
function getWidth($image) {
  $size = getimagesize($image);
  $width = $size[0];
  return $width;
}


//Create the upload directory with the right permissions if it doesn't exist
/* if(!is_dir($upload_dir)){
  mkdir($upload_dir, 0777);
  chmod($upload_dir, 0777);
} */



if (isset($_POST["upload_thumbnail"])) 
{
  

  //Get the new coordinates to crop the image.
  $x1 = $_POST["x1"];
  $y1 = $_POST["y1"];
  $x2 = $_POST["x2"];
  $y2 = $_POST["y2"];
  $w = $_POST["w"];
  $h = $_POST["h"];
  //Scale the image to the thumb_width set above
  $scale = $thumb_width/$w;
  $cropped = resizeThumbnailImage($thumb_image_location, $large_image_location,$w,$h,$x1,$y1,$scale);
  //Reload the page again to view the thumbnail
}

?>

<script type="text/javascript">
function preview(img, selection) 
{ 
	var scaleX = <?php echo $thumb_width;?> / selection.width; 
	var scaleY = <?php echo $thumb_height;?> / selection.height; 
	
	$('#thumbnail + div > img').css({ 
		width: Math.round(scaleX * <?php echo $current_large_image_width;?>) + 'px', 
		height: Math.round(scaleY * <?php echo $current_large_image_height;?>) + 'px',
		marginLeft: '-' + Math.round(scaleX * selection.x1) + 'px', 
		marginTop: '-' + Math.round(scaleY * selection.y1) + 'px' 
	});
	
	$('#x1').val(selection.x1);
	$('#y1').val(selection.y1);
	$('#x2').val(selection.x2);
	$('#y2').val(selection.y2);
	$('#w').val(selection.width);
	$('#h').val(selection.height);
} 

$(document).ready(function () 
{ 

	$('#save_thumb').click(function() 
	{
		var x1 = $('#x1').val();
		var y1 = $('#y1').val();
		var x2 = $('#x2').val();
		var y2 = $('#y2').val();
		var w = $('#w').val();
		var h = $('#h').val();
		if(x1=="" || y1=="" || x2=="" || y2=="" || w=="" || h=="")
		{
			alert("You must make a selection first");
			return false;
		}
		else
		{
			return true;
		}
	});
}); 

$(window).load(function () 
{
	$('#thumbnail').imgAreaSelect({ aspectRatio: '1:<?php echo $thumb_height/$thumb_width;?>', onSelectChange: preview }); 
});

</script>

<div class="bodyPart" >
  <div align="center">
    <?php 
      echo $this->Html->image($large_image_name, array('alt'=> 'Create Thumbnail', 'border' => '0','style'=>'float: left; margin-right: 10px;', 'id'=>'thumbnail'));
    ?>
		<div style="border:1px #e5e5e5 solid; float:left; position:relative; overflow:hidden; width:<?php echo $thumb_width;?>px; height:<?php echo $thumb_height;?>px;">
			<?php
        echo $this->Html->image($large_image_name, array('alt'=> 'Thumbnail Preview', 'border' => '0','style'=>'position: relative;', 'id'=>'thumbnail'));
      ?>
		</div>
		<br style="clear:both;"/>
		<form name="thumbnail" action="/manage-products/admin/Products/cropImage" method="post">
			<input type="hidden" name="x1" value="" id="x1" />
			<input type="hidden" name="y1" value="" id="y1" />
			<input type="hidden" name="x2" value="" id="x2" />
			<input type="hidden" name="y2" value="" id="y2" />
			<br />
			<strong>Selected Width:</strong> <input type="value" name="w" value="" id="w" size="5" style="width:10%"/>
			<strong>Selected Height:</strong> <input type="value" name="h" value="" id="h" size="5" style="width:10%"/>
			<br />
			<input type="submit" name="upload_thumbnail" value="Crop Image" id="save_thumb" />
		</form>
	</div>

</div>
