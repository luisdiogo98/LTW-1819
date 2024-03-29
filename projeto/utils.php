<?php 
  
function getExtension() {
  $name = $_FILES["image"]["name"];
  return end((explode(".", $name)));
} 

function imageHandler($id,$path) {
  $ext = getExtension();

  // Generate filenames for original, small and medium files
  $originalFileName = "$path/originals/$id.png";
  $smallFileName = "$path/thumbs_small/$id.png";
  $mediumFileName = "$path/thumbs_medium/$id.png";

  move_uploaded_file($_FILES['image']['tmp_name'], $originalFileName);


  // Crete an image representation of the original image
  imagepng(imagecreatefromstring(file_get_contents($originalFileName)), $originalFileName);
  $original = imagecreatefrompng($originalFileName);


  $width = imagesx($original);     // width of the original image
  $height = imagesy($original);    // height of the original image
  $square = min($width, $height);  // size length of the maximum square

  // Create and save a small square thumbnail
  $small = imagecreatetruecolor(200, 200);
  imagecopyresized($small, $original, 0, 0, ($width>$square)?($width-$square)/2:0, ($height>$square)?($height-$square)/2:0, 200, 200, $square, $square);
  imagepng($small, $smallFileName);

  // Calculate width and height of medium sized image (max width: 400)
  $mediumwidth = $width;
  $mediumheight = $height;
  if ($mediumwidth > 400) {
    $mediumwidth = 400;
    $mediumheight = $mediumheight * ( $mediumwidth / $width );
  }

  // Create and save a medium image
  $medium = imagecreatetruecolor($mediumwidth, $mediumheight);
  imagecopyresized($medium, $original, 0, 0, 0, 0, $mediumwidth, $mediumheight, $width, $height);

  imagepng($medium, $mediumFileName);
}

function trackHandler($id) {

  $fileName = "../tracks/$id.mp3";

  move_uploaded_file($_FILES['track']['tmp_name'], $fileName);
}
?>