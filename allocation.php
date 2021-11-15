<?php
include("db.php");

if(isset($_POST['submit'])){
    $user_id = $_POST['user_id'];
    $company_id = $_POST['company_id'];
    foreach ($company_id as $key => $value) {
        $sql = "INSERT INTO allocation
            SET user_id = '$user_id'
            , company_id = '$value';";
        $result = mysqli_query($db, $sql);
    }
    
    if($result){
        $msg =  "Allocated";
    }else{
        $error =  "Error:".mysqli_error($db);
    }
}

$sql = "SELECT * FROM users";
$user_result = mysqli_query($db, $sql);
$sql = "SELECT * FROM company";
$company_result = mysqli_query($db, $sql);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>SpringCT</title>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    </head>
    <body>
    <?php include("nav.php"); ?>

        <div class="container">
            <?php if(!empty($msg)){?> <div class="alert alert-success"><?=$msg?></div> <?php }?>
            <?php if(!empty($error)){?> <div class="alert alert-danger"><?=$error?></div> <?php }?>
                <div class="col-md-offset-3 col-md-6">
                    <form action="" method="POST" class="row">
                        <div class="form-group">
                            <label>User</label>
                            <select name="user_id" class="form-control" required>
                                <option>- Select -</option>
                                <?php
                                while($row = mysqli_fetch_array($user_result)){
                                    echo "<option value='$row[id]'>$row[name]</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Company</label>
                            <select name="company_id[]" class="form-control" multiple required>
                                <option>- Select -</option>
                                <?php
                                while($row = mysqli_fetch_array($company_result)){
                                    echo "<option value='$row[id]'>$row[name]</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="submit" name="submit" class="btn btn-primary" value="Submit">
                        </div>
                    </form>
            </div>
        </div>


        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    </body>
</html>