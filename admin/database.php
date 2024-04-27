<?php
// DATABASE_URL ortam değişkenini al
$dbUrl = getenv("DATABASE_URL");
if (!$dbUrl) {
    die("Database connection URL not provided.");
}

// URL'yi ayrıştır
$dbParts = parse_url($dbUrl);

$host = $dbParts['host'];
$port = $dbParts['port'];
$user = $dbParts['user'];
$password = $dbParts['pass'];
$dbname = ltrim($dbParts['path'], '/');  // Başındaki '/' karakterini kaldır

// DSN (Data Source Name) string
$dsn = "pgsql:host=$host;port=$port;dbname=$dbname";

try {
    // PDO ile PostgreSQL'e bağlan
    $pdo = new PDO($dsn, $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Could not connect to the database: " . $e->getMessage());
}

function pg_result($stmt, $row, $field = 0) {
    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_BOTH);
    if (empty($data) || $row >= count($data)) return false;
    if (is_string($field)) {
        $field = array_search($field, array_column($stmt->fetchAll(PDO::FETCH_ASSOC), null, 'name'));
    }
    return isset($data[$row][$field]) ? $data[$row][$field] : false;
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
        return htmlspecialchars(alt_replace(addslashes(trim(@$_POST[$par]))));
    } else {
        return addslashes(alt_replace(trim(@$_POST[$par])));
    }
}

function g($par) {
    return strip_tags(alt_replace(trim(addslashes(@$_GET[$par]))));
}
?>
