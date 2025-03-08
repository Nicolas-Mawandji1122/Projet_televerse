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
            width: 100px;
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
    <h1>Bienvnue sur <b><b><b>YASAB</b></b></b> App</h1>
</header>

<nav>
    <a href="index.php">Offres</a>
    <a href="dmd.php">Demandes</a>
    <a href="login.php">Se connecter</a>
</nav>