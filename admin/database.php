<?php
function mysqli_result($result, $row, $field = 0) {
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

// Parse Heroku DATABASE_URL environment variable
$dbUrl = getenv("DATABASE_URL");
if (!$dbUrl) {
    die("DATABASE_URL environment variable not set or empty.");
}

$dbConfig = parse_url($dbUrl);

// Debug bilgilerini log'layın
error_log("Host: " . $dbConfig["host"]);
error_log("User: " . $dbConfig["user"]);
error_log("Password: " . $dbConfig["pass"]);
error_log("Database Name: " . substr($dbConfig["path"], 1));

$host = $dbConfig["host"] ?? 'default_host';
$username = $dbConfig["user"] ?? 'default_user';
$password = $dbConfig["pass"] ?? 'default_password';
$database = substr($dbConfig["path"], 1) ?? 'default_database';

$db = mysqli_connect($host, $username, $password, $database);

if (!$db) {
    error_log("MySQL Connection Error: " . mysqli_connect_error());
    die("Failed to connect to MySQL: " . mysqli_connect_error());
}


$host = $dbConfig["host"];
$username = $dbConfig["user"];
$password = $dbConfig["pass"];
$database = substr($dbConfig["path"], 1);  // Remove the leading slash

$db = mysqli_connect($host, $username, $password, $database);

if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
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
