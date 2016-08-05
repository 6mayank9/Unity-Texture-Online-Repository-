 <?php
 $files = glob("Textures/*.*");
 $count = count($files);
 $count += 1;
       if (($_FILES["file"]["type"] == "image/png") ) 
        { 
               if ($_FILES["file"]["error"] > 0)
               { 
                  //   echo "Return Code: " . $_FILES["file"]["error"] . ""; 
               } 
               else  
                     { 
                       //  echo "Upload: " . $_FILES["file"]["name"] . ""; 
                       //  echo "Type: " . $_FILES["file"]["type"] . "";
                       //  echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb";
                       //  echo "Temp file: " . $_FILES["file"]["tmp_name"] . "";

                         if (file_exists("Textures/" . $_FILES["file"]["name"]))
                         {
                               //  echo $_FILES["file"]["name"] . " already exists. ";
                         }
                          else
                          {
                 move_uploaded_file($_FILES["file"]["tmp_name"], "Textures/" . $count . ".jpg");
                                  echo $count;
                              // echo "Stored in: " . "Textures/" . $_FILES["file"]["name"];
                           }
                     }
                 }
                  else 
                { 
                     // echo "Invalid file"; 
                } 
?>