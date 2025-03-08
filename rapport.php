<?php require_once "in_header.php"; ?>

<section id="enregistrer">
    <h3>RAPPORT</h3>

    <?php
      if(isset($_GET['enr'])){
    ?>
         <form action="" method="post">

            <label>Menage</label>
            <input type="text" name="rmen" <?php echo "value='".$_GET['men']."' " ?> class="form-control" disabled><br>

            <label>Menager(e)</label>
            <input type="text" name="rger" <?php echo "value='".$_GET['ger']."' " ?> class="form-control" disabled><br>

            <label for="details">Description :</label><br>
            <textarea id="details" name="desc" rows="4" cols="50"  class="form-control" required></textarea><br>

            <button type="submit" name='send' class="btn btn-primary">Enregistrer</button>
        </form>
                
    <?php
		}else if(isset($_GET['mod'])) {
	?>

    
        <form action="rapport.php" method="post" enctype="multipart/form-data">
        <label for="type">Menage :</label>
        <input type="hidden" name="id" <?php echo "value='".$_GET['id']."'" ?> >
        <label for="details">Description :</label><br>
        <textarea id="details" name="desc" rows="4" cols="50" class="form-control"><?php echo $_GET['desc'] ; ?></textarea><br>
        <button type="submit" name="sendmod" class="btn btn-primary">Modifier</button>
        </form>

    <?php
        }
    	// INSERT
		if(isset($_POST['send'])){


			$info ="";
			$men = $_GET['men'];
			$reg = $_GET['ger'];

					$req = $data->prepare("INSERT INTO t_rapport VALUES(null,now(),?,?,?,?)");
					if($req->execute(array($men,$reg,$_POST['desc'],"NON VALIDE"))){
			            $info = "Enregistrement Terminé !";
			        }else{
			            $info = " Echec d'enregistrement";
			        }

			echo "<script>
				alert('".$info."')
			</script>";

		}
       
        // UPDATE
        if(isset($_POST['sendmod'])){
            $req = $data->prepare("UPDATE t_rapport SET desc_rap=? WHERE id_rap=? ");
            if($req->execute(array($_POST['desc'],$_POST['id']))){
                echo "<script> alert('Modification réussi !') </script>";               
            }
        }

        // DELETE
    	if(isset($_GET['sup'])){
    		if($data->query("DELETE FROM t_rapport WHERE id_rap ='".$_GET['sup']."' ")){
				echo "<script> alert('Suppression réussi !') </script>";    			
    		}
    	}


    ?>

    <h3>Les Rapports</h3>

    <table border="1" class="table table-primary">
        <tr>
            <th>N</th>
            <th>Menage</th>
            <th>Menager(e)</th>
            <th>Description</th>
            <th>Date</th>
            <th></th>
            <th></th>
        </tr>
    <?php
    	$n = 0;
    	$req=$data->query("SELECT * FROM t_rapport ORDER BY id_rap DESC");
    	while($bd=$req->fetch()){
    		$n++;
    		echo "

        <tr>
            <td>".$n."</td>
            <td>".$bd['men_rap']."</td>
            <td>".$bd['ger_rap']."</td>
            <td>".$bd['desc_rap']."</td>
            <td>".$bd['date_rap']."</td>
            <td>
            <a href='rapport.php?sup=".$bd['id_rap']."'><button class='btn btn-danger'>Annuler</button></a> &nbsp
            </td><td>
            
                  <form action='' method='get'>
                    <input type='hidden' value='".$bd['desc_rap']."' name='desc'/>
                    <input type='hidden' value='".$bd['id_rap']."' name='id'/>
                    <button name='mod' class='btn btn-primary'>Modifier</button>
                </form>
                </td>

        </tr>

    		";
    	}
    ?>

    </table>

</section>

<?php require_once "in_footer.php"; ?>