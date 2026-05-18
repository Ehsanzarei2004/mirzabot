<?php
$request_exec_timeout = null;

// --- اتصال به دیتابیس ریلوای از طریق شبکه عمومی (چون دو پروژه جدا هستند) ---
$dbhost = 'ballast.proxy.rlwy.net:42935'; 
$dbname = 'railway';
$usernamedb = 'root';
$passworddb = 'LDAZSTdTYoqcZqmCrJDXkWDCzYmXxsZO';

// تفکیک آدرس و پورت برای سازگاری کامل با PDO و MySQLi
$dbhost_name = 'ballast.proxy.rlwy.net';
$dbport = 42935;

$connect = mysqli_connect($dbhost_name, $usernamedb, $passworddb, $dbname, $dbport);
if ($connect->connect_error) { die("error" . $connect->connect_error); }
mysqli_set_charset($connect, "utf8mb4");

$options = [ PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, PDO::ATTR_EMULATE_PREPARES => false, ];
$dsn = "mysql:host=$dbhost_name;port=$dbport;dbname=$dbname;charset=utf8mb4";
try { $pdo = new PDO($dsn, $usernamedb, $passworddb, $options); } catch (\PDOException $e) { error_log("Database connection failed: " . $e->getMessage()); }

// --- مشخصات ربات و ادمین ---
$APIKEY = '8896976190:AAHxJEwAELLoPsRB5e4ofwSBbBfasBevpF4';
$adminnumber = '6854510555';
$domainhosts = 'botmirzapanel-production.up.railway.app';
$usernamebot = 'Pmoiranbot';

?>
