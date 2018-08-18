<?php
    /*
    MIT License

    Copyright (c) 2018 SCM

    Permission is hereby granted, free of charge, to any person obtaining a copy
    of this software and associated documentation files (the "Software"), to deal
    in the Software without restriction, including without limitation the rights
    to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
    copies of the Software, and to permit persons to whom the Software is
    furnished to do so, subject to the following conditions:

    The above copyright notice and this permission notice shall be included in all
    copies or substantial portions of the Software.

    THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
    IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
    FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
    AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
    LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
    OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
    SOFTWARE.
    */
    function img_resize($files,$maxDim,$path_destination){
        // $maxDim = 800;
        $tmp_name   = $files['tmp_name'];
        $info     = getimagesize($tmp_name);
        $mime     = $info['mime'];
        
        switch ($mime) {
            case 'image/jpeg':
                $image_create_func  = 'imagecreatefromjpeg';
                $image_create     = 'imagecreatetruecolor';
                $image_save_func  = 'imagejpeg';
                $new_image_ext    = 'jpg';
                break;

            case 'image/png':
                $image_create_func  = 'imagecreatefrompng';
                $image_create     = 'imagecreate';
                $image_save_func  = 'imagepng';
                $new_image_ext    = 'png';
                break;

            case 'image/gif':
                $image_create_func  = 'imagecreatefromgif';
                $image_create     = 'imagecreate';
                $image_save_func  = 'imagegif';
                $new_image_ext    = 'gif';
                break;

            default: 
              throw new Exception('Unknown image type.');
        }
        
        list($width, $height)   = $info;
        
        if ( $width > $maxDim || $height > $maxDim ) {
            $ratio        = $width/$height;
            
            if( $ratio > 1) {
                $new_width    = $maxDim;
                $new_height   = $maxDim/$ratio;
            
            } else {
                $new_width    = $maxDim*$ratio;
                $new_height   = $maxDim;
            
            }

            $src        = $image_create_func( $tmp_name );
            $dst        = $image_create( $new_width, $new_height );
            imagecopyresampled( $dst, $src, 0, 0, 0, 0, $new_width, $new_height, $width, $height );
            imagedestroy( $src );
            $image_save_func( $dst, $tmp_name );
            imagedestroy( $dst );
        }

        $name = $files['name'];
        $rawBaseName = pathinfo( $name, PATHINFO_FILENAME );
        $original_name = $rawBaseName;
        $extension = pathinfo( $name, PATHINFO_EXTENSION );

        $i = 1;
        while( file_exists($path_destination.$rawBaseName.".".$extension ))
        {           
            $rawBaseName = ( string )$original_name.$i;
            $name = $rawBaseName.".".$extension;
            $i++;
        }
              
        if ( move_uploaded_file( $tmp_name , $path_destination. $name ) ) {
            return $name;
        }else{
            return 'error';
        }

    }
?>
