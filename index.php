<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login</title>
   
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <link rel="stylesheet" href="style.css">

   
</head>
<body>
   
<div class="container bg-light p-3" style="margin-top: 120px; border-radius: 10px;">
<?php if(isset($_GET['error'])): ?>
   
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>  <?php echo $_GET['error']; ?></strong>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<?php endif; ?>
        <div class="title mb-3">
            <h2>Login</h2>
        </div>
        <form action="./My Gallery/api/gallery.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                
                    <label for="">Email</label>
                    <input type="text" class="form-control" id="email" name="email">
              
            </div>
            <div class="form-group">
                <div >
                    <label for="">Password</label>
                    <input type="text" class="form-control" id="password" name="password">
                </div>
            </div>
            <div class="form-group">
                <div >
                    <button type="submit" name="login" id="login">Login</button>
                </div>
            </div>

            <div class="form-group">
                <p>Don't Have Account?  <a href="./My Gallery/signup/signup.php" style="text-decoration: none;"> Signup</a></p>
            </div>
            <div class="form-group">
                <div class="form-control spans hide">
                    <span id="message">Invalid Input</span>
                    
                </div>
            </div>
        </form>
    </div>

    </div>
    <script src="./My Gallery/js/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
   
    <script src="./My Gallery/js/user-login.js"></script>

    
</body>
</html>