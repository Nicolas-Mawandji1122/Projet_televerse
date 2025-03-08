<?php require_once "in_header2.php"; ?>

<section id="publier">

    <h3>Les contrats</h3>

    <table border="1" class="table table-primary">
        <tr>
            <th>N</th>
            <th>DATE SIGN</th>
            <th>DATE VIGUEUR / FIN</th>
            <th>SALAIRE</th>
            <th>DUREE</th>
            <th>CLAUSE</th>
            <th>MENAGE</th>
            <th>MENGAER(E)</th>
            <th>STATUT</th>
            <th>#</th>
        </tr>
    <?php

        if(isset($_GET['v'])){
            $req = $data->prepare("UPDATE t_contrat SET statut_cont=? WHERE id_cont=?");
            if($req->execute(array("VALIDE",$_GET['v']))){
                echo "<script>
                    alert('Contrat Validé !');
                </script>";
            }
        }

        if(isset($_GET['r'])){
            $req = $data->prepare("UPDATE t_contrat SET statut_cont=? WHERE id_cont=?");
            if($req->execute(array("RESILIE",$_GET['r']))){
                echo "<script>
                    alert('Contrat Resilié !');
                </script>";
            }
        }


        $n = 0;
        $req=$data->query("SELECT * FROM t_contrat JOIN t_menage ON t_contrat.menag_cont = t_menage.id_men JOIN t_menager ON t_contrat.trav_cont = t_menager.id_ger ORDER BY id_cont DESC");
        while($bd=$req->fetch()){
            $n++;
            echo "

        <tr>
            <td>".$n."</td>
            <td>".$bd['datesign_cont']."</td>
            <td>".$bd['datevig_cont'].' / '.$bd['datefin_cont']."</td>
            <td>".$bd['salaire_cont']."</td>
            <td>".$bd['duree_cont']."</td>
            <td>".substr($bd['clause_cont'],0,20)."... <i>(Suite)</i>"."</td> 
            <td>".$bd['nom_men']."</td>
            <td>".$bd['nom_ger']."</td>
            <td style='background:black;color:white'> <strong>".$bd['statut_cont']."</strong> </td>
            <td>
                <a href='view/?c=".$bd['id_cont']."'>
                    <button class='btn btn-primary'>Voir l'aperçu</button>
                </a>";
        if($bd['statut_cont']=="NON VALIDE"){
            echo "<a href='tab.php?v=".$bd['id_cont']."'>
                    <button class='btn btn-primary'>Valider</button>
                </a>";
        }elseif($bd['statut_cont']=="RESILIE"){}
        else{
            echo "
                <a href='tab.php?r=".$bd['id_cont']."'>
                    <button class='btn btn-danger'>Résilier</button>
                </a>";
        }

            echo "
            </td>
        </tr>

            ";
        }
    ?>

    </table>

</section>