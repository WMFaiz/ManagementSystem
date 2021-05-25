 <?php 
    $sname = "localhost";
    $uname = "myintern_app";
    $password = "YfNPIU6m4FUY";
    $db_name = "myintern_app";

    $cname = $_POST["cname"];

    $connect = mysqli_connect($sname, $uname, $password, $db_name );
    if ($connect->connect_error) {
        die("Connection failed: " . $connect->connect_error);
    }

    if(!empty($_POST["cname"])){
        $sql = "DELETE FROM posts WHERE id_jobpost=".$cname;
        if($connect->query($sql) === TRUE){
            echo "Job deleted successfully";
        }else {
            echo "Error deleting record: ".$connect->error;
        }
    }
    $connect->close();
?>