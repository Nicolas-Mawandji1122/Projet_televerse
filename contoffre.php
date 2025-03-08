<?php require_once "in_header2.php"; ?>
<script>
function printDiv(data) {
      var printContents = document.getElementById('data').innerHTML;    
   var originalContents = document.body.innerHTML;      
   document.body.innerHTML = printContents;     
   window.print();     
   document.body.innerHTML = originalContents;
   }
</script>
<div id="data">

<section id="publier">
    <h3>Les offre</h3>


    <?php

        // UPDATE
        if(isset($_GET['p'])){
            $req = $data->prepare("UPDATE t_offre SET etat_off=? WHERE id_off=? ");
            if($req->execute(array("VALIDE",$_GET['p']))){
                echo "<script> alert('Offre publié !') </script>";               
            }
        }else if(isset($_GET['np'])) {
            $req = $data->prepare("UPDATE t_offre SET etat_off=? WHERE id_off=? ");
            if($req->execute(array("NON VALIDE",$_GET['np']))){
                echo "<script> alert('Offre publication annuler !') </script>";               
            }
        }

        // DELETE
        if(isset($_GET['sup'])){
            if($data->query("DELETE FROM t_offre WHERE id_off='".$_GET['sup']."' ")){
                echo "<script> alert('Suppression réussi !') </script>";                
            }
        }
    ?>

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
            </td><td>";

                if($bd['etat_off'] == "SIGNE"){
                    echo "<i>Contrat déjà signé</i>";
                }else{
                echo "<form action='contrat.php' method='get'>
                    <input type='hidden' value='".$bd['id_off']."' name='i'/>
                    <input type='hidden' value='1' name='v'/>
                    <button name='view' class='btn btn-primary'>Signer un contrat</button>
                </form>";
                }    
                echo "

            </td><td>
                <a href='contoffre.php?sup=".$bd['id_off']."'><button class='btn btn-danger'>Annuler</button></a> &nbsp";
                if($bd['etat_off'] == "VALIDE"){
                    echo "<a href='contoffre.php?np=".$bd['id_off']."'><button class='btn btn-primary'>Annuler Publication</button></a>";
                }
            else 
                if($bd['etat_off'] == "NON VALIDE"){
                echo "<a href='contoffre.php?p=".$bd['id_off']."'><button class='btn btn-primary'>Publier Offre</button></a>";
            }
                echo "
            </td>
        </tr>

            ";
        }
    ?>

    </table>
   



<CENTER><button type="button"  style="width:150px;padding: 10px;border-radius: 10px;border:none;background: black;color:white" onclick="printDiv(data)"><span
class=" glyphicon glyphicon-print"></span>&nbsp;Imprimer</button>&nbsp;</CENTER>
</section>
    </div>

