 <?php
    session_start();
    include_once('../includes/db_connection.php');

    if (!isset($_SESSION['cid']) || (trim($_SESSION['cid']) == '')) {
        header('location:login.php');
        exit();
    }


    $msg = "";

    //If user Actually clicked apply button

    // Reply Message
    if (isset($_POST['send-btn'])) {

        $sid = $_POST['sid_reply'];
        $jid = $_POST['id_jobpost_reply'];
        $cid = $_POST['compid_reply'];
        $aid = $_POST['appid_reply'];
        $msg = $_POST['msg_reply'];

        // echo '<script type="text/javascript">';
        // echo 'alert("'.$sid.'\n'.$jid.'\n'.$cid.'\n'.$aid.'\n'.$msg.'");';
        // echo 'window.location.href = "index.php";';
        // echo '</script>';

        $query = "INSERT INTO message(id_application,id_jobpost, cid, userid , msg_details, process) VALUES (".$aid.",'$jid','$cid', '$sid','$msg',0)";
        if ($connection->query($query) === TRUE) {
            echo '<script type="text/javascript">';
            echo 'alert("Succesfully approved!");';
            echo 'window.location.href = "index.php";';
            echo '</script>';
        } else {
            echo '<script type="text/javascript">';
            echo 'alert("Unsuccessfully");';
            echo 'window.location.href = "index.php";';
            echo '</script>';
        }
    }

    // Approve student
    if (isset($_POST['approved-btn'])) {
        $sid = $_POST['sid_reply'];
        $jid = $_POST['id_jobpost_reply'];
        $cid = $_POST['compid_reply'];
        $aid = $_POST['appid_reply'];
        $msg = $_POST['msg_reply'];
        // echo "sid: ".$sid." \n";
        // echo "jid: ".$jid." \n";
        // echo "cid: ".$cid." \n";
        $query = "UPDATE application SET status='2' WHERE userid='" . $sid . "' AND cid='" . $cid . "' AND id_jobpost='" . $jid . "'";
        if ($connection->query($query) === TRUE) {
            echo '<script type="text/javascript">';
            echo 'alert("Succesfully approved!");';
            echo 'window.location.href = "index.php";';
            echo '</script>';
        } else {
            echo '<script type="text/javascript">';
            echo 'alert("Unsuccessfully");';
            echo 'window.location.href = "index.php";';
            echo '</script>';
        }
        echo $msg;
    }

    // Reject Student
    if (isset($_POST['reject-btn'])) {
        $sid = $_POST['sid_reply'];
        $jid = $_POST['id_jobpost_reply'];
        $cid = $_POST['compid_reply'];
        $aid = $_POST['appid_reply'];
        $msg = $_POST['msg_reply'];
        // echo "sid: ".$sid." \n";
        // echo "jid: ".$jid." \n";
        // echo "cid: ".$cid." \n";
        $query = "UPDATE application SET status='1' WHERE userid='" . $sid . "' AND cid='" . $cid . "' AND id_jobpost='" . $jid . "'";
        if ($connection->query($query) === TRUE) {
            echo '<script type="text/javascript">';
            echo 'alert("Succesfully rejected!");';
            echo 'window.location.href = "index.php";';
            echo '</script>';
        } else {
            echo '<script type="text/javascript">';
            echo 'alert("Unsuccessfully");';
            echo 'window.location.href = "index.php";';
            echo '</script>';
        }
        echo $msg;
    }

        //Company Info
        if (isset($_POST['insert-btn'])){ 
            $currentUser = $_SESSION['email'];
            
            $name = $_POST['name'];
            $about_comp = $_POST['about_comp'];
            $corp_size = $_POST['corp_size'];
            $address1 = $_POST['address1'];
            $address2 = $_POST['address2'];
            $postcode = $_POST['postcode'];
            $city = $_POST['city'];
            $state = $_POST['state'];
            $website = $_POST['comp_website'];
            
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
                if($error > 0){
                    die("error while uploading");   
                }else{
                    $permissible_extension = array("png", "jpg", "jpeg", "svg", "jpe");
                    
                    if(in_array($ext, $permissible_extension)){
                        if(move_uploaded_file($_FILES['image']['tmp_name'],$filename)){
                            $sql = "UPDATE company SET 
                                    image_name='$file2', logo='$name',  name='$name', about_comp='$about_comp', corp_size='$corp_size', address1='$address1', 
                                    address2='$address2', postcode='$postcode', city='$city', state='$state', comp_website='$website' WHERE 
                                    email = '$currentUser'";
                            
                            if(mysqli_query($connection, $sql)){
                                $_SESSION["name"] = $name;
                                $msg = "Profile details successfully updated";
                            }else{
                                var_dump(mysqli_error($connection));
                                echo "Insertion failed";
                            }
                        }else{
                            $msg = "File couldn't be uploaded";
                        }
                    }else{
                        $msg = "Unsuccess insert image. Please insert valid format";
                    }
                }
            }else{
                $sql = "UPDATE company SET 
                        name='$name', about_comp='$about_comp', corp_size='$corp_size', address1='$address1', address2='$address2', 
                        postcode='$postcode', city='$city', state='$state', comp_website='$website' WHERE 
                        email = '$currentUser'";
                if(mysqli_query($connection, $sql)){
                    $_SESSION["name"] = $name;
                    $msg = "Profile details successfully updated";
                    echo $msg;
                    header ('location: index.php');
                }else{
                    $msg = "Insertion failed";
                }
            }
        }
        
        //Post Job
        if (isset($_POST['upload-btn'])) {
            $cid = $_SESSION['cid'];
            $email = $_SESSION['email'];
            $comp_name = $_SESSION['name'];
            $title = $_POST['title'];
            $job_desc = $_POST['job_desc'];
            $accommodation = $_POST['accommodation'];
            $allowance = $_POST['allowance'];
            $location = $_POST['location'];
            $requirement = $_POST['requirement'];
            $transport = $_POST['transport'];
            
            if ($cid != null && $email != null && $comp_name != null && $title != null &&
                $job_desc != null && $accommodation != null && $allowance != null && $location != null &&
                $requirement != null && $transport != null) {
    
            $query = "INSERT INTO posts(cid,email,cname,title, job_desc, accommodation,allowance,location,requirement,transport) VALUES (
                    '" . $cid ."','" . $email . "','" . $comp_name . "','" . $title . "','" . $job_desc . "',
                    '" . $accommodation . "','" . $allowance . "','" . $location . "','" . $requirement . "', 
                    '" . $transport . "')";
                    
                if (mysqli_query($connection, $query) or die('Error in updating Database')) 
                {
                    $msg = "Post Jobs successfully added";
                    header("Refresh:0; url=index.php");
                } else {
                    $msg = "Insertion failed";
                }
            } else {   
                header("Refresh:0; url=index.php");
            }
        }

        // Delete Job Post
        if(isset($_POST['deleteMessageConfirm-btn'])){
            $jid = $_POST['id_jobpost'];
            $cid = $_SESSION['cid'];

            // $sqlSelMsg = "SELECT msgcomp_id FROM message WHERE id_application='" . $appid . "' AND id_jobpost='" . $jid . "' AND cid='" . $cid . "' AND userid='" . $sid . "'";
            // $result = $connection->query($sqlSelMsg);
            // if ($result->num_rows > 0) {
            //     while ($row = $result->fetch_assoc()) {
            //         $sqlDelMsg = "DELETE FROM message WHERE msgcomp_id='" . $row['msgcomp_id'] . "'";
            //         $connection->query($sqlDelMsg);
            //     }
            // }

            // $sqlDelApp = "DELETE FROM application WHERE id_application='" . $appid . "' AND id_jobpost='" . $jid . "' AND cid='" . $cid . "' AND userid='" . $sid . "'";
            // $connection->query($sqlDelApp);

            $sqlDelPos = "DELETE FROM posts WHERE id_jobpost='" . $jid . "'";
            $connection->query($sqlDelPos);

            header("Refresh:0; url=index.php");
        }

    ?>