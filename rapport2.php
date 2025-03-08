<?php require_once "in_header2.php"; ?>

<section id="enregistrer">
    <h3>RAPPORT</h3>

    <?php

        // UPDATE
        if(isset($_GET['r'])){
            $req = $data->prepare("UPDATE t_rapport SET etat_rap=? WHERE id_rap=? ");
            if($req->execute(array("VALIDE",$_GET['r']))){
                echo "<script> alert('Rapport validé !') </script>";               
            }
        }
    ?>

    <table border="1" class="table table-primary">
        <tr>
            <th>N</th>
            <th>Menage</th>
            <th>Menager(e)</th>
            <th>Description</th>
            <th>Date</th>
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
            <td>".$bd['date_rap']."</td><td>";
            if($bd['etat_rap'] != "VALIDE"){
                echo "<a href='rapport2.php?r=".$bd['id_rap']."'>
                <button class='btn btn-primary'>Valider</button> </a>";
            }else{
                echo "<i>Rapport déjà validé</i>";
            }
        echo "</td></tr>

    		";
    	}
    ?>

    </table>

</section>

<?php require_once "in_footer.php"; ?>