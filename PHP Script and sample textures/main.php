<?php

$valid_formats = array("jpg", "png", "gif", "jpeg", "bmp");
$max_file_size = 1024*1024; //1 mb
$path = "Textures/"; // Upload directory
$count = 0;

if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST"){
  // Loop $_FILES to execute all files
  foreach ($_FILES['files']['name'] as $f => $name) {     
      if ($_FILES['files']['error'][$f] == 4) {
          continue; // Skip file if any error found
      }        
      if ($_FILES['files']['error'][$f] == 0) {            
          if ($_FILES['files']['size'][$f] > $max_file_size) {
              $message[] = "$name is too large!.";
              continue; // Skip large files
          }
      elseif( ! in_array(pathinfo($name, PATHINFO_EXTENSION), $valid_formats) ){
        $message[] = "$name is not a valid format";
        continue; // Skip invalid file formats
      }
          else{ // No error found! Move uploaded files 
              if(move_uploaded_file($_FILES["files"]["tmp_name"][$f], $path.$name)) {
                $count++; // Number of successfully uploaded files
              }
          }
      }
  }
}
?>
<html lang="en" class="no-js">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> 
    <meta name="viewport" content="width=device-width, initial-scale=1"> 
    <title>Download/Upload Textures</title>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link rel="shortcut icon" href="../favicon.ico">
    <link href='http://fonts.googleapis.com/css?family=Raleway:400,800,300' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="css/normalize.css" />
    <link rel="stylesheet" type="text/css" href="css/demo.css" />
    <link rel="stylesheet" type="text/css" href="css/set1.css" />
    <!--[if IE]>
      <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
  </head>
<body>
<header class="codrops-header">
    
    <h1>Online Textures<span>View and Upload new textures</span></h1>
        
</header>

<div class="container text-center">
   <h3>Total Available textures..
<?php
   $files = glob("Textures/*.*");
   echo(count($files));
   echo '</h3><br><div>';
   for($i=0,$j=1; $i<count($files); $i++)
   {
     $images = $files[$i];
     $supported_file = array(
    'gif',
    'jpg',
    'jpeg',
    'png',
    'bmp');
    
$ext = strtolower(pathinfo($images, PATHINFO_EXTENSION));
if (in_array($ext, $supported_file)) {
      if($i%4 == 0)
      {
          echo '</div></div><div class="container-fluid bg-3 text-center" ><div class="row">';
      }
      echo '<div class="col-sm-3"  style="padding-left: 10px;  padding-right: 10px; padding-bottom = 10px ; padding-top = 10px;">';
      if($i%2==0){
      echo '<div class="content"><div class="grid"><figure class="effect-layla"><img src="'.$images.'" class="img-responsive" style="width:100%" alt="images"><figcaption> <h2>Texture <span>'.$j.'</span></h2>
              <p>Click to View.</p>             <a href="'.$images.'">View</a>

              
            </figcaption>     
          </figure></div></div>
            </div>';}
       else
       {
        echo '<div class="content"><div class="grid"><figure class="effect-layla"><img src="'.$images.'" class="img-responsive" style="width:100%" alt="images"><figcaption> <h2>Texture <span>'.$j.'</span></h2>
              <p>Click to View.</p>             <a href="'.$images.'">View</a>

              
            </figcaption>     
          </figure></div></div>
            </div>';
       }
      $j+=1;

} 
else {
      continue;
}


}
  echo '</div></div>';

   ?>

   <div ><center>
       <div class="container text-center"> <h3>Upload textures here..</h3></div> <br><br>
      <form action="" method="post" enctype="multipart/form-data">
      <span class="btn btn-default btn-file">
       Browse<input type="file" id="file" name="files[]" multiple="multiple" accept="image/*" />
      <input type="submit" value="Upload!" />
      </span>
      </form></center>
   </div>
   <script>
      // For Demo purposes only (show hover effect on mobile devices)
      [].slice.call( document.querySelectorAll('a[href="#"') ).forEach( function(el) {
        el.addEventListener( 'click', function(ev) { ev.preventDefault(); } );
      } );
    </script>
</body>

</html>