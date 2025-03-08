<?php require_once "in_header2.php"; ?>

    <style>

.container {
    width: 80%;
    margin: auto;
    padding: 20px;
    padding-top: 100px;
}

.header {
    text-align: center;
    margin-bottom: 20px;
}

.grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(400px, 1fr));
    gap: 20px;
}

.card {
    background: white;
    border-radius: 8px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    padding: 15px;
    transition: transform 0.2s;
}

.card:hover {
    transform: scale(1.05);
}

.card h2 {
    margin-bottom: 10px;
    font-size: 18px;
    color: #333;
}

.card p {
    font-size: 14px;
    color: #666;
}


    </style>

<?php
    $men = "";
    $trav = "";
    $off = "";
    $dmd = "";
    $cont = "";
    $req=$data->query("SELECT count(id_men) as nb FROM t_menage");
    while($bd=$req->fetch()){
        $men = $bd['nb'];
    }
    $req=$data->query("SELECT count(id_ger) as nb FROM t_menager");
    while($bd=$req->fetch()){
        $trav = $bd['nb'];
    }
    $req=$data->query("SELECT count(id_off) as nb FROM t_offre");
    while($bd=$req->fetch()){
        $off = $bd['nb'];
    }
    $req=$data->query("SELECT count(id_dmd) as nb FROM t_demande");
    while($bd=$req->fetch()){
        $dmd = $bd['nb'];
    }
    $req=$data->query("SELECT count(id_cont) as nb FROM t_contrat");
    while($bd=$req->fetch()){
        $cont = $bd['nb'];
    }
?>

    <div class="container">
        
        <div class="grid">
            <div class="card card-1">
                <h2>Menages</h2>
                <p>Nombre des menages : <?php echo $men; ?></p>
            </div>
            <div class="card card-2">
                <h2>Menagers</h2>
                <p>Menagers enregistrés : <?php echo $trav; ?> </p>
            </div>
            <div class="card card-3">
                <h2>Offres</h2>
                <p>Total offres : <?php echo $off; ?></p>
            </div>
            <div class="card card-3">
                <h2>Demandes</h2>
                <p>Total demandes : <?php echo $dmd; ?></p>
            </div>
            <div class="card card-4">
                <h2>Statistiques Contrat</h2>
                <p>Contrats signés <?php echo $cont; ?></p>
            </div>
        </div>
    </div>

<?php require_once "in_footer.php"; ?>