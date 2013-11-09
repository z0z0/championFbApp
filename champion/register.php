<?php 
    
    include 'logic/common.php';
     
    if(!empty($_POST)) 
    { 
        if(empty($_POST['username'])) 
        { 
            die("Please enter a username."); 
        } 
         
        if(empty($_POST['password'])) 
        { 
            die("Please enter a password."); 
        }
        


         
        $query = " 
            SELECT 
                1 
            FROM user 
            WHERE 
                username = :username 
        "; 
         
        $query_params = array( 
            ':username' => $_POST['username'] 
        ); 
         
        try 
        { 
            $stmt = $db->prepare($query); 
            $result = $stmt->execute($query_params); 
        } 
        catch(PDOException $ex) 
        { 
            die("Failed to run query: " . $ex->getMessage()); 
        } 
         
        $row = $stmt->fetch(); 
         
        if($row) 
        { 
            die("This username is already in use"); 
        } 
         
  
         
        $query = " 
            INSERT INTO user ( 
			    id_user,
                username,
                password,
                salt
            ) VALUES ( 
			    3,
                :username,
                :password,
                :salt
            ) 
        "; 
         
        $salt = dechex(mt_rand(0, 2147483647)) . dechex(mt_rand(0, 2147483647)); 
        $password = hash('sha256', $_POST['password'] . $salt); 
        for($round = 0; $round < 65536; $round++) 
        { 
            $password = hash('sha256', $password . $salt); 
        } 
        $query_params = array( 
            ':username' => $_POST['username'], 
            ':password' => $password, 
            ':salt' => $salt
        ); 
         
        try 
        { 
            $stmt = $db->prepare($query); 
            $result = $stmt->execute($query_params); 
        } 
        catch(PDOException $ex) 
        { 
            die("Failed to run query: " . $ex->getMessage()); 
        } 
         
        header(''); 
        die("Uspesna registracija"); 
    } 
     
?> 

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        <h1>Register</h1> 
<form action="register.php" method="post"> 
    Korisničko ime:<br /> 
    <input type="text" name="username"  /> 
    <br /><br /> 
    Lozinka:<br /> 
    <input type="password" name="password"  /> 
    <br /><br /> 
    Ponovite lozinku:<br /> 
    <input type="password" name="password_check"  /> 
    <br /><br /> 
    <input type="submit" value="Registracija" /> 
</form>
    </body>
</html>
