<?php
// General Use
session_start();
include_once('../includes/db_connection.php');
if (!isset($_SESSION['cid']) || (trim($_SESSION['cid']) == '')) {
    header('location:login.php');
    exit();
}

$msg = "";
?>

?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyIntern - Company</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400,400i,700,700i,600,600i">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.min.css">
    <link rel="stylesheet" href="assets/bootstrap/css/custom.css">
</head>

<body>
    <nav class="navbar navbar-light navbar-expand-lg fixed-top bg-white clean-navbar">
        <div class="container"><a class="navbar-brand logo" href="#"><strong>MyIntern</strong></a><button class="navbar-toggler" data-toggle="collapse" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navcol-1">
                <ul class="nav navbar-nav ml-auto">
                    <!-- <li class="nav-item" role="presentation"><a class="nav-link active" href="index.php">Home</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="features.html">info</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="pricing.html">jobs</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="about-us.html">messages</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="contact-us.html">watchlist</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="logout.php">log out</a></li> -->
                    <li class="nav-item" role="presentation"><a class="nav-link" href="index.php">home</a></li>
                    </li>
                    <li class="nav-item" role="presentation"><button class="nav-link mainmenu" id="mainmenu" style="background-color:transparent;border:none;outline:none;cursor:pointer;">info</button></li>
                    <li class="nav-item" role="presentation"><button class="nav-link mainmenu" id="mainmenu" style="background-color:transparent;border:none;outline:none;cursor:pointer;">jobs</button></li>
                    <li class="nav-item" role="presentation"><button class="nav-link mainmenu" id="mainmenu" style="background-color:transparent;border:none;outline:none;cursor:pointer;">messages</button></li>
                    <li class="nav-item" role="presentation"><button class="nav-link mainmenu" id="mainmenu" style="background-color:transparent;border:none;outline:none;cursor:pointer;">watchlist</button></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="logout.php">log out</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <main class="page landing-page">
        <section class="clean-block clean-info dark" id="info_section">
            <div class="container">
                <div class="block-heading">
                    <h2 class="text-info">Info</h2>
                    <p>This is your company information</p>
                </div>
                <div class="row align-items-center">
                    <div class="col-md-6 comp_logo">
                        <label for="image">
                            <?php
                            $currentUser = $_SESSION['email'];
                            $sql = "SELECT * FROM company WHERE email ='$currentUser'";
                            $result = $connection->query($sql);
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo '<img class="img-thumbnail" src="../company/Logo/' . $row["image_name"] . '"/>';
                            ?>
                        </label>
                    </div>
                    <div class="col-md-6">
                        <form action="replyprocess.php" method="post" enctype="multipart/form-data">
                            <div class="getting-started-info text-danger" style="padding:5px;margin-top: 50px;font-weight:bolder;text-align:center;">Click your company logo to change your logo image</div>
                            <input type="file" name="image" id="image" value="<?php echo $row["image_name"]; ?>" style="width: 100%; height: 100%; display:none;">
                            <p style="width:100px;margin-top:10px;">Name:</p><input name="name" type="text" value="<?php echo $row['name']; ?>" style="width:100%;margin-top:-10px;">
                            <p style="width:100px;margin-top:10px;">Email:</p><input name="email" type="text" value="<?php echo $currentUser; ?>" style="width:100%;margin-top:-20px;">
                            <p style="width:100px;margin-top:10px;">Intro:</p><textarea name="about_comp" rows="6" cols="4" style="width:100%;"><?php echo $row['about_comp']; ?></textarea>
                            <p style="width:150px;margin-top:10px;">Corporation Size:</p><input name="corp_size" type="text" value="<?php echo $row['corp_size']; ?>" style="width:100%;margin-top:-10px;">
                            <p style="width:150px;margin-top:10px;">Website Link:</p><input name="comp_website" type="text" value="<?php echo $row['comp_website']; ?>" style="width:100%;margin-top:-10px;;">
                            <p style="width:150px;margin-top:20px;">Address:</p>
                            <p style="width:150px;margin-top:-10px;margin-left:25px;">Address line 1:</p><input name="address1" type="text" value="<?php echo $row['address1']; ?>" style="width:100%;margin-top:-10px;margin-left:25px;">
                            <p style="width:150px;margin-top:10px;margin-left:25px;">Address line 1:</p><input name="address2" type="text" value="<?php echo $row['address2']; ?>" style="width:100%;margin-top:-10px;margin-left:25px;">
                            <p style="width:150px;margin-top:10px;margin-left:25px;">Postcode:</p><input name="postcode" type="text" value="<?php echo $row['postcode']; ?>" style="width:100%;margin-top:-10px;margin-left:25px;">
                            <label for="city" style="width:150px;margin-top:10px;margin-left:25px;">City:</label>
                            <select class="form-control" id="city" name="city" style="width:100%;margin-top:-5px;margin-left:25px;">
                                <option value="George Town" <?php if ($row['city'] == "George Town") {
                                                                echo " selected";
                                                            } ?>>George Town</option>
                                <option value="Kuala Lumpur" <?php if ($row['city'] == "Kuala Lumpur") {
                                                                    echo " selected";
                                                                } ?>>Kuala Lumpur</option>
                                <option value="Ipoh" <?php if ($row['city'] == "Ipoh") {
                                                            echo " selected";
                                                        } ?>>Ipoh</option>
                                <option value="Kuching" <?php if ($row['city'] == "Kuching") {
                                                            echo " selected";
                                                        } ?>>Kuching</option>
                                <option value="Johor Bahru" <?php if ($row['city'] == "Johor Bahru") {
                                                                echo " selected";
                                                            } ?>>Johor Bahru</option>
                                <option value="Kota Kinabalu" <?php if ($row['city'] == "Kota Kinabalu") {
                                                                    echo " selected";
                                                                } ?>>Kota Kinabalu</option>
                                <option value="Shah Alam" <?php if ($row['city'] == "Shah Alam") {
                                                                echo " selected";
                                                            } ?>>Shah Alam</option>
                                <option value="Malacca City" <?php if ($row['city'] == "Malacca City") {
                                                                    echo " selected";
                                                                } ?>>Malacca City</option>
                                <option value="Alor Setar" <?php if ($row['city'] == "Alor Setar") {
                                                                echo " selected";
                                                            } ?>>Alor Setar</option>
                                <option value="Miri" <?php if ($row['city'] == "Miri") {
                                                            echo " selected";
                                                        } ?>>Miri</option>
                                <option value="Petaling Jaya" <?php if ($row['city'] == "Petaling Jaya") {
                                                                    echo " selected";
                                                                } ?>>Petaling Jaya</option>
                                <option value="Kuala Terengganu" <?php if ($row['city'] == "Kuala Terengganu") {
                                                                        echo " selected";
                                                                    } ?>>Kuala Terengganu</option>
                                <option value="Iskandar Puteri" <?php if ($row['city'] == "Iskandar Puteri") {
                                                                    echo " selected";
                                                                } ?>>Iskandar Puteri</option>
                                <option value="Seberang Perai" <?php if ($row['city'] == "Seberang Perai") {
                                                                    echo " selected";
                                                                } ?>>Seberang Perai</option>
                                <option value="Seremban" <?php if ($row['city'] == "Seremban") {
                                                                echo " selected";
                                                            } ?>>Seremban</option>
                                <option value="Subang Jaya" <?php if ($row['city'] == "Subang Jaya") {
                                                                echo " selected";
                                                            } ?>>Subang Jaya</option>
                                <option value="Pasir Gudang" <?php if ($row['city'] == "Pasir Gudang") {
                                                                    echo " selected";
                                                                } ?>>Pasir Gudang</option>
                                <option value="Kuantan" <?php if ($row['city'] == "Kuantan") {
                                                            echo " selected";
                                                        } ?>>Kuantan</option>
                            </select>
                            <label for="state" style="width:150px;margin-top:10px;margin-left:25px;">State:</label>
                            <select class="form-control" id="state" name="state" style="width:100%;margin-top:-5px;margin-left:25px;">
                                <option value="Penang" <?php if ($row['state'] == "Penang") {
                                                            echo " selected";
                                                        } ?>>Penang</option>
                                <option value="Kuala Lumpur" <?php if ($row['state'] == "Kuala Lumpur") {
                                                                    echo " selected";
                                                                } ?>>Kuala Lumpur</option>
                                <option value="Perak" <?php if ($row['state'] == "Perak") {
                                                            echo " selected";
                                                        } ?>>Perak</option>
                                <option value="Sarawak" <?php if ($row['state'] == "Sarawak") {
                                                            echo " selected";
                                                        } ?>>Sarawak</option>
                                <option value="Johor" <?php if ($row['state'] == "Johor") {
                                                            echo " selected";
                                                        } ?>>Johor</option>
                                <option value="Sabah" <?php if ($row['state'] == "Sabah") {
                                                            echo " selected";
                                                        } ?>>Sabah</option>
                                <option value="Selangor" <?php if ($row['state'] == "Selangor") {
                                                                echo " selected";
                                                            } ?>>Selangor</option>
                                <option value="Malacca" <?php if ($row['state'] == "Malacca") {
                                                            echo " selected";
                                                        } ?>>Malacca</option>
                                <option value="Kedah" <?php if ($row['state'] == "Kedah") {
                                                            echo " selected";
                                                        } ?>>Kedah</option>
                                <option value="Terengganu" <?php if ($row['state'] == "Terengganu") {
                                                                echo " selected";
                                                            } ?>>Terengganu</option>
                                <option value="Negeri Sembilan" <?php if ($row['state'] == "Negeri Sembilan") {
                                                                    echo " selected";
                                                                } ?>>Negeri Sembilan</option>
                                <option value="Pahang" <?php if ($row['state'] == "Pahang") {
                                                            echo " selected";
                                                        } ?>>Pahang</option>
                            </select>
                            <button type="submit" name="insert-btn" class="btn btn-primary" style="margin-top:50px;width:100%;">Change</button>
                        </form>
                <?php
                                }
                            }
                ?>
                    </div>
                </div>
            </div>
        </section>
        <section class="clean-block features" id="job_section">
            <div class="container">
                <div class="block-heading">
                    <h2 class="text-info">Jobs</h2>
                    <p>This is list of jobs that your company has posted</p>
                </div>
                <div class="row align-items-center">
                    <div class="col-md-6" style="overflow-y: scroll; height:800px;">
                        <?php
                        $currentUser = $_SESSION['email'];
                        $sql = "SELECT * FROM posts  WHERE email ='$currentUser'";
                        $result = $connection->query($sql);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                        ?>
                                <div class="jobcard" style="font-size: 12px;">
                                    <form action="replyprocess.php" method="post" enctype="multipart/form-data">
                                        <input name="email" class="email" value="<?php echo $row['email'] ?>" hidden>
                                        <input name="id_jobpost" class="id_jobpost" value="<?php echo $row['id_jobpost'] ?>" hidden>
                                        <input name="sid" class="sid" value="<?php echo $row['id'] ?>" hidden>
                                        <input name="appid" class="appid" value="<?php echo $row['id_application'] ?>" hidden>
                                        <input name="msg_title" class="msg_title" value="<?php echo $row['title'] ?>" hidden>
                                        <p>Title: <input type="text" class="title_display" value="<?php echo $row['title']; ?>" readonly /></p><br>
                                        <p>Description: <input type="text" class="des_display" value="<?php echo $row['job_desc']; ?>" readonly /></p><br>
                                        <p>Accommondation: <input type="text" class="acc_display" value="<?php echo $row['accommodation']; ?>" readonly /></p><br>
                                        <p>Allowance: <input type="text" class="allo_display" value="<?php echo $row['allowance']; ?>" readonly /></p><br>
                                        <p>Requirement: <input type="text" class="req_display" value="<?php echo $row['requirement']; ?>" readonly /></p><br>
                                        <p>Location: <input type="text" class="loc_display" value="<?php echo $row['location']; ?>" readonly /></p><br>
                                        <p>Transport & Amenities: <input type="text" class="trans_display" value="<?php echo $row['transport']; ?>" readonly /></p><br>
                                        <button type="button" name="viewThisJob" id="viewThisJob" class="viewThisJob">View</button>
                                        <button type="button" name="deleteMessage-btn" class="deleteMessage">X</button>
                                        <button type="submit" name="deleteMessageConfirm-btn" class="btn btn-danger deleteMessageConfirm">Delete this?</button>
                                    </form>
                                </div>
                        <?php
                            }
                        }
                        ?>
                    </div>
                    <div class="col-md-6">
                        <form action="index.php" method="post" enctype="multipart/form-data">
                            <?php if ($msg != "") echo $msg ?>
                            <?php if ($_SESSION['name'] == null) { ?>
                                <p style="color: red;">Please update your profile!</p>
                            <?php } ?>
                            <p style="width:100px;margin-top:10px;">Title:</p><input type="text" name="title" id="title_job" style="width:100%;margin-top:-10px;" <?= $_SESSION['name'] == null ?  "disabled" :  "" ?> require>
                            <p style="width:100px;margin-top:10px;">Description:</p><textarea name="job_desc" id="job_desc_job" rows="6" cols="4" style="width:100%;" <?= $_SESSION['name'] == null ?  "disabled" :  "" ?> require></textarea>
                            <p style="width:200px;margin-top:10px;">Accommondation:</p>
                            <div class="form-check">
                                <input class="form-check-input" name="accommodation" type="radio" id="accommodation-1" value="yes" <?= $_SESSION['name'] == null ?  "disabled" :  "" ?> require>
                                <label class="form-check-label" for="accommodation-1">Yes</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" name="accommodation" type="radio" id="accommodation-0" value="no" <?= $_SESSION['name'] == null ?  "disabled" :  "" ?> require>
                                <label class="form-check-label" for="accommodation-0">No</label>
                            </div>
                            <p style="width:100px;margin-top:10px;">Allowance:</p>
                            <div class="form-check">
                                <input class="form-check-input" name="allowance" type="radio" id="allowance-1" value="yes" <?= $_SESSION['name'] == null ?  "disabled" :  "" ?> require>
                                <label class="form-check-label" for="allowance-1">Yes</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" name="allowance" type="radio" id="allowance-0" value="no" <?= $_SESSION['name'] == null ?  "disabled" :  "" ?> require>
                                <label class="form-check-label" for="allowance-0">No</label>
                            </div>
                            <p style="margin-top:10px;">Location:</p><input type="text" name="location" id="location_job" style="width:100%;margin-top:-10px;">
                            <p style="margin-top:10px;">Requirement:</p><input type="text" name="requirement" id="requirement_job" style="width:100%;margin-top:-10px;">
                            <p style="margin-top:10px;width:200px;">Transport &amp; Amenities:</p>
                            <div class="form-check">
                                <input class="form-check-input" name="transport" type="radio" id="transport-1" value="yes" <?= $_SESSION['name'] == null ?  "disabled" :  "" ?> require>
                                <label class="form-check-label" for="transport-1">Yes</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" name="transport" type="radio" id="transport-0" value="no" <?= $_SESSION['name'] == null ?  "disabled" :  "" ?> require>
                                <label class="form-check-label" for="transport-0">No</label>
                            </div>
                            <button <?= $_SESSION['name'] == null ?  "disabled" :  "" ?> type="submit" name="upload-btn" class="btn btn-primary" type="button" style="margin-top:50px;width:100%;">Post</button>
                            <div class="getting-started-info"></div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <section class="clean-block slider dark" id="msg_section">
            <div class="container">
                <div class="block-heading">
                    <h2 class="text-info">Messages</h2>
                    <p>This is messages that you have recieved from student and message that you reply to student</p>
                </div>
                <div class="row align-items-center">
                    <div class="col-md-6" style="overflow-y: scroll; height:800px;">
                        <div class="populate_msg">
                            <?php
                            $sql = "SELECT student.id, student.name, application.title, student.email, 
                                    application.id_jobpost, application.status, application.id_application, application.cid
                                    FROM application INNER JOIN student ON student.id=application.userid 
                                    WHERE application.cid=" . $_SESSION['cid'] . "";
                            $title = '';
                            $result = $connection->query($sql);

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    $compileMsg = '';
                                    $compappsql =  "SELECT * FROM application 
                                                    INNER JOIN student ON application.userid=student.id WHERE 
                                                    id_application=" . $row['id_application'] . "";
                                    $compappresult = $connection->query($compappsql);
                                    if ($compappresult->num_rows > 0) {
                                        while ($compapprow = $compappresult->fetch_assoc()) {
                                            $compileMsg .= '<div style="background-color:rgb(200, 240, 255); margin:5px; padding:10px;">
                                            <table class="message" style="font-size:12px;">
                                                <tr>
                                                    <td>
                                                        Dear Mr/Mrs/Ms,<br><br>
                                                            ' . $compapprow['coverletter'] . '<br><br>
                                                        Regards,<br>
                                                        ' . $compapprow['name'] . '
                                                    </td>
                                                </tr>
                                            </table>
                                            </div>';
                                            $compmsgsql =  "SELECT * FROM message  
                                                            INNER JOIN student ON message.userid=student.id WHERE
                                                            id_application=" . $row['id_application'] . "";
                                            $compmsgresult = $connection->query($compmsgsql);
                                            if ($compmsgresult->num_rows > 0) {
                                                while ($compmsgrow = $compmsgresult->fetch_assoc()) {
                                                    if ($compmsgrow['process'] == 0) {
                                                        $compileMsg .= '<div style="background-color:rgb(175, 255, 182); margin:5px; padding:10px;">
                                                        <table class="message" style="font-size:12px;">
                                                            <tr>
                                                                <td>
                                                                    Dear Mr/Mrs/Ms,<br><br>
                                                                        ' . $compmsgrow['msg_details'] . '<br><br>
                                                                    Regards,<br>
                                                                    ' . $_SESSION['name'] . '
                                                                </td>
                                                            </tr>
                                                        </table>
                                                        </div>';
                                                    } else if ($compmsgrow['process'] == 1) {
                                                        $compileMsg .= '<div style="background-color:rgb(200, 240, 255); margin:5px; padding:10px;">
                                                        <table class="message" style="font-size:12px;">
                                                            <tr>
                                                                <td>
                                                                    Dear Mr/Mrs/Ms,<br><br>
                                                                        ' . $compmsgrow['msg_details'] . '<br><br>
                                                                    Regards,<br>
                                                                    ' . $compmsgrow['name'] . '
                                                                </td>
                                                            </tr>
                                                        </table>
                                                        </div>';
                                                    }
                                                }
                                            }
                                        }
                                    }
                                    $status = '';
                                    switch (($row['status'])) {
                                        case 0:
                                            $status = '<div class="pull-right msgstatus"><strong class="msgstatus" style="color:orange">Pending</strong></div>';
                                            break;
                                        case 1:
                                            $status = '<div class="pull-right msgstatus"><strong class="msgstatus" style="color:red">Rejected</strong></div>';
                                            break;
                                        case 2:
                                            $status = '<div class="pull-right msgstatus"><strong style="color:green">Approved</strong></div>';
                                            break;
                                        default:
                                            break;
                                    }

                                    $sqlSeljid = "SELECT id_jobpost FROM posts WHERE id_jobpost='".$row['id_jobpost']."'";
                                    $jidResult = $connection->query($sqlSeljid);
                                    if ($jidResult->num_rows > 0) {
                            ?>
                                        <br>
                                        <div class="message_card">
                                            <input name="email" class="email" value="<?php echo $row['email'] ?>" hidden>
                                            <input name="id_jobpost" class="id_jobpost" value="<?php echo $row['id_jobpost'] ?>" hidden>
                                            <input name="sid" class="sid" value="<?php echo $row['id'] ?>" hidden>
                                            <input name="appid" class="appid" value="<?php echo $row['id_application'] ?>" hidden>
                                            <input name="msg_title" class="msg_title" value="<?php echo $row['title'] ?>" hidden>
                                            <?php echo $status; ?>
                                            <p style="overflow:hidden; font-size:14px" class="title">
                                                <?php echo $row['title'] ?> - <?php echo $row['email'] ?>
                                                <button type="button" name="goToReply-btn" class="goToReply">Reply</button>
                                                <button type="button" name="moreMessage-btn" class="moreMessage">^</button>
                                            </p>
                                            <div class="msg"><?php echo $compileMsg; ?></div>
                                        </div>
                                        <br>
                            <?php
                                    }
                                }
                            }
                            ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <form action="replyprocess.php" method="post" enctype="multipart/form-data">
                            <br>
                            <div class="jobinfo">
                                <p style="width:100px;"><b>Title:</b> </p><input type="text" name="title_reply" class="title_reply" value="" style="border:none;background-color:transparent;width:100%;margin:-20px 0px 10px 0px;" readonly>
                                <p style="width:100px;"><b>Email:</b> </p><input type="text" name="apply_reply" class="apply_reply" value="" style="border:none;background-color:transparent;width:100%;margin:-20px 0px 10px 0px;" readonly>
                                <p style="width:100px;"><b>Status:</b> </p>
                                <div class="status_reply" style="margin:-20px 0px 10px 0px;width:100%;"></div>
                            </div>
                            <br>
                            <input name="id_jobpost_reply" class="id_jobpost_reply" hidden>
                            <input name="sid_reply" class="sid_reply" hidden>
                            <input name="appid_reply" class="appid_reply" hidden>
                            <input name="compid_reply" class="compid_reply" value="<?php echo $_SESSION['cid'] ?>" hidden>
                            <p style="width:100px;">From:</p><input type="text" name="comp_email_reply" class="comp_email_reply" value="<?php echo $_SESSION['email'] ?>" style="width:100%;">
                            <p style="width:100px;margin-top:10px;">To:</p><input type="text" name="email_reply" class="email_reply" style="width:100%;">
                            <p style="margin-top:10px;">Reply:</p><textarea name="msg_reply" class="msg_reply" style="width:100%;height:150px;"></textarea>
                            <button class="btn" type="submit" name="approved-btn" id="approved-btn" style="width:45%;margin-top:10px;background-color:rgb(99,255,99);color:rgb(0,0,0);">Approve</button>
                            <button class="btn" type="submit" name="reject-btn" id="reject-btn" style="width:45%;margin-top:10px;margin-left:10px;float:right;background-color:rgb(255,80,80);color:rgb(0,0,0);">Reject</button>
                            <button class="btn btn-primary" name="send-btn" id="send-btn" type="submit" style="margin-top:25px;width:100%;">Send</button>
                            <div class="getting-started-info"></div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <section class="clean-block about-us" id="wthlist_section">
            <div class="container">
                <div class="block-heading">
                    <h2 class="text-info">Watchlist</h2>
                    <p>This is student that has been under your company watchlist</p>
                    <div class="search_student">
                        <p>
                            <label for="discipline" style="width:150px;">Discipline:</label>
                            <select class="form-control" id="discipline" style="width:150px;">
                                <option value="any">Any</option>
                                <?php
                                $coursesql = "SELECT * FROM courses";
                                $courseresult = $connection->query($coursesql);
                                if ($courseresult->num_rows > 0) {
                                    while ($courserow = $courseresult->fetch_assoc()) {
                                        echo "<option value='" . $courserow['course_name'] . "' data-id='" . $courserow['id_course'] . "'>" . $courserow['course_name'] . "</option>";
                                    }
                                }
                                ?>
                            </select>
                        </p>
                        <p>
                            <label for="duration" style="width:150px;">Duration:</label>
                            <select class="form-control" id="duration" name="duration" style="width:150px;">
                                <option value="any">Any</option>
                                <option value="3">3 months</option>
                                <option value="4">4 months</option>
                                <option value="5">5 months</option>
                                <option value="6">6 months</option>
                                <option value="7">7 months</option>
                                <option value="8">8 months</option>
                                <option value="9">9 months</option>
                            </select>
                        </p>
                        <p>
                            <label for="start" style="width:150px;">Start:</label>
                            <select class="form-control" id="start" name="start" style="width:150px;">
                                <option value="any">Any</option>
                                <option value="January">January</option>
                                <option value="February">February</option>
                                <option value="March">March</option>
                                <option value="April">April</option>
                                <option value="May">May</option>
                                <option value="June">June</option>
                                <option value="July">July</option>
                                <option value="August">August</option>
                                <option value="September">September</option>
                                <option value="October">October</option>
                                <option value="November">November</option>
                                <option value="December">December</option>
                            </select>
                        </p>
                        <P>
                            <button class="btn btn-primary" id="search-btn" style="margin-top:75px;margin-left:10px;"><i>Search</i></button>
                            <button class="btn btn-danger" id="clear-btn" style="margin-top:75px;margin-left:10px;"><i>Clear</i></button>
                        </P>
                        <p>
                        <h5 class="result_stud" style="margin-top: 20px;"></h5>
                        </p>
                    </div>
                </div>
                <div class="row justify-content-center student_temp_list" style="margin-top: -50px;"></div>
                <div class="row justify-content-center student_perm_list" style="margin-top: 20px;">
                    <?php
                    $spsql = "SELECT * FROM application INNER JOIN student ON student.id=application.userid 
                            WHERE application.cid=" . $_SESSION['cid'] . "";
                    $spresult = $connection->query($spsql);

                    if ($spresult->num_rows > 0) {
                        while ($sprow = $spresult->fetch_assoc()) {
                            $start = strtotime($sprow['interndate_from']);
                            $end = strtotime($sprow['interndate_to']);
                            $diff = abs($end - $start);
                            $years = floor($diff / (365 * 60 * 60 * 24));
                            $months = floor(($diff - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
                            $days = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));
                    ?>
                            <div class="col-sm-6 col-lg-4 studentCard">
                                <div class="card clean-card text-center">
                                    <img class="card-img-top w-100 d-block" src="../student/uploadfile/<?php echo $sprow["image_name"]; ?>" height="350">
                                    <div class="card-body info">
                                        <input type="number" name="stud_id" value="<?php echo $sprow['id']; ?>" hidden>
                                        <input type="number" name="stud_email" value="<?php echo $sprow['email']; ?>" hidden>
                                        <h4 class="card-title"><?php echo $sprow['name']; ?></h4>
                                        <p class="card-text" style="font-size:12px;"><?php echo $sprow['email']; ?></p>
                                        <p class="card-text" style="margin-top: -10px; font-size:12px;"><?php echo $sprow['university']; ?></p>
                                        <p class="card-text" id="stud_discipline" style="margin-top: -10px; font-size:12px;"><?php echo $sprow['course']; ?></p>
                                        <p class="card-text" style="float:left;"><b>Duration: </b> <span class="stud_duration"><?php echo $months ?></span> Months</p>
                                        <p class="card-text" style="float:left;margin-top:-10px;"><b>Date: </b> <span class="interndate_form"><?php echo $sprow['interndate_from']; ?></span> - <?php echo $sprow['interndate_to']; ?></p>
                                        <p class="card-text" style="float:left;margin-top:-10px;"><b>Resume: </b><a href="../student/resume/<?php echo $sprow['resume_name'] ?>" target="_blank"><?php echo $sprow['resume_name']; ?></a></p>
                                        <p class="card-text" style="float:left;margin-top:-10px;margin-bottom:50px;">
                                            <button type="submit" name="viewProfile-btn" class="btn viewProfile" data-toggle="modal" data-target="#studentModal-<?php echo $sprow['id']; ?>">View Profile</button>
                                        </p>
                                        <div class="modal fade" id="studentModal-<?php echo $sprow['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="studentModal-<?php echo $sprow['id']; ?>" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="studentModal-<?php echo $sprow['id']; ?>"><?php echo $sprow['name']; ?>'s Profile</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                    <div class="modal-body studentModal">
                                                        <p><img src="../student/uploadfile/<?php echo $sprow["image_name"]; ?>" alt="No Image" width="150" height="200"></p>
                                                        <p style="margin-top:10px;float:left;font-weight:bolder;">Name: </p><input type="text" value="<?php echo $sprow['name']; ?>" style="width:100%;margin-top:-10px;outline:none;" disabled />
                                                        <p style="margin-top:10px;float:left;font-weight:bolder;">Email: </p><input type="text" value="<?php echo $sprow['email']; ?>" style="width:100%;margin-top:-10px;outline:none;" disabled />
                                                        <p style="margin-top:10px;float:left;font-weight:bolder;">Contact: </p><input type="text" value="<?php echo $sprow['contact']; ?>" style="width:100%;margin-top:-10px;" disabled />
                                                        <p style="margin-top:10px;float:left;font-weight:bolder;">Address: </p><textarea style="height:70px;width:100%;margin-top:-10px;outline:none;" disabled><?php echo $sprow['address']; ?></textarea>
                                                        <p style="margin-top:10px;float:left;font-weight:bolder;">University: </p><input type="text" value="<?php echo $sprow['university']; ?>" style="width:100%;margin-top:-10px;outline:none;" disabled />
                                                        <p style="margin-top:10px;float:left;font-weight:bolder;">Course: </p><input type="text" value="<?php echo $sprow['course']; ?>" style="width:100%;margin-top:-10px;outline:none;" disabled />
                                                        <p style="margin-top:10px;float:left;font-weight:bolder;">Internship From: </p><input type="text" value="<?php echo $sprow['interndate_from']; ?>" style="width:100%;margin-top:-10px;outline:none;" disabled />
                                                        <p style="margin-top:10px;float:left;font-weight:bolder;">Internship To: </p><input type="text" value="<?php echo $sprow['interndate_to']; ?>" style="width:100%;margin-top:-10px;outline:none;" disabled />
                                                        <p style="margin-top:10px;float:left;font-weight:bolder;">Internship Duration: </p><input type="text" value="<?php echo $months ?> Months" style="width:100%;margin-top:-10px;outline:none;" disabled />
                                                        <p style="margin-top:10px;float:left;font-weight:bolder;">Area of Interest: </p><input type="text" value="<?php echo $sprow['areaofinterest']; ?>" style="width:100%;margin-top:-10px;outline:none;" disabled />
                                                        <p style="margin-top:10px;float:left;font-weight:bolder;">Supervisor Name: </p><input type="text" value="<?php echo $sprow['svname']; ?>" style="width:100%;margin-top:-10px;outline:none;" disabled />
                                                        <p style="margin-top:10px;float:left;font-weight:bolder;">Supervisor Contact: </p><input type="text" value="<?php echo $sprow['svcontact']; ?>" style="width:100%;margin-top:-10px;outline:none;" disabled />
                                                        <div class="getting-started-info"></div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </section>
    </main>
    <footer class="page-footer dark">
        <div class="footer-copyright">
            <p>© 2021 HyTech All Copy Right</p>
        </div>
    </footer>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js" integrity="sha256-T0Vest3yCU7pafRw9r+settMBX6JkKN06dqBnpQ8d30=" crossorigin="anonymous"></script>
    <script src="assets/js/script.min.js"></script>
    <script src="assets/js/custom.js"></script>
</body>

</html>