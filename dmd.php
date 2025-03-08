<?php require_once "in_head.php"; ?>

<section id="publier">
    <h3>Les demandes</h3>

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
        $req=$data->query("SELECT * FROM t_demande JOIN t_menager ON t_demande.men_dmd = t_menager.id_ger WHERE etat_dmd='VALIDE' ORDER BY id_ger DESC");
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
                    <input type='hidden' value='".$bd['nom_ger']."' name='nom'/>
                    <input type='hidden' value='".$bd['genre_ger']."' name='genre'/>
                    <input type='hidden' value='".$bd['date_ger']."' name='dat'/>
                    <input type='hidden' value='".$bd['tel_ger']."' name='tel'/>
                    <input type='hidden' value='".$bd['adress_ger']."' name='adress'/>
                    <input type='hidden' value='img/".$bd['img_ger']."' name='img'/>
                    <button name='view' class='btn btn-success'>Voir</button>
                </form>
            </td>
        </tr>

            ";
        }
    ?>

    </table>

</section>