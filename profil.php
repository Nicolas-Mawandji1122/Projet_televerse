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
            background: linear-gradient(90deg, #0a0525 0%, #070c4d 100%);
            color: #fff;
            padding: 10px 20px;
            text-align: center;
        }
        nav {
            background: #333;
            color: #fff;
            padding-top:20px;
            padding-bottom:20px;
        }
        nav a {
            margin: 0 15px;
            text-decoration: none;
            color: #fff;
            padding-right:20px;
            border-right: solid 1px white;
        }
        section {
            padding: 20px;
            background: white;
            margin: 20px;
            border-radius: 5px;
        }
        form{
            max-width: 50%;
        }
        th{
            background: #333;
            color: #fff;
            text-align: center;
            border-none;
        }
        img{
            width: 20px;
        }
        h2{
            font-weight: bold;
            padding-bottom: 10px;
            border-bottom: 2px solid silver;
        }
    </style>

</head>
<body>

<header>
    <h1>YASAB Info</h1>
</header>

<section style="text-align: center;font-size: 16px;">
	<?php
		if(isset($_POST['img'])){
			echo "<img style='width:200px;border-radius:100px' src='".$_POST['img']."' /> <br/><br/>";
		}

		echo "<b>".$_POST['nom']."</b> <br/><br/>";
		
		if(isset($_POST['genre'])){
			echo "<b>".$_POST['genre']."</b> <br/><br/>";
			echo "Date de naissance : <b>".$_POST['dat']."</b> <br/><br/>";
		}
		
		echo "<b>".$_POST['tel']."</b> <br/><br/>";
		echo "<b>".$_POST['adress']."</b> <br/>";
	?>
	
</section>

<?php require_once "in_footer.php"; ?>