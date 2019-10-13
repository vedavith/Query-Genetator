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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Select Tables</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</head>
<body>
    <br><br><br>
    <form method="POST">
    <main class="container">
        <div class="card bg-dark text-light row">
            <div class="card-body row">
                <div class="col-md-6" align="right">
                    <label> Select Tables </label>
                </div>
                <div class="col-md-4"> 
                    <select class="form-control tables" name="tables">
                        <option> Select Tables </option>
            <?php 
                $query = "SHOW TABLES;";
                $execute_query = $con->query($query);
                $i = 0;
                while($res = mysqli_fetch_array($execute_query))
                {
            ?>
                <option value = "<?php echo $res[$i]; ?>"> <?php echo $res[$i] ?> </option>
            <?php
                }
            ?>
                    </select>
                </div>
            </div><br>
            <div class="card-body row">
                <div class="col-md-5">
                    <select class="form-control col_selector" name = "col_selector[]" multiple>
                        <option> Select Table </option>
                    </select>
                </div>
                <div class="col-md-2" align="center">
                <div class="row col-md-12" align="center">
                        <input type="button" name = "select" value=" =>>" class="btn btn-sm btn-primary option_select">
                    </div><br>
                    <div class="row col-md-12" align="center">
                        <input type="button" name = "insert" value="Insert" class="btn btn-sm btn-primary insert">
                    </div><br>
                    <div class="row col-md-12" align="center">
                        <input type="button" name = "update" value="Update" class="btn btn-sm btn-primary update">
                    </div>
                </div>
                <div class="col-md-5">
                    <textarea name="selector_fields"  cols="30" rows="4" class="form-control selector_fields" readonly></textarea>
                </div>
            </div><br>
        </div>
    </main>
    </form>
</body>
<script>
$(document).ready(function(){
  
    $('.tables').change(function(e){
        var tables = $(this).val();
        $.ajax({
            url : 'coloumnselector.php',
            method : 'POST',
            data : {table_name : tables},
            success : function(data){
                $('.col_selector').find('option').remove().end().append('<option>Select Tables</option>');
                $('.col_selector').html(data);
                $('.selector_fields').val("");
            }
        });
    });

    $('.option_select').click(function(){
        var coloumn_names = [];
        $. each($(".col_selector option:selected"), function(){
        coloumn_names. push($(this).val());
        });
       $('.selector_fields').val(coloumn_names);
    });

    $('.insert').click(function(){ 
    
    var coloumn_names = [];
    var post_values = [];
        $. each($(".col_selector option:selected"), function(){
            coloumn_names. push($(this).val());
            var string = '"$_POST[]"';
            post_values.push(string);
        });

    var get_table = $('.tables').val();
    var get_coloumns = coloumn_names.join();
    var get_post_values = post_values.join();

    var generate_insert = "INSERT INTO "+get_table+"("+get_coloumns+") VALUES("+get_post_values+");";
    $('.selector_fields').val("");
    $('.selector_fields').val(generate_insert); 

    });

    $('.update').click(function(){
        var get_table = $('.tables').val();
        var updater = [];

        $. each($(".col_selector option:selected"), function(){
            var update_coloumn_name = $(this).val();
            var string = '"$_POST[]"';
            var update_setter = update_coloumn_name+"="+string
            updater.push(update_setter);
        });
        
        var update_values = updater.join();
        var generate_update = "UPDATE "+get_table+" SET "+update_values+" WHERE 'your condition'";
        $('.selector_fields').val("");
        $('.selector_fields').val(generate_update); 
    });
});


</script>
</html>
