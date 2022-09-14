<?php session_start(); if(!isset($_SESSION['id'])){
    header("location: ../../index.php");
    exit();
    }
    include 'header.php'?>
  

<div class="container mt-4 "  >
   <div class="card p-3 " >
   <?php if(isset($_GET['error'])): ?>
   <div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong> <?php echo $_GET['error']?>  </strong>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<?php endif;?>
    <h4 class="card-title">Gallery Uploader</h4>
   <form action="../api/gallery.php" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="">Image Title</label>
            <input type="text" class="form-control" name="title">
        </div>
        <div class="form-group">
            <label for="">Description</label>
            <input type="text" class="form-control" name="description">
        </div>
        <div class="form-group">
            <label for="">Image</label>
            <input type="file" class="form-control" name="image">
        </div>
        <div class="form-group">
           
            <input type="hidden" value="<?php echo $_SESSION['id']?>" class="form-control" name="user_id">
        </div>
        <div class="form-group">
           <button type="submit" class="btn btn-primary" name="upload">Upload</button>
        </div>
    </form>
   </div>
</div>

<?php include 'footer.php'?>