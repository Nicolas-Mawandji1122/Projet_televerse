<?php require_once "in_head.php"; ?>

<section id="publier">
    <h3>Les Offres</h3>

    <table border="1" class="table table-primary">
        <tr>
            <th>N</th>
            <th>DATE</th>
            <th>MENAGE</th>
            <th>DESCRIPTION</th>
            <th>#</th>
        </tr>
    <?php
    	$n = 0;
    	$req=$data->query("SELECT * FROM t_offre JOIN t_menage ON t_offre.men_off = t_menage.id_men WHERE etat_off='VALIDE' ORDER BY id_off DESC");
    	while($bd=$req->fetch()){
    		$n++;
    		echo "

        <tr>
            <td>".$n."</td>
            <td>".$bd['date_off']."</td>
            <td> <a href='enreg.php?sup=".$bd['id_men']."'>".$bd['nom_men']."</a> </td>
            <td>".$bd['desc_off']."</td>
            <td>
                <form action='profil.php' method='post'>
                    <input type='hidden' value='".$bd['nom_men']."' name='nom'/>
                    <input type='hidden' value='".$bd['tel_men']."' name='tel'/>
                    <input type='hidden' value='".$bd['adress_men']."' name='adress'/>
                    <input type='hidden' value='img/".$bd['img_men']."' name='img'/>
                    <button name='view' class='btn btn-success'>Voir</button>
                </form>
            </td>
        </tr>

    		";
    	}
    ?>

    </table>

</section>