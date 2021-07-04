<?php

    include('config/db_connect.php');
    $errors = array("email"=>"empty data", "pizzaName"=>"empty data", "ingrediants"=>"empty data");
    $email = $pizzaName = $ingrediants = "";
    print_r($errors);
    if(isset($_POST['submit']))
    {
        if(empty($_POST['email']))
        {
            $errors['email'] = "Email is Empty";
        }else
        {
            $email = $_POST['email'];
            if(!filter_var($email,FILTER_VALIDATE_EMAIL))
            {
                $errors['email'] = "email entered unsuccessfully";
            }else{
                $errors['email'] = "";
            }
        }
        if(empty($_POST['pizzaName'])){
            $errors['pizzaName'] = "Pizza Name is Empty";
        }
        else{
            $name = $_POST['pizzaName'];
            if(!preg_match('/^[a-zA-z\s]+$/',$name)){
                $errors['pizzaName'] =  "enter valid pizza name";
            }else{
                $errors['pizzaName'] = "";
            }

        }
        if(empty($_POST['ingrediants'])){
            $errors['ingrediants']  = "Ingrediants is Empty";
        }
        else{
            $name = $_POST['ingrediants'];
            $errors['ingrediants'] = "";
        }
    }
    print_r($errors);

    if(!array_filter($errors)){
        $email = mysqli_real_escape_string($conn,$_POST['email']);
        $pizzaName = mysqli_real_escape_string($conn,$_POST['pizzaName']);
        $ingrediants = mysqli_real_escape_string($conn,$_POST['ingrediants']);
        $query = "INSERT INTO pizzas(pizzaName, ingrediants, email) VALUES('$pizzaName','$ingrediants','$email');";
        if(mysqli_query($conn,$query)){
            echo '<script> alert("Data saved successfully");</script>';
            echo "<script> window.location = 'index.php';</script>";
        }else{
            echo "query error:".mysqli_error($conn);
        }
    }
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
    <link  rel="stylesheet" href="styles/add.css">
    <title>Document</title>
</head>
<body>
    <?php include('templates/header.php'); ?>
    <div class="form-text">
        <form action="add.php" class="" method="POST"> 
            <h4 class="text-center">Add a Pizza</h4>
            <label for="" class="label">Your Email:</label><br/>
            <input type="email" name="email" placeholder="john@gmail.com"><br/>
            <label for="" class="label">Pizza Name:</label><br/>
            <input type="text" name="pizzaName" placeholder="John's Special"><br/>
            <label for="" class="label">Ingrediants</label><br/>
            <input type="text" name="ingrediants" placeholder="Comma seperated">
            <div>
                <input type="submit" name="submit" class="p-2 mt-3">
            </div>
        </form>
    </div>
    <?php include('templates/footer.php'); ?>
</body>
</html>