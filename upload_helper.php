function img_resize($files,$maxDim,$path_destination){
    // $maxDim = 800;
    $tmp_name 	= $files['tmp_name'];
    $info 		= getimagesize($tmp_name);
    $mime 		= $info['mime'];
    
    switch ($mime) {
        case 'image/jpeg':
            $image_create_func 	= 'imagecreatefromjpeg';
            $image_create 		= 'imagecreate';
            $image_save_func 	= 'imagejpeg';
            $new_image_ext 		= 'jpg';
            break;

        case 'image/png':
            $image_create_func 	= 'imagecreatefrompng';
            $image_create 		= 'imagecreate';
            $image_save_func 	= 'imagepng';
            $new_image_ext 		= 'png';
            break;

        case 'image/gif':
            $image_create_func 	= 'imagecreatefromgif';
            $image_create 		= 'imagecreate';
            $image_save_func 	= 'imagegif';
            $new_image_ext 		= 'gif';
            break;

        default: 
        	throw new Exception('Unknown image type.');
    }
    
    list($width, $height) 	= $info;
    
    if ( $width > $maxDim || $height > $maxDim ) {
        $ratio 				= $width/$height;
        
        if( $ratio > 1) {
            $new_width 		= $maxDim;
            $new_height 	= $maxDim/$ratio;
        
        } else {
            $new_width 		= $maxDim*$ratio;
            $new_height 	= $maxDim;
        
        }

        $src 				= $image_create_func( $tmp_name );
        $dst 				= $image_create( $new_width, $new_height );
        imagecopyresampled( $dst, $src, 0, 0, 0, 0, $new_width, $new_height, $width, $height );
        imagedestroy( $src );
        $image_save_func( $dst, $tmp_name );
        imagedestroy( $dst );
    }

    $file_name				= $files['name'];
	$temp 					= explode( ".", $file_name );
	$newfilename 			= current( $temp ).'_'.round(microtime(true)) . '.' . end( $temp );
	
	if ( move_uploaded_file( $tmp_name , $path_destination. $newfilename ) ) {
		return $newfilename;
	}else{
		return 'error';
	};

}
