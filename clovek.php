<?php
require_once("./db_connect.inc.php");
$chyba = "";
if(isset($_GET["ClovekId"])){
    $ClovekId = $_GET["ClovekId"];
    $stmt = $pdo->query("SELECT e.name AS ename, e.surname AS esurname, e.job AS ejob, e.wage AS ewage,
    r.name AS rname, r.room_id AS rid FROM employee e INNER JOIN room r ON e.room=r.room_id WHERE e.employee_id=$ClovekId");
        if($stmt->rowCount() === 0){
            $title = "404 Not Found";
            $chyba = "<h1>404 Not Found</h1><p>Stránka nenalezena</p>";
            http_response_code(404);
        }
        else{
            http_response_code(200);
            $row = $stmt->fetch();
            $title = "Karta osoby {$row->esurname} {$row->ename[0]}.";
            echo "<h1>Karta osoby: <i>{$row->esurname} {$row->ename[0]}</i>. </h1>";
            echo "<table class='table'>";
            
            echo "<tr><th>Jméno</th><td>$row->ename</td></tr>";
            echo "<tr><th>Příjmení</th><td>$row->esurname</td></tr>";
            echo "<tr><th>Pozice</th><td>$row->ejob</td></tr>";
            echo "<tr><th>Mzda</th><td>$row->ewage</td></tr>";
            echo "<tr><th>Místnost</th><td><a href='./mistnost.php?mistnostId={$row->rid}'>{$row->rname}</a></td></tr>";

            $stmt = $pdo->query("SELECT r.name AS name, r.room_id AS room_id FROM `key` k INNER JOIN room r ON k.room=r.room_id WHERE employee=$ClovekId");
            $index = 0;
            while($row = $stmt->fetch()){
                echo "<tr><th>".($index===0?"Místnosti":"")."</th><td><a href='./mistnost.php?mistnostId={$row->room_id}'>$row->name</a></td></tr>";
                $index++;
            }
            
            echo "</table>";
            echo "<a href='./zamestnanci.php'>Zpět na seznam zaměstnanců</a>";
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