<?php

session_start();

include '../config/conn.php';


if (isset($_POST['login'])){

    extract($_POST);
    if(empty($email) || empty($password))
    {
       
        echo "<script>alert('All Fields Required')</script>";
        header("location: ../../index.php?error=All Fields Are Required");

        exit();
    }else
    {
        $query = "SELECT *from users where Email='$email' AND Password='$password';";
        $statement = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($statement,$query))
            {
                header("location: ../../index.php?error=Query Failed While Stablishing!");
                exit();
            }
            else
            {
                mysqli_stmt_execute($statement);
                $results=mysqli_stmt_get_result($statement);
                $rows=mysqli_num_rows($results);

                if ($rows>0){

                    $row= $results->fetch_assoc();
                    $_SESSION['id']=$row['id'];
                    $_SESSION['username']=$row['Username'];
                    sleep(2);
                    header("location: ../views/index.php");
                    exit();
                    

                }else
                  {
                    header("location: ../../index.php?error=Incorrect Username or Password");
                    exit();
                  }

            }
    }
   

}

if (isset($_POST['logout'])){
    session_unset();
    session_destroy();
    header("location: ../../index.php");
    exit();
}

if(isset($_POST['upload'])){
    print_r($conn->error);
    extract($_POST);
  
    $title =$_POST['title'];
    $description =$_POST['description'];
    $user_id=$_POST['user_id'];
    $filename= $_FILES['image']['name'];
    $type= $_FILES['image']['type'];
    $size= $_FILES['image']['size'];
    $error= $_FILES['image']['error'];
    $tpm_directory= $_FILES['image']['tmp_name'];
   
    if(empty($title) || empty($description) || empty($filename))
      {
       
        header("location: ../views/gallery.php?error=All Fields Are required");
        exit();
     }
    
     else
    {
       

        // extensions
        $extension= explode(".",$filename);
        $actulaExtension= strtolower(end($extension));

        // arrays extemsios
        $allowed_extensions=array("jpg","png","jpeg","gif");

        if (in_array($actulaExtension,$allowed_extensions)){
            if($size<=5242880){
                    if ($error==0){
                        
                        $file_destination="../uploads/title_".$title.".".$actulaExtension."";
                        $image_name = "title_".$title.".".$actulaExtension."";

                        // 
                        if(file_exists($file_destination)){
                                if(!unlink($file_destination)){
                                    header("location: ../views/gallery.php?error=Error While Unlindking The File from the folder");
                                    exit();
                                }
                                else{
                                    move_uploaded_file($tpm_directory,$file_destination);
                                      $sql_query="CALL addGallery('$image_name','$title','$description','$user_id');";
                                        $result=$conn->query($sql_query);
                                        if($result){
                                            sleep(2);
                                            header("location: ../views/index.php");
                                            exit();
                                        }
                                        else
                                        {
                                            header("location: ../views/gallery.php?error=query_failed");
                                            exit();
                                        }
                                }
                        }else
                        {
                            move_uploaded_file($tpm_directory,$file_destination);
                            $sql_query="CALL addGallery('$image_name','$title','$description','$user_id');";
                            $result=$conn->query($sql_query);
                            if($result){
                                sleep(2);
                                header("location: ../views/index.php");
                                exit();
                            }
                            else
                            {
                                header("location: ../views/gallery.php?error=query_failed");
                                exit();
                            }

                        }
                    }
                    else
                    {
                        header("location: ../views/gallery.php?error=Something Went Wrong While Uplaoding");
                        exit();
                    }
            }else
            {
                header("location: ../views/gallery.php?error=File Size must be 5MB or less");
                exit();
            }
        }else
        {
            header("location: ../views/gallery.php?error=.".$actulaExtension." Extension is Not Allowed");
            exit();
        }

    }
}


