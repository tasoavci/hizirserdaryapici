<?php
$dbUrl = getenv("DATABASE_URL");
if (!$dbUrl) {

    // $dbUrl = "mysql://gp43ixfvps2viigy:xhahjjjpzn8n0j3v@fojvtycq53b2f2kx.chr7pe7iynqr.eu-west-1.rds.amazonaws.com:3306/eu85oartlozlppxf";
    // $dbUrl = "mysql://dxhsndkj93qjk36n:vciys0zzkdrl2x64@vlvlnl1grfzh34vj.chr7pe7iynqr.eu-west-1.rds.amazonaws.com:3306/m16a7q4c10a8u94m";
    // $dbUrl = "mysql://hd1c4i7ydqviunfq:jlojzcrfdftbjemd@zpfp07ebhm2zgmrm.chr7pe7iynqr.eu-west-1.rds.amazonaws.com:3306/pyggrhqu9rh1kqbt";
    $dbUrl = "mysql://baboex4s3m8cv61a:nvzs8sva818l5rvc@e7qyahb3d90mletd.chr7pe7iynqr.eu-west-1.rds.amazonaws.com:3306/yb7rnql98qcrhj0c";
}

// URL'yi ayrıştır
$dbParts = parse_url($dbUrl);

$host = $dbParts['host'];
$user = $dbParts['user'];
$password = $dbParts['pass'];
$port = $dbParts['port'];
$dbname = substr($dbParts['path'], 1); 


$db = new mysqli($host, $user, $password, $dbname, $port);

if ($db->connect_error) {
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
