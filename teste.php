<?php
    try
    {
      $data = new PDO('mysql:host=localhost;dbname=yasab;charset=utf8','root','');
      //N5p32rid1D
    }
    catch(Exception $e)
    {
      die('Erreur : '.$e->getmessage());  
    }
    
		if(isset($_POST['send'])){


			$info ="";
			$men = $_GET['men'];
			$reg = $_GET['ger'];

                    //$req = $data->prepare("INSERT INTO t_rapport VALUES(null,now(),?,?,?,?)");
                    $req= ("insert into t_rapport values ($men,$reg,$_post['desc'],'NON VALIDE')");
                    $data->exec($req);
					

			echo "<script>
				alert('".$info."')
			</script>";

		}
       

?>