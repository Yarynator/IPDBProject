<?php
require_once("./db_connect.inc.php");

$getSort = $_GET["poradi"];
if($getSort === "name_up")
    $sorting = "NameUp";
else if($getSort === "room_down")
    $sorting = "RoomDown";
else if($getSort === "room_up")
    $sorting = "RoomUp";
else if($getSort === "phone_down")
    $sorting = "PhoneDown";
else if($getSort === "phone_up")
    $sorting = "PhoneUp";
    else if($getSort === "job_down")
    $sorting = "JobDown";
else if($getSort === "job_up")
    $sorting = "JobUp";
else
    $sorting = "NameDown";
    
$arrowDown = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-down-square" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M15 2a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2zM0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm8.5 2.5a.5.5 0 0 0-1 0v5.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V4.5z"/></svg>';
$arrowUp = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-up-square" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M15 2a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2zM0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm8.5 9.5a.5.5 0 0 1-1 0V5.707L5.354 7.854a.5.5 0 1 1-.708-.708l3-3a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 5.707V11.5z"/></svg>';
$arrowDownCollored = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-down-square-fill" viewBox="0 0 16 16"><path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm6.5 4.5v5.793l2.146-2.147a.5.5 0 0 1 .708.708l-3 3a.5.5 0 0 1-.708 0l-3-3a.5.5 0 1 1 .708-.708L7.5 10.293V4.5a.5.5 0 0 1 1 0z"/></svg>';
$arrowUpCollored = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-up-square-fill" viewBox="0 0 16 16"><path d="M2 16a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2zm6.5-4.5V5.707l2.146 2.147a.5.5 0 0 0 .708-.708l-3-3a.5.5 0 0 0-.708 0l-3 3a.5.5 0 1 0 .708.708L7.5 5.707V11.5a.5.5 0 0 0 1 0z"/></svg>';
?>
<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seznam zaměstnanců</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Seznam zaměstnanců</h1>
        <div class="row">
            <div class="col-4 fw-bold">Jméno <?php echo "<a class='icon' href='./zamestnanci.php?poradi=name_down'>".($sorting === "NameDown" ? $arrowDownCollored : $arrowDown)."</a>"."<a class='icon' href='./zamestnanci.php?poradi=name_up'> ".($sorting === "NameUp" ? $arrowUpCollored : $arrowUp)."</a>" ?></div>
            <div class="col fw-bold">Místnost <?php echo "<a class='icon' href='./zamestnanci.php?poradi=room_down'>".($sorting === "RoomDown" ? $arrowDownCollored : $arrowDown)."</a>"."<a class='icon' href='./zamestnanci.php?poradi=room_up'> ".($sorting === "RoomUp" ? $arrowUpCollored : $arrowUp)."</a>" ?></div>
            <div class="col fw-bold">Telefon <?php echo "<a class='icon' href='./zamestnanci.php?poradi=phone_down'>".($sorting === "PhoneDown" ? $arrowDownCollored : $arrowDown)."</a>"."<a class='icon' href='./zamestnanci.php?poradi=phone_up'> ".($sorting === "PhoneUp" ? $arrowUpCollored : $arrowUp)."</a>" ?></div>
            <div class="col fw-bold">Pozice <?php echo "<a class='icon' href='./zamestnanci.php?poradi=job_down'>".($sorting === "JobDown" ? $arrowDownCollored : $arrowDown)."</a>"."<a class='icon' href='./zamestnanci.php?poradi=job_up'> ".($sorting === "JobUp" ? $arrowUpCollored : $arrowUp)."</a>" ?></div>
        </div>
        <?php

        $sql = "SELECT e.name AS ename, e.surname AS esurname, e.employee_id AS eid, job, r.name AS rname, phone FROM employee e INNER JOIN room r ON e.room=r.room_id ORDER BY ";

        if($sorting === "NameUp")
            $sql .= "ename DESC";
        else if($sorting === "NameDown")
            $sql .= "ename";
        else if($sorting === "RoomUp")
            $sql .= "rname DESC";
        else if($sorting === "RoomDown")
            $sql .= "rname";
        else if($sorting === "PhoneUp")
            $sql .= "phone DESC";
        else if($sorting === "PhoneDown")
            $sql .= "phone";
            else if($sorting === "JobUp")
                $sql .= "job DESC";
            else
                $sql .= "job";

        $stmt = $pdo->query($sql);
        if($stmt->rowCount() == 0){
            echo "Žádné data";
        }
        else{
            while($row = $stmt->fetch()){
                //var_dump($row->name);
                //echo "<li class='list-group-item'>{$row->name} {$row->surname}</li>";
                echo "<hr><div class='row'>";

                echo "<div class='col-4'><a href='./clovek.php?ClovekId={$row->eid}'>{$row->ename} {$row->esurname}</a></div>";
                echo "<div class='col'>{$row->rname}</div>";
                echo "<div class='col'>{$row->phone}</div>";
                echo "<div class='col'>{$row->job}</div>";
                
                echo "</div>";
            }
        }      
        unset($stmt); 
        ?>
    </div>
</body>
</html>