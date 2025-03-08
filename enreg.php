<?php require_once "in_header.php"; ?>

<section id="enregistrer">
    <h3>Enregistrer Une ménage</h3>

    <?php
      if(isset($_GET['mod'])){
    ?>

	    <form action="enreg.php" method="post" enctype="multipart/form-data">
	    	<input type="text" name="id"  <?php echo "value='".$_GET['id']."' " ?> placeholder="Nom du responsable" class="form-control" required><br>
	        <input type="text" name="nom"  <?php echo "value='".$_GET['nom']."' " ?> placeholder="Nom du responsable" class="form-control" required><br>
	        <input type="text" name="tel"  <?php echo "value='".$_GET['tel']."' " ?> placeholder="Téléphone du responsable" class="form-control" required><br>
	        <input type="text" name="adress"  <?php echo "value='".$_GET['adress']."' " ?> placeholder="Adresse du ménage" class="form-control" required><br>
	        <label>Photo du menage</label>
	        <input type="file" name="image" class="btn btn-primary" required><br>
	        <button type="submit" name='mod' class="btn btn-primary">Modifier</button>
	    </form>

    <?php
		}else{
	?>

    <form action="enreg.php" method="post" enctype="multipart/form-data">

        <input type="text" name="nom"  placeholder="Nom du responsable" class="form-control" required><br>
        <input type="text" name="tel"  placeholder="Téléphone du responsable" class="form-control" required><br>
        <input type="text" name="adress"  placeholder="Adresse du ménage" class="form-control" required><br>

        <label>Photo du menage</label>
        <input type="file" name="image" class="btn btn-primary" required><br>

        <button type="submit" name='send' class="btn btn-primary">Enregistrer</button>
    </form>

    <?php

    	}

		// UPDATE
    	if(isset($_POST['mod'])){

    		$info = "";

			if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
			    $uploadDir = 'img/';
			    $code = date('His').uniqid().date('dmY');
			    $cover = $code.'.'.pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
			    $uploadFile = $uploadDir . $cover;


			    // Déplacer le fichier téléchargé
			    if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {
			        $info = 'Télechargement du cover Réussi';

		    		$req = $data->prepare("UPDATE t_menage SET nom_men=?, tel_men=?, adress_men=?, img_men=? WHERE id_men=? ");
		    		if($req->execute(array($_POST['nom'],$_POST['tel'],$_POST['adress'],$cover,$_POST['id']))){
			            $info = "Enregistrement Terminé !";
			        }else{
			            $info = " Echec d'enregistrement";
			            unlink($uploadFile);
			        }
				} else {
			        $info = 'Erreur lors du chargement de votre COVER';
				}
			}else{		
	    		$req = $data->prepare("UPDATE t_menage SET nom_men=?, tel_men=?, adress_men=? WHERE id_men=? ");
	    		if($req->execute(array($_POST['nom'],$_POST['tel'],$_POST['adress'],$_POST['id']))){
					$info = "Modification réussi !";    			
	    		}
	    	}

	    	echo "<script> alert('".$info."') </script>"; 
    	}

    	// DELETE
    	if(isset($_GET['sup'])){
    		if($data->query("DELETE FROM t_menage WHERE id_men='".$_GET['sup']."' ")){
				echo "<script> alert('Suppression réussi !') </script>";    			
    		}
    	}

    	// INSERT
		if(isset($_POST['send'])){

			if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
			    $uploadDir = 'img/';
			    $code = date('His').uniqid().date('dmY');
			    $cover = $code.'.'.pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
			    $uploadFile = $uploadDir . $cover;


			    // Déplacer le fichier téléchargé
			    if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {
			        $info = 'Télechargement du cover Réussi';

					$req = $data->prepare("INSERT INTO t_menage VALUES(null,?,?,?,?)");
					if($req->execute(array($_POST['nom'],$cover,$_POST['tel'],$_POST['adress']))){
			            $info = "Enregistrement Terminé !";
			        }else{
			            $info = " Echec d'enregistrement";
			            unlink($uploadFile);
			        }
				} else {
			        $info = 'Erreur lors du chargement de votre COVER';
				}

				echo "<script>
					alert('".$info."')
				</script>";
			}

		}
    ?>

    <h3>Tableau</h3>

    <table border="1" class="table table-primary">
        <tr>
            <th>N</th>
            <th>Titre</th>
            <th>Téléphone</th>
            <th>Adresse</th>
            <th>Image</th>
            <th></th> <th></th> <th></th>
        </tr>
    <?php
    	$n = 0;
    	$req=$data->query("SELECT * FROM t_menage ORDER BY nom_men ASC");
    	while($bd=$req->fetch()){
    		$n++;
    		echo "

        <tr>
            <td>".$n."</td>
            <td>".$bd['nom_men']."</td>
            <td>".$bd['tel_men']."</td>
            <td>".$bd['adress_men']."</td>
            <td> <img src='img/".$bd['img_men']."' alt='image'/> </td>
            <td>
            	<form action='profil.php' method='post'>
            		<input type='hidden' value='".$bd['nom_men']."' name='nom'/>
            		<input type='hidden' value='".$bd['tel_men']."' name='tel'/>
            		<input type='hidden' value='".$bd['adress_men']."' name='adress'/>
            		<input type='hidden' value='img/".$bd['img_men']."' name='img'/>
            		<button name='view' class='btn btn-success'>Voir</button>
            	</form>
            </td><td>
            	<form action='' method='get'>
            		<input type='hidden' value='".$bd['nom_men']."' name='nom'/>
            		<input type='hidden' value='".$bd['tel_men']."' name='tel'/>
            		<input type='hidden' value='".$bd['adress_men']."' name='adress'/>
            		<input type='hidden' value='".$bd['id_men']."' name='id'/>
            		<button name='mod' class='btn btn-primary'>Modifier</button>
            	</form>
            </td><td>
            	<a href='enreg.php?sup=".$bd['id_men']."'><button class='btn btn-danger'>Supprimer</button></a>
            </td>
        </tr>

    		";
    	}
    ?>

    </table>

</section>

<?php require_once "in_footer.php"; ?>