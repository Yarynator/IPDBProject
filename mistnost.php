<?php
require_once("./db_connect.inc.php");
$chyba = "";
if(isset($_GET["mistnostId"])){
    $mistnostId = $_GET["mistnostId"];
    $stmt = $pdo->query("SELECT no, name, phone FROM room r WHERE r.room_id=$mistnostId");
    if($stmt->rowCount() === 0){
        $title = "400 Not Found";
        $chyba = "<h1>404 Not Found</h1><p>Stránka nenalezena</p>";
        http_response_code(404);
    }
    else{
        http_response_code(200);
        $row = $stmt->fetch();
        $title = "Karta místnosti č. {$row->no}";
        echo "<h1>Místnost č. {$row->no}</h1>";
        echo "<table class='table'>";

        echo "<tr><th>Číslo</th><td>{$row->no}</td></tr>";
        echo "<tr><th>Název</th><td>{$row->name}</td></tr>";
        echo "<tr><th>Telefon</th><td>{$row->phone}</td></tr>";

        $stmt = $pdo->query("SELECT name, surname, wage, employee_id FROM employee WHERE room=$mistnostId");
        $index = 0;
        $prumernaMzda = 0;
        if($stmt->rowCount() === 0){
            echo "<tr><th>Lidé</th><td>-</td></tr>";
            echo "<tr><th>Průměrná mzda</th><td>-</td></tr>";
        }
        else {
            while($row = $stmt->fetch()){
                echo "<tr><th>".($index===0?"Lidé":"")."</th><td><a href='./clovek.php?ClovekId={$row->employee_id}'>{$row->name} {$row->surname}</a></td></tr>";
                $prumernaMzda+=$row->wage;
            $index++;
            }
            $prumernaMzda/=$index;
            echo "<tr><th>Průměrná mzda</th><td>$prumernaMzda</td></tr>";
        }

        $stmt = $pdo->query("SELECT e.name AS name, e.surname AS surname, e.employee_id AS employee_id FROM `key` k INNER JOIN employee e ON k.employee=e.employee_id WHERE k.room=$mistnostId");
        if($stmt->rowCount() === 0){
            echo "<tr><th>Klíče</th><td>-</td></tr>";
        }
        else{
            $index = 0;
            while($row = $stmt->fetch()){
                echo "<tr><th>".($index === 0 ? "Klíče" : "")."</th><td><a href='./clovek.php?ClovekId={$row->employee_id}'>{$row->name} {$row->surname}</a></td></tr>";

                $index++;
            }
        }

        echo "</table>";
        echo "<a href='./mistnosti.php'>Zpět na seznam místností</a>";
    }
}
else{
    $title = "404 Not Found";
    $chyba = "<h1>404 Not Found</h1><p>Stránka nenalezena</p>";
    http_response_code(404);
}

?>
<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</head>
<body class="container">
<?php
echo $chyba;
?>
</body>
</html>