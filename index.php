<?php
require __DIR__ . '/config.php';
session_start();
$loginUrl = "https://zoom.us/oauth/authorize?response_type=code&client_id=".CLIENT_ID."&redirect_uri=".REDIRECT_URI;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>test zoom api</title>
</head>
<body>
    <?php print_r($_SESSION); ?>
    <br>
    <a href="<?php echo $loginUrl; ?>">Login with Zoom</a>
    
    <form action="create_meeting.php" method="post">
        
        <input type="text" name="topic">
        <input type="datetime-local" name="start_time">
        <input type="password" name="password">
        <select name="type">
            <option value="1">reunion instantanea</option>
            <option value="2">reunion programada</option>
            <option value="3">reunion recurrente sin tiempos prefijados</option>
            <option value="8">reunion recurrente con tiempos prefijados</option>
        </select>
        <input type="number" name="duration">
        <div>
            <select name="recurrence_type">
                <option value="1">diaria</option>
                <option value="2">semanal</option>
                <option value="3">mensual</option>
            </select>
            <input type="number" name="repeat_interval">
            <select name="weekly_days">
                <option value="1">domingo</option>
                <option value="2">lunes</option>
                <option value="3">martes</option>
                <option value="4">miercoles</option>
                <option value="5">jueves</option>
                <option value="6">viernes</option>
                <option value="7">sabado</option>
            </select>
            <input type="number" name="end_times">
        </div>
        <input type="submit" name="submit">
    
    </form>
</body>
</html>
