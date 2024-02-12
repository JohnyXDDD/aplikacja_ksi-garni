<?php
$error = false;
$msg = '';
if (!isset($_POST['category'])) {
    $error = true;
    $msg = "Podaj nazwę kategorii";
} else {
    $category = $_POST['category'];
    require_once "connect.php";
    $conn = sqlsrv_connect($serverName, $connectionOptions);
    if (!$conn) {
        $error = true;
        $msg = 'Błąd połączenia z bazą danych';
    } else {
        $query = "EXEC dodajKategorie @nazwaKategorii='$category';";
        $result = sqlsrv_query($conn, $query);
        $affected_rows = sqlsrv_rows_affected($result);
        if ($affected_rows == 1) {
            $msg = "Dodano do bazy";
        } else {
            $error = true;
            $msg = "Podaj nazwę kategorii";
        }
        sqlsrv_close($conn);
    }
}
$array = [$error, $msg];
echo json_encode($array);
