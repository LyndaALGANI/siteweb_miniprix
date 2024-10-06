<?php 

include_once "../session.php";
init_session();

	include "config.php";

	if(!empty($_POST['email']) && !empty($_POST['password'])){
		$email = htmlspecialchars($_POST['email']);
		$password = htmlspecialchars($_POST['password']);
		//$passwordVerify = password_verify($password,$motdepasse);

		$check = $db->prepare('SELECT * FROM users WHERE email = ?');
		$check->execute(array($email));
		$data = $check->fetch();
		$_SESSION['admin_user'] = $data['admin_user'];
		$_SESSION['email'] = $data['email'];
		$_SESSION['nom'] = $data['nom'];
		
		$row = $check->rowCount();
		
        echo $password;
		echo $motdepasse;
		if($row == 1){

			if(filter_var($email, FILTER_VALIDATE_EMAIL)){
				    //(password_verify($_POST['motdepasse'],$motdepasse)){
					if 	($data['password'] === $password){
						if($_SESSION['admin_user']== 1)
						{
						$_SESSION['admin_user'] = $data['pseudo'];
			

						header('Location: ../admin/index.php');
						die();
						}
						else{
							
							header('Location: ../index.php');
					    }
					}
				else{ header('Location: index1.php?error=FAUXpassword');die();}
			}else{ header('Location: index1.php?error=email NON valide');die();}
		}else{ 
			header('Location: index1.php?error=email NON valide');die();}
		
	}
?>
