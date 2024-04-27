<?php
// DATABASE_URL ortam değişkenini al
$dbUrl = getenv("DATABASE_URL");
if (!$dbUrl) {
    // Eğer ortam değişkeni set edilmemişse, doğrudan sabit URL'yi kullan
    $dbUrl = "mysql://e8778w8bqxpc64g0:ckshcs7m8iqm9qrf@fojvtycq53b2f2kx.chr7pe7iynqr.eu-west-1.rds.amazonaws.com:3306/punvx4pkk1xqbqmb";
}

// URL'yi ayrıştır
$dbParts = parse_url($dbUrl);

$host = $dbParts['host'];
$user = $dbParts['user'];
$password = $dbParts['pass'];
$port = $dbParts['port'];
$dbname = substr($dbParts['path'], 1); // Başındaki '/' karakterini kaldır

// MySQL'e bağlan
$conn = new mysqli($host, $user, $password, $dbname, $port);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function mysqli_result($result, $row, $field=0) {
    if ($result === false) return false;
    if ($row >= mysqli_num_rows($result)) return false;
    if (is_string($field) && !(strpos($field, ".") === false)) {
        $t_field = explode(".", $field);
        $field = -1;
        $t_fields = mysqli_fetch_fields($result);
        for ($id = 0; $id < mysqli_num_fields($result); $id++) {
            if ($t_fields[$id]->table == $t_field[0] && $t_fields[$id]->name == $t_field[1]) {
                $field = $id;
                break;
            }
        }
        if ($field == -1) return false;
    }
    mysqli_data_seek($result, $row);
    $line = mysqli_fetch_array($result);
    return isset($line[$field]) ? $line[$field] : false;
}

function alt_replace($string) {
    $search = array(
        chr(0xC2) . chr(0xA0),
        chr(0xC2) . chr(0x90),
        chr(0xC2) . chr(0x9D),
        chr(0xC2) . chr(0x81),
        chr(0xC2) . chr(0x8D),
        chr(0xC2) . chr(0x8F),
        chr(0xC2) . chr(0xAD),
        chr(0xAD)
    );
    $string = str_replace($search, '', $string);
    return trim($string);
}

function p($par, $st = false) {
    if ($st) {
        return htmlspecialchars(alt_replace(addslashes(trim($_POST[$par]))));
    } else {
        return addslashes(alt_replace(trim($_POST[$par])));
    }
}

function g($par) {
    return strip_tags(alt_replace(trim(addslashes($_GET[$par]))));
}
?>