if(isset($_POST['edit_gallery'])){

    $_title =$_POST['edit_title'];
    $g_id=$_POST['id'];
    $_description =$_POST['edit_description'];
    $user_id=$_POST['user_id'];
    $filename= $_FILES['edit_image']['name'];
    $type= $_FILES['edit_image']['type'];
    $size= $_FILES['edit_image']['size'];
    $error= $_FILES['edit_image']['error'];
    $tpm_directory= $_FILES['edit_image']['tmp_name'];
   
    if(empty($_title) || empty($_description))
      {
        $_SESSION['error']="";
       
        header("location: ../views/index.php");
        exit();
     }
    
     else
    {
       
        if(empty($filename)){

           
            $sql_query="UPDATE gallery SET image_title='$_title', descripton='$_description' where id='$g_id';";
            $result=$conn->query($sql_query);
            if($result){
                $_SESSION['error']="";
                sleep(2);
                
                header("location: ../views/index.php");
                exit();
            }
            else
            {
                header("location: ../views/Edit_Gallery.php?error=Failed Query");
                exit();
            }

        }
        else
      {
        // extensions
        $extension= explode(".",$filename);
        $actulaExtension= strtolower(end($extension));

        // arrays extemsios
        $allowed_extensions=array("jpg","png","jpeg","gif");

        if (in_array($actulaExtension,$allowed_extensions)){
            if($size<=5242880){
                    if ($error==0){
                        
                        $file_destination="../uploads/title_".$_title.".".$actulaExtension."";
                        $image_name = "title_".$_title.".".$actulaExtension."";

                        // 
                        if(file_exists($file_destination)){
                                if(!unlink($file_destination)){
                                    header("location: ../views/Edit_Gallery.php?error=Error While Unlindking The File from the folder");
                                    exit();
                                }
                                else{
                                    move_uploaded_file($tpm_directory,$file_destination);
                                    $sql_query="UPDATE gallery SET image='$image_name', image_title='$_title', descripton='$_description' where id='$g_id';";
                                    $result=$conn->query($sql_query);
                                    if($result){
                                            sleep(2);
                                            header("location: ../views/index.php");
                                            exit();
                                        }
                                        else
                                        {
                                            header("location: ../views/Edit_Gallery.php?error=query_failed");
                                            exit();
                                        }
                                }
                        }else
                        {
                            move_uploaded_file($tpm_directory,$file_destination);
                            $sql_query="UPDATE gallery SET image='$image_name', image_title='$_title', descripton='$_description' where id='$g_id';";
                            $result=$conn->query($sql_query);
                            if($result){
                                sleep(2);
                                header("location: ../views/index.php");
                                exit();
                            }
                            else
                            {
                                header("location: ../views/Edit_Gallery.php?error=query_failed");
                                exit();
                            }

                        }
                    }
                    else
                    {
                        header("location: ../views/Edit_Gallery.php?error=Something Went Wrong While Uplaoding");
                        exit();
                    }
            }else
            {
                header("location: ../views/Edit_Gallery.php?error=File Size must be 5MB or less");
                exit();
            }
        }else
        {
            $_SESSION['error']="This Extension is Not Allowed";
            header("location: ../views/Edit_Gallery.php?gallery_id=".$g_id);
            exit();
        }

    }
}

}


if (isset($_POST['delete_gallery'])){
    $gallery_id=$_POST['galleryID'];
    $sql = "SELECT *from gallery where id='$gallery_id';";
    $result=$conn->query($sql);

    if($result){
        $row=$result->fetch_assoc();
        $rows=$row['image'];
        $filename = "../uploads/".$rows;

        if(file_exists($filename)){
            if(!unlink($filename)){
               
                header("location: ../views/Edit_Gallery.php?gallery_id=".$gallery_id);
                exit();
            }else
            {
                $sql = "DELETE from gallery where id='$gallery_id';";
                $result=$conn->query($sql);
                if($result){
                        header("location: ../views/index.php");
                        exit();
                }

            }
        }
    }
}


if (isset($_POST['signup'])){
    $username = $_POST['username'];
    $pass = $_POST['password'];
    $email =$_POST['email'];
    
   try{
    if(empty($username) || empty($email) || empty($pass))
    {
       
       
        header("location: ../signup/signup.php?error=Oops! All Fields Are Required");
        exit();
    }else
    {
       try{
        $query = "SELECT *from users WHERE Email='$email';";
        $statement = $conn->query($query);
        if($statement){
            $rows=mysqli_num_rows($statement);
            if($rows>0){
                header("location: ../signup/signup.php?error=$email Already Exist");
               exit();
            }else{
                $query_2 = "CALL add_user('$username','$pass','$email','NoProfile')";
                $statement = $conn->query($query);
        
                if ($statement)
                    {
                        header("location: ../../index.php");
                        exit();
                    }
                    else
                    {
                        
                        header("location: ../signup/signup.php?error=Something Went Wrong! While Stablishing The Query");
                        exit();
                    }
            }
        }
       }
       catch(mysqli_sql_exception $ex){
            echo $ex;
       }
       
       
    }

   }
   catch(mysqli_sql_exception $ex){
        echo $ex;  
   }
}
?>