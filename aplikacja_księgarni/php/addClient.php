<?php
$error = false;
$msg = '';
if (!isset($_POST['client-name']) || !isset($_POST['client-surname']) || !isset($_POST['client-address'])) {
    $error = true;
    $msg = "Podaj dane klienta";
} else {
    $name = htmlentities($_POST['client-name']);
    $surname = htmlentities($_POST['client-surname']);
    $address = htmlentities($_POST['client-address']);
    if (preg_match('/^[a-zA-ZęóąśłżźćńĘÓĄŚŁŻŹĆŃ]+$/', $name) && preg_match('/^[a-zA-ZęóąśłżźćńĘÓĄŚŁŻŹĆŃ]+$/', $surname)) {
        require_once "connect.php";
        $conn = sqlsrv_connect($serverName, $connectionOptions);
        if (!$conn) {
            $error = true;
            $msg = 'Błąd połączenia z bazą danych';
        } else {
            $query = "EXEC dodajKlienta @imie='$name', @nazwisko='$surname',@adres='$address'";
            $result = sqlsrv_query($conn, $query);
            $affected_rows = sqlsrv_rows_affected($result);
            if ($affected_rows == 1) {
                $msg = "Dodano do bazy";
            } else {
                $error = true;
                $msg = "Podaj dane klienta";
            }
            sqlsrv_close($conn);
        }
    } else {
        $msg = "Podaj poprawne imię i nazwisko";
        $error = true;
    }
}
$array = [$error, $msg];
echo json_encode($array);
