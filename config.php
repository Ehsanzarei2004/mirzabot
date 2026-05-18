<?php
$request_exec_timeout = null;

// --- مشخصات دیتابیس ریلوای شما ---
$dbhost_name = 'ballast.proxy.rlwy.net';
$dbport = 42935;
$dbname = 'railway';
$usernamedb = 'root';
$passworddb = 'LDAZSTdTYoqcZqmCrJDXkWDCzYmXxsZO';

$connect = mysqli_connect($dbhost_name, $usernamedb, $passworddb, $dbname, $dbport);
if ($connect->connect_error) { die("error" . $connect->connect_error); }
mysqli_set_charset($connect, "utf8mb4");

$options = [ 
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, 
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, 
    PDO::ATTR_EMULATE_PREPARES => false, 
];
$dsn = "mysql:host=$dbhost_name;port=$dbport;dbname=$dbname;charset=utf8mb4";
try { 
    $pdo = new PDO($dsn, $usernamedb, $passworddb, $options); 
} catch (\PDOException $e) { 
    error_log("Database connection failed: " . $e->getMessage()); 
}

// ساخت تمام جداول مورد نیاز میرزا پنل به صورت خودکار
try {
    $pdo->exec("CREATE TABLE IF NOT EXISTS `user` (`id` bigint(20) NOT NULL, `step` varchar(255) DEFAULT 'none', `status` varchar(50) DEFAULT 'user', `banned` varchar(10) DEFAULT 'false', PRIMARY KEY (`id`)) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");
    $pdo->exec("CREATE TABLE IF NOT EXISTS `setting` (`id` int(11) NOT NULL AUTO_INCREMENT, `keys` varchar(255) DEFAULT NULL, `value` text DEFAULT NULL, PRIMARY KEY (`id`)) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");
    $pdo->exec("CREATE TABLE IF NOT EXISTS `server` (`id` int(11) NOT NULL AUTO_INCREMENT, `name` varchar(255) DEFAULT NULL, `ip` varchar(255) DEFAULT NULL, `password` varchar(255) DEFAULT NULL, PRIMARY KEY (`id`)) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");
} catch (\PDOException $e) {}

// --- مشخصات ربات و ادمین ---
$APIKEY = '8896976190:AAHxJEwAELLoPsRB5e4ofwSBbBfasBevpF4';
$adminnumber = '6854510555'; // 👈 حتماً چک کن این آیدی خودت باشه
$domainhosts = 'Mirzabot-production.up.railway.app';
$usernamebot = 'Pmoiranbot';
?>
