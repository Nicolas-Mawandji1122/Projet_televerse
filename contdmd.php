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
    <h3>Les démandes</h3>

    <?php

        // UPDATE
        if(isset($_GET['p'])){
            $req = $data->prepare("UPDATE t_demande SET etat_dmd=? WHERE id_dmd=? ");
            if($req->execute(array("VALIDE",$_GET['p']))){
                echo "<script> alert('Demande publiée !') </script>";               
            }
        }else if(isset($_GET['np'])){
            $req = $data->prepare("UPDATE t_demande SET etat_dmd=? WHERE id_dmd=? ");
            if($req->execute(array("NON VALIDE",$_GET['np']))){
                echo "<script> alert('Demande publication annuler !') </script>";               
            }
        }

        // DELETE
        if(isset($_GET['sup'])){
            if($data->query("DELETE FROM t_demande WHERE id_dmd='".$_GET['sup']."' ")){
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
            </td><td>";

                if($bd['etat_dmd'] == "SIGNE"){
                    echo "<i>Contrat déjà signé</i>";
                }else{
                echo "<form action='contrat.php' method='get'>
                    <input type='hidden' value='".$bd['id_dmd']."' name='i'/>
                    <input type='hidden' value='1' name='v'/>
                    <button name='view' class='btn btn-primary'>Signer un contrat</button>
                </form>";
                }    
                echo "
            </td><td>
                <a href='contdmd.php?sup=".$bd['id_dmd']."'><button class='btn btn-danger'>Annuler</button></a> &nbsp";
                if($bd['etat_dmd'] == "VALIDE"){
                    echo "<a href='contdmd.php?np=".$bd['id_dmd']."'><button class='btn btn-primary'>Annuler publication</button></a>";
                }else
                    if($bd['etat_dmd'] == "NON VALIDE"){
                        echo "<a href='contdmd.php?p=".$bd['id_dmd']."'><button class='btn btn-primary'>Publier</button></a>";
                    }
                echo "
            </td>
        </tr>

            ";
        }
    ?>

    </table>
    <CENTER><button type="button" style="width:150px;padding: 10px;border-radius: 10px;border:none;background: black;color:white"  onclick="printDiv(data)"><span
class=" glyphicon glyphicon-print"></span>&nbsp;Imprimer</button>&nbsp;</CENTER>
</section>
    </div>