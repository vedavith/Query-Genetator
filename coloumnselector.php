<?php 
    session_start();
    include 'DatabaseConnector.php';
    try 
    {
        $host =  $_SESSION['host_name'];
        $user_name =  $_SESSION['user_name']; 
        $password =  $_SESSION['password']; 
        $database =  $_SESSION['database']; 

        $dc = new DatabaseConnector($host,$user_name,$password,$database);
        $con = $dc->mysqli_connector();
        // print_r($con);
    } 
    catch (\Throwable $th) 
    {
        print_r($th);
    }
    
    $select_all_coloumns = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA. COLUMNS WHERE TABLE_NAME = '".$_POST['table_name']."' ";
    $result_obj = $con->query($select_all_coloumns);
    $i = 0;
    $option_append = "";
    while($res = mysqli_fetch_array($result_obj))
    {
        $option_append .= "<option value = '".$res[$i]."'>".$res[$i]."</option>";
    }
    echo $option_append;
?>