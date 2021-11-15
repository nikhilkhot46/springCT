<?php
include("db.php");

if(isset($_GET['delete'])){
    $id = $_GET["delete"];
    $sql = "DELETE FROM company where id = '$id'";

    $result = mysqli_query($db, $sql);
    if($result){
        $msg = "Company Deleted";
    }else{
        $error = "Error in deleting: ".mysqli_error($db);
    }
}

$sql = "SELECT *
    FROM company";
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
        <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap.min.css">
    </head>
    <body>
    <?php include("nav.php"); ?>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h4>Company List
                    <a href="index.php" class="btn btn-primary btn-sm" style="float:right">Add Cmpany</a>
                </h4>
                </div>
            </div><br>
            <div class="row" style="overflow:auto;">
                <?php if(!empty($msg)){?> <div class="alert alert-success"><?=$msg?></div> <?php }?>
                <?php if(!empty($error)){?> <div class="alert alert-danger"><?=$error?></div> <?php }?>
                <div class="col-md-12">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>City</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                while($row = mysqli_fetch_array($company_result)){
                            ?>                            
                            <tr>
                                <td><?=$row['name']?></td>
                                <td><?=$row['city']?></td>
                                <td>
                                    <a href="?delete=<?=$row['id']?>" onclick="return confirm('Are you sure')"><i class="glyphicon glyphicon-trash"></i></a>
                                </td>
                            </tr>
                            <?php
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#example').DataTable();
            } );
        </script>
    </body>
</html>