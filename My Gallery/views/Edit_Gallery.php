<?php session_start(); 
if(!isset($_SESSION['id'])){
    header("location: ../../index.php");
    exit();
    }
include 'header.php';
include '../config/conn.php';
$g_id=0;
if(isset($_GET['gallery_id'])){
    $g_id=$_GET['gallery_id'];
}

function DisplayInfo(){
    include '../config/conn.php';
    $data=array();
    $sql="SELECT *from gallery where id='$GLOBALS[g_id]';";
    $result =$conn->query($sql);
    if($result){
        $row=$result->fetch_assoc();

        $data=array("title"=>$row['image_title'],"descr"=>$row['descripton'],"image"=>$row['image']);
    }
    return $data;
    
}
?>
  

<div class="container mt-4 "  >
  <div class="row">
    <div class="col-xl-6 col-sm-12 mt-3">
    <div class="card p-3 " >
    <h4 class="card-title">Gallery Uploader</h4>
   <form action="../api/gallery.php" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="">Image Title</label>
            <input type="text" class="form-control" value="<?php echo DisplayInfo()['title']?>" name="edit_title">
        </div>
        <div class="form-group">
            <label for="">Description</label>
            <input type="text" class="form-control" value="<?php echo DisplayInfo()['descr']?>" name="edit_description">
        </div>
        <div class="form-group">
            <label for="">Image</label>
            <input type="file" class="form-control" name="edit_image">
        </div>
        <div class="form-group">
        <span><?php if (isset($_SESSION['error'])) echo $_SESSION['error']; ?></span>
        </div>
        <div class="form-group">
           
            <input type="hidden" value="<?php echo $g_id ?>" class="form-control" name="id">
            <input type="hidden" value="<?php echo $_SESSION['id'] ?>" class="form-control" name="user_id">
        </div>
        <div class="form-group">
           <button type="submit" class="btn btn-primary" name="edit_gallery">Update</button>
        </div>
    </form>
   </div>
    </div>

    <div class="col-xl-6 col-sm-12 mt-3 ">
    <div class="card viewCard">
                            <img src="../uploads/<?php echo DisplayInfo()['image']?>" height="500px" width="200px" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title" style="font-family: poppins; font-size: 25px; color:darkblue"><?php echo DisplayInfo()['title']?></h5>
                                <p class="card-text" style="font-family: sans-serif; font-size : 16px; font-weight:400">
                                
                               <?php echo DisplayInfo()['descr']?>
                                
                               .</p>
                              
                             <form id="delete_form"  action="../api/gallery.php" method="post" enctype="multipart/form-data">
                           <button type="submit" class="btn btn-danger" id="delete" name="delete_gallery">Delete</button>
                           <input type="hidden" id="id_delete" name="galleryID" value="<?php echo $g_id  ?>">
                             </form>
                              
                    
                            </div>
                           
                            </div>
                    </div>
                   
    </div>
   
  </div>


</div>


<?php include 'footer.php'?>

   