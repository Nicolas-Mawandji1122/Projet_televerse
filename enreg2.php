<?php require_once "in_header.php"; ?>

<section id="enregistrer">
    <h3>Enregistrer un(e) ménager(e)</h3>

    <?php
      if(isset($_GET['mod'])){
    ?>

        <form action="enreg2.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" <?php echo "value='".$_GET['id']."' " ?> placeholder="Nom du responsable" class="form-control" required><br>

        <input type="text" name="nom" <?php echo "value='".$_GET['nom']."' " ?> placeholder="Nom complet" class="form-control" required><br>

        <select name="genre" class="form-control">
            <option value="M">Masculin</option>
            <option value="F">Femin</option>
        </select><br>

            <label>Date de Naissance</label>
            <input type="date" name="date" <?php echo "value='".$_GET['dat']."' " ?> placeholder="Date de naissance" class="form-control" required><br>
            <input type="text" name="tel" <?php echo "value='".$_GET['tel']."' " ?>placeholder="Télephhone" class="form-control" required><br>
            <input type="text" name="adresse" <?php echo "value='".$_GET['adress']."' " ?> placeholder="adresse" class="form-control" required><br>

            <label>Photo du menage</label>
            <input type="file" name="image" class="btn btn-primary" required><br>

            <button type="submit" name='mod' class="btn btn-primary">Modifier</button>
        </form>

    <?php
        }else{
    ?>

    <form action="enreg2.php" method="post" enctype="multipart/form-data">

        <input type="text" name="nom"  placeholder="Nom complet" class="form-control" required><br>

        <select name="genre" class="form-control">
            <option value="M">Masculin</option>
            <option value="F">Femin</option>
        </select><br>

        <label>Date de Naissance</label>
        <input type="date" name="date"  placeholder="Date de naissance" class="form-control" required><br>
        <input type="text" name="tel"  placeholder="Télephhone" class="form-control" required><br>
        <input type="text" name="adresse"  placeholder="adresse" class="form-control" required><br>

        <label>Photo du menage</label>
        <input type="file" name="image" class="btn btn-primary" required><br>

        <button type="submit" name='send' class="btn btn-primary">Enregistrer</button>
    </form>

    <?php


        }

        // UPDATE
        if(isset($_POST['mod'])){

            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $uploadDir = 'img/';
                $code = date('His').uniqid().date('dmY');
                $cover = $code.'.'.pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
                $uploadFile = $uploadDir . $cover;

                // Déplacer le fichier téléchargé
                if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {
                    $info = 'Télechargement du cover Réussi';

                    $req = $data->prepare("UPDATE t_menager SET nom_ger=?, genre_ger=?, date_ger=?,tel_ger=?, adress_ger=?, img_ger=? WHERE id_ger=? ");
                    if($req->execute(array($_POST['nom'],$_POST['genre'],$_POST['date'],$_POST['tel'],$_POST['adresse'],$cover,$_POST['id']))){
                        $info = "Enregistrement Terminé !";
                    }else{
                        $info = " Echec d'enregistrement";
                        unlink($uploadFile);
                    }
                } else {
                    $info = 'Erreur lors du chargement de votre COVER';
                }
                
            }else{
                $req = $data->prepare("UPDATE t_menager SET nom_ger=?, genre_ger=?, date_ger=?,tel_ger=?, adress_ger=? WHERE id_ger=? ");
                if($req->execute(array($_POST['nom'],$_POST['genre'],$_POST['date'],$_POST['tel'],$_POST['adresse'],$_POST['id']))){
                    echo "<script> alert('Modification réussi !') </script>";               
                }
            }

            echo "<script> alert('".$info."') </script>"; 

        }

        // DELETE
        if(isset($_GET['sup'])){
            if($data->query("DELETE FROM t_menager WHERE id_ger='".$_GET['sup']."' ")){
                echo "<script> alert('Suppression réussi !') </script>";                
            }
        }

		if(isset($_POST['send'])){

			if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
			    $uploadDir = 'img/';
			    $code = date('His').uniqid().date('dmY');
			    $cover = $code.'.'.pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
			    $uploadFile = $uploadDir . $cover;


			    // Déplacer le fichier téléchargé
			    if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {
			        $info = 'Télechargement du cover Réussi';

					$req = $data->prepare("INSERT INTO t_menager VALUES(null,?,?,?,?,?,?)");
					if($req->execute(array($_POST['nom'],$_POST['genre'],$_POST['date'],$_POST['tel'],$_POST['adresse'],$cover))){
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
            <th>NOM</th>
            <th>GENRE</th>
            <th>DATE NAISSANCE</th>
            <th>TELEPHONE</th>
            <th>ADRESSE</th>
            <th>PROFIL</th>
            <th></th> <th></th> <th></th>
        </tr>
    <?php
    	$n = 0;
    	$req=$data->query("SELECT * FROM t_menager ORDER BY nom_ger ASC");
    	while($bd=$req->fetch()){
    		$n++;
    		echo "

        <tr>
            <td>".$n."</td>
            <td>".$bd['nom_ger']."</td>
            <td>".$bd['genre_ger']."</td>
            <td>".$bd['date_ger']."</td>
            <td>".$bd['tel_ger']."</td>
            <td>".$bd['adress_ger']."</td>
            <td> <img src='img/".$bd['img_ger']."' alt='image'/> </td>
            <td>
                <form action='profil.php' method='post'>
                    <input type='hidden' value='".$bd['nom_ger']."' name='nom'/>
                    <input type='hidden' value='".$bd['genre_ger']."' name='genre'/>
                    <input type='hidden' value='".$bd['date_ger']."' name='dat'/>
                    <input type='hidden' value='".$bd['tel_ger']."' name='tel'/>
                    <input type='hidden' value='".$bd['adress_ger']."' name='adress'/>
                    <input type='hidden' value='img/".$bd['img_ger']."' name='img'/>
                    <button name='view' class='btn btn-success'>Voir</button>
                </form>
            </td><td>
                <form action='' method='get'>
                    <input type='hidden' value='".$bd['nom_ger']."' name='nom'/>
                    <input type='hidden' value='".$bd['genre_ger']."' name='genre'/>
                    <input type='hidden' value='".$bd['date_ger']."' name='dat'/>
                    <input type='hidden' value='".$bd['tel_ger']."' name='tel'/>
                    <input type='hidden' value='".$bd['adress_ger']."' name='adress'/>
                    <input type='hidden' value='".$bd['id_ger']."' name='id'/>
                    <button name='mod' class='btn btn-primary'>Modifier</button>
                </form>
            </td><td>
                <a href='enreg2.php?sup=".$bd['id_ger']."'><button class='btn btn-danger'>Supprimer</button></a>
            </td>
        </tr>

    		";
    	}
    ?>

    </table>

</section>

<?php require_once "in_footer.php"; ?>