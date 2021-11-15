<?php
include("db.php");
$where = '';
$company_id = $_GET['company_id'] ?? '';
if(!empty($company_id)){
    $where .= " AND c.id = '$company_id'";
}

$sql = "SELECT u.name, u.email, u.phone, GROUP_CONCAT(c.name) AS companies
    FROM users u
    LEFT JOIN allocation a ON u.id = a.user_id
    LEFT JOIN company c ON c.id = a.company_id
    WHERE 1 
    $where
    GROUP BY u.id";
$user_result = mysqli_query($db, $sql);

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
                    <h4>User List
                    <a href="user.php" class="btn btn-primary btn-sm" style="float:right">Add user</a>
                </h4>
                </div>
            </div><br>
            <div class="row" style="overflow:auto;">
                <form>
                    <div class="col-md-3">
                        <select name="company_id" class="form-control">
                            <option value="">- Select Company -</option>
                            <?php
                            while($row = mysqli_fetch_array($company_result)){
                                $selected = $company_id == $row['id'] ? "selected" : '';
                                echo "<option value='$row[id]' $selected>$row[name]</option>";
                            }
                            ?>
                        </select>
                        
                    </div>
                    <div class="col-md-3"><input type="submit" name="submit" class="btn btn-primary" value="Filter"></div>
                </form><br><br>
                <div class="col-md-12">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Allocated Companies</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                while($row = mysqli_fetch_array($user_result)){
                            ?>                            
                            <tr>
                                <td><?=$row['name']?></td>
                                <td><?=$row['email']?></td>
                                <td><?=$row['phone']?></td>
                                <td><?=$row['companies']?></td>
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