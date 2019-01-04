<?php

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(isset($_POST['submit'])){
        $dbName = $_POST['db-name'];
        $servername = $_POST['servername'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        
        //try connecting to the database
        $conn = new mysqli($servername, $username, $password, $dbName);
        if(!$conn->connect_error){
            //connected to database successfully
            
            //create users table
            $sql = "CREATE TABLE users (
                id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                username VARCHAR(50) NOT NULL,
                firstname VARCHAR(50) NOT NULL,
                lastname VARCHAR(50) NOT NULL,
                email VARCHAR(100) NOT NULL,
                mobile VARCHAR(30) NOT NULL,
                password VARCHAR(255) NOT NULL,
                photo_url VARCHAR(255) NOT NULL,
                rank VARCHAR(50) NOT NULL,
                status VARCHAR(50),
                date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
                )";
                
                if($conn->query($sql)==TRUE){
                    echo 'users table created successfully <br>';
                }

                //create posts table
                $sql = "CREATE TABLE posts (
                    id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                    name VARCHAR(50) NOT NULL,
                    votes INT(11) NOT NULL,
                    creator VARCHAR(50) NOT NULL,
                    photo_url VARCHAR(255) NOT NULL,
                    category VARCHAR(30) NOT NULL,
                    description TEXT,
                    hash VARCHAR(255),
                    date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
                    )";
                    
                     if($conn->query($sql)==TRUE){
                        echo 'posts table created successfully <br>';
                    }

                    //create items table
                    $sql = "CREATE TABLE items (
                        id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                        name VARCHAR(50) NOT NULL,
                        votes INT(11) NOT NULL,
                        price VARCHAR(50) NOT NULL,
                        photo_url VARCHAR(255) NOT NULL,
                        creator VARCHAR(50) NOT NULL,
                        category VARCHAR(30) NOT NULL,
                        description TEXT,
                        foreign_key VARCHAR(255),
                        date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
                        )";
                        
                        if($conn->query($sql)==TRUE){
                            echo 'items table created successfully <br>';
                        }

                        //create votes table
                        $sql = "CREATE TABLE votes (
                            id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                            voter VARCHAR(50) NOT NULL,
                            post INT(11) NOT NULL,
                            option VARCHAR(50) NOT NULL,
                            post_hash VARCHAR(255) NOT NULL,
                            votes VARCHAR(50) NOT NULL, 
                            date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
                            )";
                            if($conn->query($sql)==TRUE){
                                echo 'votes table created successfully <br>';
                            }

                            //create suscribers table
                            $sql = "CREATE TABLE subscribers (
                                id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                email VARCHAR(100) NOT NULL, 
                                date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
                                )";
                                if($conn->query($sql)==TRUE){
                                    echo 'subscribers table created successfully <br>';
                                }else{
                                    echo $conn->error;
                                }
                            
        }else{
            die("Failed to connect! ".$conn->connect_error);
        }

    }
} 






?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Install CommeHub</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script src="main.js"></script>
</head>
<body>

<div class="container">
    
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="db-name"><h4 class="text-muted">Database Name</h4></label>
        <input type="text" name="db-name" class="form-control" id="db-name" placeholder="Database to install CommeHub on">
        <br>
        <label for="db-name"><h4 class="text-muted">Server Name</h4></label>
        <input type="text" name="servername" class="form-control" id="db-name" placeholder="Your Server Name here..">
        <br>
        <label for="db-name"><h4 class="text-muted">Username</h4></label>
        <input type="text" name="username" class="form-control" id="db-name" placeholder="Enter your username">
        <br>
        <label for="db-name"><h4 class="text-muted">Password</h4></label>
        <input type="password" name="password" class="form-control" id="db-name" placeholder="Your password">
        <br>
        <input type="submit" value="Proceed" name="submit" class="btn btn-success btn-lg">
    </form>
</div>
    
    
</body>
</html>