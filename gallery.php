<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>File Uploads Part 1</title>
</head>
<body>


<?php 

if (isset($_GET['up']) && isset($_GET['fil'])){

 
    $updir = $_GET['up'];
    $Dfile= $_GET['fil'];
  
    if(is_dir($updir)){
        $dir_array = scandir($updir);
        foreach ($dir_array as $file) {
            if($file == $Dfile){
                unlink("$updir/$file");
    
            }

            }
        }
    }
// set upload folder name
$upload_dir = 'uploads';
// Define these errors in an array
$upload_errors = array(
                        UPLOAD_ERR_OK 				=> "No errors.",
                        UPLOAD_ERR_INI_SIZE  		=> "Larger than upload_max_filesize.",
                        UPLOAD_ERR_FORM_SIZE 		=> "Larger than form MAX_FILE_SIZE.",
                        UPLOAD_ERR_PARTIAL 			=> "Partial upload.",
                        UPLOAD_ERR_NO_FILE 			=> "No file.",
                        UPLOAD_ERR_NO_TMP_DIR 		=> "No temporary directory.",
                        UPLOAD_ERR_CANT_WRITE 		=> "Can't write to disk.",
                        UPLOAD_ERR_EXTENSION 		=> "File upload stopped by extension.");

if($_SERVER['REQUEST_METHOD'] == "POST"){

    // what file do we need to move?
    $tmp_file = $_FILES['file_upload']['tmp_name'];

    // set target file name
    // basename gets just the file name
    $target_file = basename($_FILES['file_upload']['name']);

    

    // Now lets move the file
    // move_uploaded_file returns false if something went wrong
    if(move_uploaded_file($tmp_file, $upload_dir . "/" . $target_file)){
        $message = "File uploaded successfully";
    } else {
        $error = $_FILES['file_upload']['error'];
        $message = $upload_errors[$error];
    } // end of if
} // end of if


		// start at current directory
		
        // Program to display current page URL. 
          
        $link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 
                        "https" : "http") . "://" . $_SERVER['HTTP_HOST'] .  
                        $_SERVER['REQUEST_URI']; 
          

		// another approach is to read in contents of directory to an array
		if(is_dir($upload_dir)){
			$dir_array = scandir($upload_dir);
			foreach ($dir_array as $file) {
				// don't display the . and .. directories. Using the strpos() for this.
				if(strpos($file,'.') > 0){
                    echo "<div class ='img'>";
                    echo "<img src='$upload_dir/$file'><br>";
                    echo "<a href='$link?up=" . "$upload_dir" . "&" . "fil=" . "$file"  . "'>" ."Delete</a>";
                    echo '</div><br>';
				}
			}
        }
        else{
            echo 'no dir';
        } // end of if

      


        ?> 








<?php 


?>



	<form action="" method="post" enctype="multipart/form-data">
		<input type="hidden" name="MAX_FILE_SIZE" value="100000000">
		<input type="file" name="file_upload">
		<input type="submit" name="submit" value="Upload">
	</form>
</body>
</html>