<?php include("data.php"); ?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>YASAB Logiciel</title>
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        header {
            background: #333;
            color: #fff;
            padding: 10px 20px;
            text-align: center;
        }
        div {
            text-align: center;
            padding: 20px;
            coolor:red;
        }
        section {
            padding: 20px;
            background: white;
            margin: 20px;
            border-radius: 5px;
        }
        .form-control {
        	padding: 20px;
        }
    </style>

</head>
<body>

<header>
    <h1>Connexion YASAB Logiciel</h1>
</header>


<section style="width:50%;margin-left: 25%;">
	<form action="login.php" method="post">
		<input type="text" name="name"  placeholder="Nom d'utilisateur" class="form-control" required><br>
		<input type="password" name="mdp"  placeholder="Mot de passe" class="form-control" required><br>
        <button type="submit" name='send' class="btn btn-primary">Enregistrer</button>
	</form>

	<div>
		<?php
			if(isset($_POST['send'])){
				$v = 0;
				$req=$data->prepare("SELECT * FROM t_user WHERE mdp=? AND name=? ");
				$req->execute(array($_POST['mdp'],$_POST['name']));
			    while($bd=$req->fetch()){
			    	$v = $bd['font'];
			    }
			    if($v==1){
			    	header('location:home.php');
			    }elseif($v==2){
                    header('location:home2.php');
                }
                else{
			    	echo "Authentification incorrect !";
			    }
			}
		?>
	</div>
</section>

</body>
</html>