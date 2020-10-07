<?php  



function compress($source, $destination, $quality) {

    $info = getimagesize($source);

    if ($info['mime'] == 'image/jpeg') 
        $image = imagecreatefromjpeg($source);

    elseif ($info['mime'] == 'image/gif') 
        $image = imagecreatefromgif($source);

    elseif ($info['mime'] == 'image/png') 
        $image = imagecreatefrompng($source);

    imagejpeg($image, $destination, $quality);

    return $destination;
}

/*$source_img = 'http://live.healthsurvey.aliansoftware.net/wp-content/uploads/2020/06/images-1.jpg';
$f = 'src/'.basename($source_img);;
$test = file_get_contents($source_img);
$tr = file_put_contents($f,$test);*/

//$destination_img = 'destination.jpg';
//$source = 'AdobeStock_67766775.jpeg';
//$d = compress($source, $destination_img, 70);


$dir = "Product images/Casting Photo-5-8-20";
$scan = scandir($dir);

$t = '0';
foreach ($scan as $key) {
	

	
	if($t++>1){
	$opendir = 'Product images/Casting Photo-5-8-20/'.$key;
	$open = scandir($opendir);
	$z = '0';
	$i = '0';
	foreach ($open as $key) {
		if($z++>1){
			echo $source = $opendir.'/'.$key;
			$extension_pos = strrpos($source, '.');
			$destination_img = substr($source, 0, $extension_pos) . '_thumb' . substr($source, $extension_pos);
			//$d = compress($source, $destination_img, 70);
			echo '<br>';
		}
	$i++;
	}
}
	
}

