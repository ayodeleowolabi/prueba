<?php
include('auth/auth.php');
include('auth/getuniversities.php');
include('auth/getcourses.php');


/* for($x = 0; $x < count($getUniversities); $x++){
    echo $getUniversities[$x]["name_university"] . "<br>";
    echo $getUniversities[$x]["id_university"] . "<br>";
    echo $getUniversities[$x]["country_name"] . "<br>";
    echo $getUniversities[$x]["time_zone_name"] . "<br>";
    echo "<hr/>";
}
    */

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1 style="text-align: center;">Universities</h1>
    <table>
        <thead>
            <tr>
                <th>University Name</th>
                <th>Country </th>
                <th>Time Zone</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($getUniversities as $university): ?>
                <tr>
                    <td> <a href="?id=<?= $university["id_university"]?>">
                    <?=$university["name_university"] ?> </a></td>
                    <td><?=$university["country_name"]   ?> </td>
                    <td style="text-align:end;"> <?=$university["time_zone_name"] ?> </td>
                    
                </tr>
<?php endforeach; ?>

        </tbody>
    </table>
    
</body>
</html>