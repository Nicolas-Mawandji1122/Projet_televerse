<?php require_once "in_header2.php"; ?>

<section id="publier">
    <h3>Signer un contrat</h3>
    <form action="" method="post">

        <label for="type">Menage :</label>
        <select name="menage" class="form-control">
            <?php
                $reqt=$data->query("SELECT * FROM t_menage ORDER BY nom_men ASC");
                while($row=$reqt->fetch()){
                    echo "<option value='".$row['id_men']."'>".$row['nom_men']."</option>";
                }
            ?>
        </select><br>

        <label for="type">Ménager(e) :</label>
        <select name="travail" class="form-control">
            <?php
                $reqt=$data->query("SELECT * FROM t_menager ORDER BY nom_ger ASC");
                while($row=$reqt->fetch()){
                    echo "<option value='".$row['id_ger']."'>".$row['nom_ger']."</option>";
                }
            ?>
        </select><br>

        <input type="checkbox" id="cont" onclick="myFunction()"/><label for="cont">Contrat à durée indeterminé</label><br/>

        <div id="text">
            <label>Date d'entré en vigeur</label>
            <input type="date" name="datevig" class="form-control" id="dat1"><br>

            <label>Date Fin Contrat</label>
            <input type="date" name="datefin" class="form-control" id="dat2"><br>
        </div>

        <input type="text" name="sal"  placeholder="Salaire" class="form-control" required><br>

        <label for="details">Clauses :</label><br>
        <textarea id="details" name="desc" rows="4" cols="50"  class="form-control"></textarea><br>

        <button type="submit" name="send" class="btn btn-primary">Signer le contrat</button>
    </form>

    <?php
        if(isset($_POST['send'])){

            $date1 = "";
            $date2 = "";
            $day = null;

            if(isset($_POST['datefin']) && $_POST['datevig']){
                $date1 = $_POST['datefin'];
                $date2 = $_POST['datevig'];

                // Convertir les dates en objets DateTime
                $datetime1 = new DateTime($date1);
                $datetime2 = new DateTime($date2);

                // Calculer la différence entre les deux dates
                $diff = date_diff($datetime1, $datetime2);
                $day = $diff->format('%y années, %m mois, %d jours');
            }else{
                $date1 = null;
                $date2 = null;                
            }

            $req = $data->prepare("INSERT INTO t_contrat VALUES(null,now(),?,?,?,?,?,?,?,?)");
            if($req->execute(array($date2,$date1,$_POST['sal'],$day,$_POST['desc'],$_POST['menage'],$_POST['travail'],"NON VALIDE"))){
                if($_GET['v']==1){
                    $req = $data->prepare("UPDATE t_offre SET etat_off=? WHERE id_off=? ");
                    $req->execute(array("SIGNE",$_GET['i']));
                }else{
                    $req = $data->prepare("UPDATE t_demande SET etat_dmd=? WHERE id_dmd=? ");
                    $req->execute(array("SIGNE",$_GET['i']));
                }
                $info = "Enregistrement Terminé !";
            }else{
                $info = " Echec d'enregistrement";
            }

            echo "<script>
                alert('".$info."')
            </script>";

        }
    ?>

</section>

    <script>

        function myFunction() {
          // Get the checkbox
          var checkBox = document.getElementById("cont");
          // Get the output text
          var text = document.getElementById("text");

          // If the checkbox is checked, display the output text
          if (checkBox.checked == false){
            text.style.display = "block";
          } else {
            text.style.display = "none";
            document.getElementById("dat1").value = "";
            document.getElementById("dat2").value = "";
          }
        }

    </script>
</body>
</html>