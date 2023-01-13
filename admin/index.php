<?php
  // session_start();
  require '../config/config.php';
  // if(($_SESSION['user_id']) ||($_SESSION['logged_in'] )){
  //   header("Location : index.php"); 
  // }

?>

   <?php include('header.php'); ?>

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
         
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Blog Listing</h3>
              </div>
              <?php
               if(!empty($_GET['pageno'])){
                $pageno =$_GET['pageno'];
               }else{
                $pageno =1 ;
               } 
               $numOfrecs =1;
               $offset =1;
               $offset =($pageno - 1)  * $numOfrecs;
          
              if(empty($_POST['search'])){

                $stmt =$pdo ->prepare("SELECT * FROM posts ORDER BY id DESC");
                $stmt ->execute ();
                $rawresult = $stmt -> fetchAll();
                $total_pages = ceil(count($rawresult)/ $numOfrecs); 
 
                $stmt =$pdo ->prepare("SELECT * FROM posts ORDER BY id DESC LIMIT $offset,$numOfrecs");
                $stmt ->execute ();
                $result = $stmt -> fetchAll();

              }else{
                $searchKey = $_POST['search'];

                $stmt =$pdo ->prepare("SELECT * FROM posts WHERE title LIKE '%searchKey%' OREDER BY id DESC");
                print_r($stmt);exit;
                $stmt ->execute ();
                $rawresult = $stmt -> fetchAll();

                $total_pages = ceil(count($rawresult)/ $numOfrecs); 
 
                $stmt =$pdo ->prepare("SELECT * FROM posts WHERE title LIKE '%searchKey%' ORDER BY id DESC  LIMIT $offset,$numOfrecs");
                $stmt ->execute ();
                $result = $stmt -> fetchAll();

              }

              
              ?>
              <!-- /.card-header -->
              <div class="card-body">
                <div>
                  <a href="add.php"  type="button" class="btn btn-success"> New Blog Post</a>
                </div>
                <br>
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Title</th>
                      <th>Content</th>
                      <th style="width: 150px">Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                     if($result){
                      $i =1 ;
                      foreach($result as $value){
                        ?>
                           <tr>
                            <td><?php echo $i++ ?></td>
                            <td><?php echo $value['title'] ?></td>
                            <td>
                              <?php
                               echo substr($value['content'],0,200)
                              ?>
                            </td>
                            <td>
                              <div class="row">
                                <a  type="button" class="btn btn-warning mr-2" href="edit.php?id=<?php echo $value['id'];?>">Edit</a>
                                <a  type="button" class="btn btn-danger" href="delete.php?id=<?php echo $value['id'];?>"
                                 onclick="return confirm('Are you sure want to delete this item')">Delete</a>
                              </div>
                            </td>
                           </tr>
                        <?php
                      }
                     }
                    ?>

                  </tbody>
                </table><br>
                <nav aria-label="Page navigation example" style="float:right">
                <ul class="pagination">
                  <li class="page-item"><a class="page-link" href="?pageno=1">First</a></li>
                  <li class="page-item <?php if($pageno <=1)  { echo 'disabled';}?>">
                    <a class="page-link" href="<?php if($pageno <= 1){echo '#';}else{echo "?pageno-1".($pageno-1);}?>">Prev</a>
                  </li>
                  <li class="page-item"><a class="page-link" href="#"><?php echo $pageno;?></a></li>
                  <li class="page-item  <?php if($pageno >= $total_pages){echo 'disabled';}?>">
                    <a class="page-link" href="<?php if($pageno >= $total_pages) {echo '#';}else{echo "?pageno=" .($pageno+1);}?>">Next</a></li>
                  <li class="page-item"><a class="page-link" href="?pageno=<?php echo $total_pages?>">Last</a></li>
                </ul>
              </nav>
              </div>
              <!-- /.card-body -->
             
            </div>
            <!-- /.card -->
          </div>
        </div>
    
      </div>
    </div>

    <?php include('footer.php'); ?>
    
 