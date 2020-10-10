<?php
    require 'upload_helper.php';

    // File upload configuration 
    $targetDir = "uploads/"; 
    $allowTypes = array('jpg','png','jpeg','gif');

    foreach ( changeArrayStructure($_FILES['files']) as $key => $value) {
        // echo '<pre>';
        // print_r($_POST);
        // echo '</pre>';
        echo img_resize($files=$value,$maxDim=$_POST['width'],$path_destination=$targetDir)=='error' ? 'false' : 'true' .' <br>';
    }


    
    // change array structure
    function changeArrayStructure($files) {
        $filesMod = array();
        for ($i=0; $i < count($files['name']) ; $i++) {
            $filesMod[] = array(
                'name' => $files['name'][$i],
                'type' => $files['type'][$i],
                'tmp_name' => $files['tmp_name'][$i],
                'error' => $files['error'][$i],
                'size' => $files['size'][$i],
            );
        }

        return $filesMod;
    }

    header("location:index.php?q=1");