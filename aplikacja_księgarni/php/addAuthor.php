<?php
$error = false;
$msg = '';
if (!isset($_POST['name']) || !isset($_POST['surname'])) {
    $error = true;
    $msg = "Podaj dane autora";
} else {
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    require_once "connect.php";
    $conn = sqlsrv_connect($serverName, $connectionOptions);
    if (!$conn) {
        $error = true;
        $msg = 'Błąd połączenia z bazą danych';
    } else {
        $query = "EXEC dodajAutora @imie='$name',@nazwisko='$surname';";
        $result = sqlsrv_query($conn, $query);
        $affected_rows = sqlsrv_rows_affected($result);
        if ($affected_rows == 1) {
            $msg = "Dodano do bazy";
        } else {
            $error = true;
            $msg = "Podaj poprawne dane autora";
        }
        sqlsrv_close($conn);
    }
}
$array = [$error, $msg];
echo json_encode($array);
