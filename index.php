<?php 
 session_start(); 
 error_reporting(-1);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <title>QC</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</head>
<body class="container">
        <br><br>
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <div class="card bg-dark text-light">
                    <div class = "card-header">
                        <p class="h3"> <strong> Query Generator </strong> </p>
                    </div>
                                      
                    <div class="card-body">
                    <form method="POST">  
                            <div class="row">
                                <div class = "col-md-6">
                                    <label> Host Name </label>
                                </div>
                                <div class="col-md-6">
                                    <input class="form-control" name = "host_name" id="host_name">
                                </div>
                            </div><br>
                            <div class="row">
                                <div class = "col-md-6">
                                    <label> User Name </label>
                                </div>
                                <div class="col-md-6">
                                    <input class="form-control" name = "user_name" id="host_name">
                                </div>
                            </div><br>
                            <div class="row">
                                <div class = "col-md-6">
                                    <label> Password </label>
                                </div>
                                <div class="col-md-6">
                                    <input class="form-control" name = "password" id="host_name">
                                </div>
                            </div><br>
                            <div class="row">
                                <div class = "col-md-6">
                                    <label> Database </label>
                                </div>
                                <div class="col-md-6">
                                    <input class="form-control" name = "database" id="host_name">
                                </div>
                            </div><br>
                    </div>
                    <div class="card-footer">
                        <div class="row col-md-12" align="center">
                            <input type="submit" name = "submit" value ="Submit" class="btn btn-primary"/>
                        </div>
                    </div>
                    </form>
                </div>
            <div class="col-md-2"></div>
        </div>
</body>
</html>
<?php 
if(isset($_POST['submit']))
{
    echo "<script> alert('Test'); </script>";
    try 
    {
        $_SESSION['host_name'] = $hnmae = $_POST['host_name'];
        $_SESSION['user_name'] = $uname = $_POST['user_name'];
        $_SESSION['password'] = $password = $_POST['password'];
        $_SESSION['database'] = $database = $_POST['database'];
       
       if((isset($_SESSION['host_name'])) && (isset($_SESSION['user_name'])) && (isset($_SESSION['password'])) && (isset($_SESSION['database'])) )
       {
            echo "<script> window.location.href = 'tables.php'; </script>";
       }
    } 
    catch (\Throwable $th)
    {
       echo "<pre>";
       print_r($th);
       echo "</pre>";
    }
}
?>