<?php
require __DIR__ . '/config.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>test zoom api</title>
</head>
<body>
    <br>
    <h4>iniciar sesion</h4>
    <a href="<?php echo $loginUrl; ?>">Login with Zoom</a>
    
    <h4>crear reunion</h4>
    <form action="create_meeting.php" method="post">
        
        <label for="topic">titulo</label>
        <br>
        <input type="text" name="topic" id="topic">
        <br>

        <label for="start_time">fecha y hora de inicio</label>
        <br>
        <input type="datetime-local" name="start_time" id="start_time">
        <br>

        <label for="password">contrasena</label>
        <br>
        <input type="password" name="password" id="password">
        <br>

        <label for="type">tipo de reunion</label>
        <br>
        <select name="type" id="type">
            <option value="1">reunion instantanea</option>
            <option value="2">reunion programada</option>
            <option value="3">reunion recurrente sin tiempos prefijados</option>
            <option value="8">reunion recurrente con tiempos prefijados</option>
        </select>
        <br>

        <label for="duration">duracion</label>
        <br>
        <sub>llenar esto solo si se escogio reunion programada</sub>
        <br>
        <input type="number" name="duration" id="duration">
        <br>

        <div>

            <label for="recurrence_type">tipo de recurrencia</label>
            <br>
            <sub>llenar esto solo si se escogio reunion recurrente con tiempos prefijados</sub>
            <br>
            <select name="recurrence_type" id="recurrence_type">
                <option value="1">diaria</option>
                <option value="2">semanal</option>
                <option value="3">mensual</option>
            </select>
            <br>

            <label for="repeat_interval">intervalo de recurrencia</label>
            <br>
            <input type="number" name="repeat_interval" id="repeat_interval">
            <br>
            
            <label for="weekly_days">dias de la semana</label>
            <br>
            <sub>llenar esto solo si se escogio reunion recurrente con tiempos prefijados y la recurrencia es semanal</sub>
            <br>
            <select name="weekly_days" id="weekly_days">
                <option value="1">domingo</option>
                <option value="2">lunes</option>
                <option value="3">martes</option>
                <option value="4">miercoles</option>
                <option value="5">jueves</option>
                <option value="6">viernes</option>
                <option value="7">sabado</option>
            </select>
            <br>

            <label for="end_times">numero de repeticiones</label>
            <br>
            <sub>llenar esto solo si se escogio reunion recurrente con tiempos prefijados y la recurrencia es semanal</sub>
            <br>
            <input type="number" name="end_times" id="end_times">
            <br>

        </div>
        <input type="submit" name="submit">
        <br>
    
    </form>

    <h4>crear grupo</h4>
    <form action="create_group.php" method="post">
        <label for="group_name">nombre del grupo</label>
        <br>
        <input type="text" name="group_name" id="group_name">
        <br>
        <input type="submit" name="submit">
    </form>
</body>
</html>
