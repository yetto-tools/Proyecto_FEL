<?php
require_once "config.php";

$logo="";


if($_SERVER["REQUEST_METHOD"] == "POST"){
    $check = getimagesize($_FILES["logo"]["tmp_name"]);
    if($check !== false){
        $image = $_FILES['logo']['tmp_name'];
        $imgContent = addslashes(file_get_contents($image));        
        
        //Insert image content into database
        $insert = $db->query("INSERT into images (logo) VALUES ('$imgContent')");
        if($insert){
            $ultimo_id = $db->insert_id;

            echo "File uploaded successfully. ". $ultimo_id;

            $result = $db->query("SELECT logo FROM images where id= {$ultimo_id}");
            if ($result->num_rows > 0){
              $img = $result->fetch_assoc();
              
              $logo = $img['logo'];
            }
        }else{
            echo "File upload failed, please try again.";
        } 
    }else{
        echo "Please select an image file to upload.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<?php include("link.php")?>
<body>
  <div class="row">
      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data" class="form">
        <div class="col col-sm-4"><p>Select image to upload:</p></div>
        <div class="col col-sm-4">
          <input type="file" name="logo" class="form-control form-control-sm" required />
        </div>
        <div class="col col-sm-4"><input type="submit" name="submit" class="btn btn-primary" value="UPLOAD"/></div>
      </form>
  </div>
  <?php header("Content-type: image/jpg"); echo $logo; ?>
</body>
</html>