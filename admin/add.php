<?php
  // session_start();
  require '../config/config.php';
  // if(($_SESSION['user_id']) ||($_SESSION['logged_in'] )){
  //   header("Location : index.php"); 
  // }

  if($_POST){
    $title = $_POST['title'];
    $content = $_POST['content'];
    
    $sql = "INSERT INTO posts(title,content) VALUES (:title,:content)";
    $pdostatement = $pdo ->prepare($sql);
    $result = $pdostatement -> execute(
        array(
            ':title' => $title,
            ':content' =>  $content
        )
    );
    if ($result){
        echo "<script>alert('Successfully added!');window.location.href='index.php';</script>";
    }

 }

//   if($_POST){
//     $file ='images/'.($_FILES['image']['name']);
//     $imageType = pathinfo($file .PATHINFO_EXTENSION);
//     if($imageType != 'png' &&  $imageType != 'jpg' && $imageType != 'jpeg'){
//         echo "<script>alert('Image must be png,jpg,jpeg')</script>";
//     }else{
//         $title = $_POST['title'];
//         $content = $_POST['content'];
//         $image = $_FILES['image']['name'];
//         move_uploaded_file($_FILES ['image']['tmp_name'],$file);
//         $stmt = $pdo ->prepare("INSERT INTO posts (title,content,image) VALUES (:title,:content,:image)");
//         $result = $stmt -> execute(
//             array(':title' => $title, ':content' => $content,':image' =>$image )

//         );
//         if($result){
//             echo "<script>alert('Successfully added')</script>";
//         }
//     }
//   }

?>

   <?php include('header.php'); ?>

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
         
          <div class="col-md-12">
            <div class="card">
             <div class="card-body">
             <form class="" action="add.php" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="">Title</label>
                    <input type="text" class="form-control" name="title"  value="" required> 
                </div>
                <div class="form-group">
                    <label for="">Content</label>
                    <textarea name="content"class="form-control" id="" cols="30" rows="10"></textarea>
                </div>
                <div class="form-group">
                    <label for="">Image</label>
                    <input type="file" name="image" value="">
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-success" name="" value="SUBMIT">
                    <a href="index.php" class="btn btn-warning" >Back</a>
                </div>

             </form>
             </div>
            </div>
            <!-- /.card -->
          </div>
        </div>
    
      </div>
    </div>
     
    <?php include('footer.php'); ?>
    
 