	function img_resize($files,$maxDim,$path_destination){
        // $maxDim = 800;
        $file_name = $files['tmp_name'];
        list($width, $height, $type, $attr) = getimagesize( $file_name );
        if ( $width > $maxDim || $height > $maxDim ) {
            $target_filename = $file_name;
            $ratio = $width/$height;
            if( $ratio > 1) {
                $new_width = $maxDim;
                $new_height = $maxDim/$ratio;
            } else {
                $new_width = $maxDim*$ratio;
                $new_height = $maxDim;
            }
            $src = imagecreatefromstring( file_get_contents( $file_name ) );
            $dst = imagecreatetruecolor( $new_width, $new_height );
            imagecopyresampled( $dst, $src, 0, 0, 0, 0, $new_width, $new_height, $width, $height );
            imagedestroy( $src );
            imagepng( $dst, $target_filename ); // adjust format as needed
            imagedestroy( $dst );
        }
        // return print_r($files);
        // move_uploaded_file($tmp_name, $path_destination.$tmp_name['name']);
        // return move_uploaded_file($files['tmp_name'], $path_destination.$files['name']);
        
	}
