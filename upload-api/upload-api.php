<?php 
include("resize-class.php");
$fileindex = $_GET['fileindex'];
 
if($fileindex == '1')
{
	$filename = 'uploadfile';
	$uploaddir = '../images/students/';
	$uploaddir_thumb = '../images/students/thumb/';
	$uploaddir_small_thumb = '../images/students/small/';
	$uploadfile = time() . '..........' . $_FILES[$filename]['name'];
	
	$image = $_FILES[$filename]['name'];
    $image_type = $_FILES[$filename]['type'];
	
	if($image != "")
    {
        $w_h = getimagesize($_FILES[$filename]['tmp_name']);
        $o_width = $w_h[0];
        $o_height = $w_h[1];
        
        $thumbs_width = 220;
        $thumbs_height = $o_height*($thumbs_width/$o_width);
        
        $small_width = 60;
        $small_height = $o_height*($small_width/$o_width);  
        
        if(move_uploaded_file($_FILES[$filename]['tmp_name'], $uploaddir.$uploadfile)) 
        { 
            $resizeObj = new resize($uploaddir.$uploadfile);
            $resizeObj -> resizeImage($thumbs_width, $thumbs_height, 'crop');
            $resizeObj -> saveImage($uploaddir_thumb.$uploadfile, 100);
            
            $resizeObj = new resize($uploaddir_thumb.$uploadfile);
            $resizeObj -> resizeImage($small_width, $small_height, 'crop');
            $resizeObj -> saveImage($uploaddir_small_thumb.$uploadfile, 100);
            
            if($o_width>360)
            {
               $large_width = 360; 
               $large_height = $o_height*($large_width/$o_width); 
               
               $resizeObj = new resize($uploaddir.$uploadfile);
               $resizeObj -> resizeImage($large_width, $large_height, 'crop');
               $resizeObj -> saveImage($uploaddir.$uploadfile, 100);
            }
            echo basename($uploadfile);
        } 
    }
    else 
    {
        echo "error";
    }
}
else if($fileindex == '2')
{
    $filename = 'uploadfile';
    $uploaddir = '../images/logo/';
    $uploaddir_thumb = '../images/logo/thumb/';
    $uploaddir_small_thumb = '../images/logo/small/';
    $uploadfile = time() . '..........' . $_FILES[$filename]['name'];
    
    $image = $_FILES[$filename]['name'];
    $image_type = $_FILES[$filename]['type'];
    
    if($image != "")
    {
        $w_h = getimagesize($_FILES[$filename]['tmp_name']);
        $o_width = $w_h[0];
        $o_height = $w_h[1];
        
        $thumbs_width = 136;
        $thumbs_height = $o_height*($thumbs_width/$o_width);
        
        $small_width = 60;
        $small_height = $o_height*($small_width/$o_width);  
        
        if(move_uploaded_file($_FILES[$filename]['tmp_name'], $uploaddir.$uploadfile)) 
        { 
            $resizeObj = new resize($uploaddir.$uploadfile);
            $resizeObj -> resizeImage($thumbs_width, $thumbs_height, 'crop');
            $resizeObj -> saveImage($uploaddir_thumb.$uploadfile, 100);
            
            $resizeObj = new resize($uploaddir_thumb.$uploadfile);
            $resizeObj -> resizeImage($small_width, $small_height, 'crop');
            $resizeObj -> saveImage($uploaddir_small_thumb.$uploadfile, 100);
            
            if($o_width>360)
            {
               $large_width = 360; 
               $large_height = $o_height*($large_width/$o_width); 
               
               $resizeObj = new resize($uploaddir.$uploadfile);
               $resizeObj -> resizeImage($large_width, $large_height, 'crop');
               $resizeObj -> saveImage($uploaddir.$uploadfile, 100);
            }
            echo basename($uploadfile);
        } 
    }
    else 
    {
        echo "error";
    }
    
}
/*
$file = $uploaddir . basename($_FILES[$filename]['name']); 
 
if (move_uploaded_file($_FILES[$filename]['tmp_name'], $file)) 
{ 
  //echo "success"; 
  echo basename($_FILES[$filename]['name']);
} 
else 
{
    echo "error";
}
*/
?>