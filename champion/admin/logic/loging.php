<?php 

    require("common.php"); 
    session_start();
     
    $submitted_username = ''; 
     
    if(!empty($_POST)) 
    { 
        $query = " 
            SELECT 
                id_user, 
                username,
                password, 
                salt, 
                last_login
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
         
        $login_ok = false; 
         
        $row = $stmt->fetch(); 
        if($row) 
        { 
            $check_password = hash('sha256', $_POST['password'] . $row['salt']); 
			$id_user = $row['id_user'];
            for($round = 0; $round < 65536; $round++) 
            { 
                $check_password = hash('sha256', $check_password . $row['salt']); 
            } 
             
            if($check_password === $row['password']) { 
			
				 $query = "select * from user_kategorija where id_user = $id_user and id_kategorija = 1";
		
				try { 
					$stmt1 = $db->prepare($query); 
					$stmt1->execute(); 
				
				} catch(PDOException $ex){
				
					die("Failed to run query: " . $ex->getMessage()); 
				} 
				
				$user = $stmt1->fetch(); 
				if($user) {
				
				   $login_ok = true; 
				}
				else {
					$login_ok = false; 
				}
                
            } 
        } 
         
        if($login_ok) 
        { 
            unset($row['salt']); 
            unset($row['password']); 
             
            $_SESSION['username'] = $row['username'];
			$_SESSION['id_user'] = $row['id_user'];
            $_SESSION['errMsg'] = '';
            $_SESSION['lastLogin'] = $row['last_login'];
            $_SESSION['active'] = true;
			
			
            $update = " 
            UPDATE user
            SET last_login = :last_login
            WHERE id_user = :id_user
			"; 
         
        $update_params = array( 
            ':last_login' => date('Y-m-d H:i:s',$_SERVER['REQUEST_TIME']),
            ':id_user' => $row['id_user']
        ); 
         
        try 
        { 
            $stmt = $db->prepare($update); 
            $result = $stmt->execute($update_params); 
        } 
        catch(PDOException $ex) 
        { 
            die("Failed to run query: " . $ex->getMessage()); 
        } 
        
		header("Location: ../dashboard.php"); 
        die("Redirecting to: dashboard.php"); 
		
        } 
        else 
        { 
            echo '<script type="text/javascript">alert("Neispravni podaci!");</script>';
            $_SESSION['errMsg'] = 'Neispravni podaci!';
        header('Location: ../index.php');
            die("Redirecting to: index.php");
            $submitted_username = htmlentities($_POST['username'], ENT_QUOTES, 'UTF-8'); 
        } 
    } 
     
?>