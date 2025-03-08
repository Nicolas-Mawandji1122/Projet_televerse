<?php require_once "in_header.php"; ?>

<section id="publier">
    <h3>Enregistrer une offre</h3>


    <?php
      if(isset($_POST['mod'])){
    ?>

    <form action="pub.php" method="post">
        <label for="type">Menage :</label>
        <input type="hidden" name="id" <?php echo "value='".$_POST['id']."'" ?> >
        <label for="details">Description :</label><br>
        <textarea id="details" name="desc" rows="4" cols="50" class="form-control"><?php echo $_POST['desc'] ; ?></textarea><br>
        <button type="submit" name="sendmod" class="btn btn-primary">Modifier</button>
    </form>

    <?php
        }else{
    ?>

    <form action="pub.php" method="post">

        <label for="type">Menage :</label>
        <select name="menage" class="form-control">
        	<?php
        		$reqt=$data->query("SELECT * FROM t_menage ORDER BY nom_men ASC");
    			while($row=$reqt->fetch()){
    				echo "<option value='".$row['id_men']."'>".$row['nom_men']."</option>";
    			}
        	?>
        </select><br>

        <label for="details">Description :</label><br>
        <textarea id="details" name="desc" rows="4" cols="50"  class="form-control"></textarea><br>
        <button type="submit" name="send" class="btn btn-primary">Enregistrer</button>
    </form>

    <?php

        }

        // UPDATE
        if(isset($_GET['p'])){
            $req = $data->prepare("UPDATE t_offre SET etat_off=? WHERE id_off=? ");
            if($req->execute(array("VALIDE",$_GET['p']))){
                echo "<script> alert('Offre publié !') </script>";               
            }
        }

        // UPDATE
        if(isset($_POST['sendmod'])){
            $req = $data->prepare("UPDATE t_offre SET desc_off=? WHERE id_off=? ");
            if($req->execute(array($_POST['desc'],$_POST['id']))){
                echo "<script> alert('Modification réussi !') </script>";               
            }
        }

        // DELETE
        if(isset($_GET['sup'])){
            if($data->query("DELETE FROM t_offre WHERE id_off='".$_GET['sup']."' ")){
                echo "<script> alert('Suppression réussi !') </script>";                
            }
        }

		if(isset($_POST['send'])){


			$req = $data->prepare("INSERT INTO t_offre VALUES(null,now(),?,?,?)");
			if($req->execute(array($_POST['desc'],$_POST['menage'],"NON VALIDE"))){
			    $info = "Enregistrement Terminé !";
			}else{
			    $info = " Echec d'enregistrement";
			}

			echo "<script>
				alert('".$info."')
			</script>";

		}
    ?>

    <h3>Liste des Offres</h3>

    <table border="1" class="table table-primary">
        <tr>
            <th>N</th>
            <th>DATE</th>
            <th>MENAGE</th>
            <th>DESCRIPTION</th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
    <?php
    	$n = 0;
    	$req=$data->query("SELECT * FROM t_offre JOIN t_menage ON t_offre.men_off = t_menage.id_men ORDER BY id_off DESC");
    	while($bd=$req->fetch()){
    		$n++;
    		echo "

        <tr>
            <td>".$n."</td>
            <td>".$bd['date_off']."</td>
            <td>".$bd['nom_men']."</td>
            <td>".$bd['desc_off']."</td>
            <td>
                <form action='profil.php' method='post'>
                    <input type='hidden' value='".$bd['date_off']."' name='tel'/>
                    <input type='hidden' value='".$bd['nom_men']."' name='nom'/>
                    <input type='hidden' value='".$bd['desc_off']."' name='adress'/>
                    <button name='view' class='btn btn-success'>Voir</button>
                </form>
            </td><td>
                <form action='' method='post'>
                    <input type='hidden' value='".$bd['desc_off']."' name='desc'/>
                    <input type='hidden' value='".$bd['id_off']."' name='id'/>
                    <button name='mod' class='btn btn-primary'>Modifier</button>
                </form>
            </td><td>
                <a href='pub.php?sup=".$bd['id_off']."'><button class='btn btn-danger'>Annuler</button></a>
            </td>
        </tr>

    		";
    	}
    ?>

    </table>

</section>