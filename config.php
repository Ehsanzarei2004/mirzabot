<?php
// This variable added for high load panels which their response time is long and bot can't communicate with online panel!
// null for default settings
$request_exec_timeout = null;

// --- مشخصات دیتابیس ریلوای شما طبق عکس ---
$dbhost = 'ballast.proxy.rlwy.net:42935';
$dbname = 'railway';
$usernamedb = 'root';
$passworddb = 'LDAZSTdTYoqcZqmCrJDXkWDCzYmXxsZO';

// --- اتصال به دیتابیس ---
$connect = mysqli_connect($dbhost, $usernamedb, $passworddb, $dbname);
if ($connect->connect_error) { die("error" . $connect->connect_error); }
mysqli_set_charset($connect, "utf8mb4");
$options = [ PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, PDO::ATTR_EMULATE_PREPARES => false, ];
$dsn = "mysql:host=$dbhost;dbname=$dbname;charset=utf8mb4";
try { $pdo = new PDO($dsn, $usernamedb, $passworddb, $options); } catch (\PDOException $e) { error_log("Database connection failed: " . $e->getMessage()); }

// --- مشخصات ربات و ادمین ---
$APIKEY = '8896976190:AAHxJEwAELLoPsRB5e4ofwSBbBfasBevpF4';
$adminnumber = '6854510555';
$domainhosts = 'botmirzapanel-production.up.railway.app';
$usernamebot = 'Pmoiranbot';

?>
