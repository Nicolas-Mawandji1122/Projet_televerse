<?php require_once "in_header.php"; ?>

<section id="publier">
    <h3>Enregistrer une démande</h3>

    <?php
      if(isset($_POST['mod'])){
    ?>

    <form action="pub2.php" method="post">
        <label for="type">Menage :</label>
        <input type="hidden" name="id" <?php echo "value='".$_POST['id']."'" ?> >
        <label for="details">Description :</label><br>
        <textarea id="details" name="desc" rows="4" cols="50" class="form-control"><?php echo $_POST['desc'] ; ?></textarea><br>
        <button type="submit" name="sendmod" class="btn btn-primary">Modifier</button>
    </form>

    <?php
        }else{
    ?>

    <form action="pub2.php" method="post">

        <label for="type">Ménager(e) :</label>
        <select name="menager" class="form-control">
            <?php
                $reqt=$data->query("SELECT * FROM t_menager ORDER BY nom_ger ASC");
                while($row=$reqt->fetch()){
                    echo "<option value='".$row['id_ger']."'>".$row['nom_ger']."</option>";
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
            $req = $data->prepare("UPDATE t_demande SET etat_dmd=? WHERE id_dmd=? ");
            if($req->execute(array("VALIDE",$_GET['p']))){
                echo "<script> alert('Demande publiée !') </script>";               
            }
        }

        // UPDATE
        if(isset($_POST['sendmod'])){
            $req = $data->prepare("UPDATE t_demande SET desc_dmd=? WHERE id_dmd=? ");
            if($req->execute(array($_POST['desc'],$_POST['id']))){
                echo "<script> alert('Modification réussi !') </script>";               
            }
        }

        // DELETE
        if(isset($_GET['sup'])){
            if($data->query("DELETE FROM t_demande WHERE id_dmd='".$_GET['sup']."' ")){
                echo "<script> alert('Suppression réussi !') </script>";                
            }
        }

        if(isset($_POST['send'])){


            $req = $data->prepare("INSERT INTO t_demande VALUES(null,now(),?,?,?)");
            if($req->execute(array($_POST['desc'],$_POST['menager'],"NON VALIDE"))){
                $info = "Enregistrement Terminé !";
            }else{
                $info = " Echec d'enregistrement";
            }

            echo "<script>
                alert('".$info."')
            </script>";

        }
    ?>

    <h3>Liste des demandes</h3>

    <table border="1" class="table table-primary">
        <tr>
            <th>N</th>
            <th>DATE</th>
            <th>MENAGER</th>
            <th>DESCRIPTION</th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
    <?php
        $n = 0;
        $req=$data->query("SELECT * FROM t_demande JOIN t_menager ON t_demande.men_dmd = t_menager.id_ger ORDER BY id_ger DESC");
        while($bd=$req->fetch()){
            $n++;
            echo "

        <tr>
            <td>".$n."</td>
            <td>".$bd['date_dmd']."</td>
            <td>".$bd['nom_ger']."</td>
            <td>".$bd['desc_dmd']."</td>
            <td>
                <form action='profil.php' method='post'>
                    <input type='hidden' value='".$bd['date_dmd']."' name='tel'/>
                    <input type='hidden' value='".$bd['nom_ger']."' name='nom'/>
                    <input type='hidden' value='".$bd['desc_dmd']."' name='adress'/>
                    <button name='view' class='btn btn-success'>Voir</button>
                </form>
            </td><td>
                <form action='' method='post'>
                    <input type='hidden' value='".$bd['desc_dmd']."' name='desc'/>
                    <input type='hidden' value='".$bd['id_dmd']."' name='id'/>
                    <button name='mod' class='btn btn-primary'>Modifier</button>
                </form>
            </td><td>
                <a href='pub2.php?sup=".$bd['id_dmd']."'><button class='btn btn-danger'>Annuler la demande</button></a>
            </td>
        </tr>

            ";
        }
    ?>

    </table>

</section>