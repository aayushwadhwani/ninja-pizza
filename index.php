<?php
        include('config/db_connect.php');
        //making a query
        $query = "SELECT email, pizzaName, ingrediants,id  from pizzas";

        //execute the query
        $result = mysqli_query($conn, $query);

        //making an associative array
        $answer = mysqli_fetch_all($result,MYSQLI_ASSOC);

        //freeing the result
        mysqli_free_result($result);

        //closing the result
        mysqli_close($conn);
        // print_r($answer);
        // print_r(explode(',', $answer[0]['ingrediants']));
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link  rel="stylesheet" href="styles/header.css">
    <link  rel="stylesheet" href="styles/footer.css">
    <link  rel="stylesheet" href="styles/body.css">

    <title>Document</title>
</head>
<body>
    <?php include('templates/header.php'); ?>
    <div class="main-container text-center bg-light p-4" id="t">
        <div id="home-tiles" class=" row justify-content-around">
        <?php foreach($answer as $ans) { ?>
            <div class="col-4  col-style p-2 border m-3">
                <h3><?php echo $ans['pizzaName']; ?></h3>
                <ul class="list-unstyled p-3 font-weight-bolder">
                    <?php foreach(explode(',' , $ans['ingrediants']) as $ingrediant) { ?>
                    <li class="m-2">
                        <?php echo $ingrediant; ?>
                    </li>
                    <?php } ?> 
                </ul>
                <hr>
                <div class="m-2 text-right">
                    <a href="details.php?id=<?php echo $ans['id']; ?>" class="p-2">More Info</a>
                </div>
            </div>
        <?php } ?>
        </div>
    </div>
    <?php include('templates/footer.php'); ?>
    <a href="" class=""></a>
</body>
</html>