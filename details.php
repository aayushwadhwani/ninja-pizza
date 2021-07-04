<?php
    include('config/db_connect.php');

    if(isset($_POST['delete'])){
        $id_to_delete = mysqli_real_escape_string($conn,$_POST['id_to_delete']);
        // echo $id_to_delete;
        $query = "DELETE FROM pizzas WHERE id=$id_to_delete";
        if(mysqli_query($conn,$query)){
            echo '<script> alert("Details removed successfully"); </script>';
            echo "<script> window.location = 'index.php';</script>";
        }else{
            echo "Query Error: ".mysqli_error($conn);
        }
    }
    if(isset($_GET['id'])){
        $id = mysqli_real_escape_string($conn,$_GET['id']);
        $query = "SELECT * FROM pizzas where id=$id";
        $result = mysqli_query($conn,$query);
        $details = mysqli_fetch_assoc($result);
        mysqli_free_result($result);
        mysqli_close($conn);
        print_r($details);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link  rel="stylesheet" href="styles/header.css">
    <link  rel="stylesheet" href="styles/footer.css">
    <link  rel="stylesheet" href="styles/body.css">

    <title>Document</title>
</head>
<body>
    <?php include('templates/header.php'); ?>
    <?php if($details){?>
        <div class="main-container text-center w-50 mr-auto ml-auto mt-5 border">
            <h1><?php echo $details['pizzaName']; ?></h1>
            <p> <span class="font-weight-bolder"> Created by: </span> <?php echo $details['email']; ?> </p3>
            <p> <span class="font-weight-bolder"> Created At: </span> <?php echo date($details['created_at']); ?> </p3>
            <p class="font-weight-bolder">Ingrediants:</p>
            <p><?php echo $details['ingrediants']; ?></p>

            <form action="details.php" method="POST">
                <input type="hidden" name="id_to_delete" value=<?php echo $details['id'];?> >
                <input type="submit" name="delete" value="delete" class="btn btn-outline-danger ml-auto mr-auto mb-4 mt-3">
            </form>
        </div>
    <?php } else{ ?>
        <div class="main-container text-center w-50 mr-auto ml-auto mt-5 border">
            <h1> OOPS! No SUCH USER FOUND! </h1>
        </div>
    <?php } ?> 
    <?php include('templates/footer.php'); ?>
</body>
</html>