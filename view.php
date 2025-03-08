<?php
                $date1 = "2024-11-11";
                $date2 = "2024-11-12";

                // Convertir les dates en objets DateTime
                $datetime1 = new DateTime($date1);
                $datetime2 = new DateTime($date2);

                // Calculer la différence entre les deux dates
                $diff = date_diff($datetime1, $datetime2);
                $day = $diff;
echo "Différence : " . $day;
?>
