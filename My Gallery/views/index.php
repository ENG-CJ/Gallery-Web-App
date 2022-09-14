<?php

session_start();
include '../config/conn.php';

if(!isset($_SESSION['id'])){
    header("location: ../../index.php");
    exit();
}
 $data=array();

function IsAvailable():bool{
    include '../config/conn.php';
    $Data=false;
    $userID = $_SESSION['id'];

    $sql= "SELECT *from gallery where user_id=? ;";
    $state=mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($state,$sql)){
        echo "<script>alert('Failed')</script>";
        header("location: ../views/index.php");
        die();
    }
    else
    {
        mysqli_stmt_bind_param($state,"i",$userID);
        mysqli_stmt_execute($state);
        $result=mysqli_stmt_get_result($state);

        $rows=mysqli_num_rows($result);
        if($rows>0)
          {
           
            $Data=true;
            DisplayGallery($result);
            
          }
    }

    return $Data;
}

function DisplayGallery($data_row){
   while($row=$data_row->fetch_assoc())
   {
    $GLOBALS['data'][]=$row;
   }
}
include 'header.php';
?>


        <div class="container">
            <div class=" mt-5">
                
               <div class="text-center">
               <h1>Memories From You </h1>
                <p class="lead">This is Only For You</p>
               </div>
               <?php if(IsAvailable()):?>
               
                <div class="container" >
                <div class="grids">
                <?php   foreach($data as $row):?>

                <a href="Edit_Gallery.php?gallery_id=<?php echo $row['id']?>" style="text-decoration: none; color: #2b2b2b;">
                <div class="grid-1">
                    <div class="card" style="width: 18rem;">
                            <img src="../uploads/<?php echo $row['image']?>" height="300px" width="300px" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title" style="font-family: poppins; font-size: 25px; color:darkblue"><?php echo $row['image_title']?></h5>
                                <p class="card-text" style="font-family: sans-serif; font-size : 16px; font-weight:400">
                                
                                <?php $text=$row['descripton'];
                                    $reading_text=substr($text,0,60);
                                    echo $reading_text;
                                
                                ?> <span style="color: gray; font-family:poppins; opacity: 0.3;">ReadMode...</span>.</p>
                              
                                <h6 class="card-text text-secondary"><span>Date Added </span><?php echo $row['Date']?>.</h6>
                              
                    
                            </div>
                           
                            </div>
                    </div>
                </a>
                    <?php endforeach;?>
               
               </div>
                    
                </div>
                <?php endif;?>
                <?php if(!IsAvailable()):?>
                    <div class="text-center">
                    <div class="image">
                    <img src="./nodata.gif" width="190px" height="190px" style="margin-top: 20px;" alt="">
                </div>
                    </div>
                    <?php endif;?>
               
            </div>
        </div>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>
