<?php
  
include_once ('../includes/db_connection.php');

$currentUser = $_GET['email'];
$token = $_GET['token'];

$msg = "";
    
if (isset($_POST['insert-btn']))
    { 
        $currentUser = $_POST['email'];
        $name = $_POST['name'];
        $about_comp = $_POST['about_comp'];
        $corp_size = $_POST['corp_size'];
        $location = $_POST['location'];
        
        $folder_dir2 = "../company/Logo/";
        $base2 = basename($_FILES['image']['name']);
        $imageFileType = pathinfo($base2, PATHINFO_EXTENSION);
        $file2 = uniqid() . "." . $imageFileType;
        $filename = $folder_dir2 .$file2;  
        
        $error=$_FILES["image"]["error"];


 
        $error=$_FILES["image"]["name"];


 
        $error=$_FILES["image"]["type"];



        $error=$_FILES["image"]["tmp_name"];


        $ext = strtolower(pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION));
        
       
        if(is_uploaded_file($_FILES['image']['tmp_name']))
        {
            
    	
        	if($error > 0)
        	{
                die("error while uploading");   
            }
            else
            {
                $permissible_extension = array("png", "jpg", "jpeg", "svg", "jpe");
                
                if(in_array($ext, $permissible_extension))
                {
                    if(move_uploaded_file($_FILES['image']['tmp_name'],$filename))
                    {
                        
                        $sql = "UPDATE company SET image_name='$file2', logo='$name',  name='$name', about_comp='$about_comp', corp_size='$corp_size', location='$location',  email_confirmed=1, token='' WHERE email = '$currentUser'";
                        
                        if(mysqli_query($connection, $sql))
                        {
                           header ('location: confirm.php');
                          
                        }
                        else
                        {
                          
                            echo "Insertion failed";
                        }
                    }
                    else
                    {
                        $msg = "File couldn't be uploaded";
                    }
                }
                else
                {
                    $msg = "Unsuccess insert image. Please insert valid format";
                }
            }
        }
         else
        {
            $sql = "UPDATE company SET name='$name', about_comp='$about_comp', corp_size='$corp_size', location='$location',  email_confirmed=1, token='' WHERE email = '$currentUser'";
                    	
                if(mysqli_query($connection, $sql))
                {
                    
                     header ('location: confirm.php');
                }
                else
                {
                    $msg = "Insertion failed";
                }
            

        }
        
    }
    

  ?>
  
 <!DOCTYPE html>
<html>
    
<head>
    <title>Company Info</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    
    <?php include 'css/css.php'; ?>


  
</head>

<body>

<div class="desktop-container">

         <div class="jumbotron">
             <img src="/izzati/img/MyIntern.svg" style="display: block; margin-left: auto; margin-right: auto; margin-top: 80px; width: 10%; padding-bottom: 10px">
         </div>



    
                    <div class="background-content" style="text-align:center;">
        
        <!--<div class="container" style="text-align:center;">-->
            
           
                
            
                               <img src="../company/Logo/'.$row["image_name"].'" style="float:center ;border-radius: 10px; border:1px solid grey; height:90px; margin-right:42%; margin-bottom:10px;" />
                            
                
                
                <br>
                
        <form class="form-horizontal" action="verify.php" method="post" enctype="multipart/form-data">  
                <div class="form-group" style="margin:0">
                        <label class="control-label col-xs-3" style="padding-top:30px; text-align:left">Logo </label>
                        <input type="file" name="image" id="image" >  
                    </div>

                    <div class="form-group" style="margin:0">
                        <label class="control-label col-xs-2" style="padding-top:30px; text-align:left">Company Name </label>
                        <div class="col-xs-5" style="padding: 20px 0px 17px 30px">
                            <input type="text" class="form-control" style="border-radius: 25px;" name="name" value=" ">
                        </div>
                    </div>
                    
                    <div class="form-group" style="margin:0">
                        <label class="control-label col-xs-2" style="padding-top:30px; text-align:left">Email </label>
                        <div class="col-xs-5" style="padding: 20px 0px 17px 30px">
                            <input type="text" class="form-control" style="border-radius: 25px;" name="email" value="<?php echo $currentUser; ?>" readonly>
                        </div>
                    </div>
                    
        
         <div class="form-group" style="margin:0">
                        <label class="control-label col-xs-2" style="padding-top:30px; text-align:left">About Company </label>
                        <div class="col-xs-8" style="padding: 20px 0px 17px 30px">
                            <textarea rows="6" cols="4" class="form-control"  name="about_comp"></textarea>
                        </div>
                    </div>
                    
                    <div class="form-group" style="margin:0">
                        <label class="control-label col-xs-2" style="padding-top:30px; text-align:left">Corporation Size </label>
                        <div class="col-xs-5" style="padding: 20px 0px 17px 30px">
                            <input type="text" class="form-control" style="border-radius: 25px;" name="corp_size" value="">
                        </div>
                    </div>
                    
                    <div class="form-group" style="margin:0">
                        <label class="control-label col-xs-2" style="padding-top:30px; text-align:left">Location </label>
                        <div class="col-xs-5" style="padding: 20px 0px 17px 30px">
                            <input type="text" class="form-control" style="border-radius: 25px;" name="location" value=" ">
                        </div>
                        
                        
                    </div>
                    
                    <br>
                    
                    <center><button type="submit" name="insert-btn" style="border:none"><img src="/izzati/img/submit.svg" style="width:100px;"></center></button>
          
          </form>
           
                
            
          
        <!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<?php include 'js/js.php'; ?>

</body>
</html>