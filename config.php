<?php
$request_exec_timeout = null;

// --- مشخصات دیتابیس ریلوای ---
$dbhost_name = 'ballast.proxy.rlwy.net';
$dbport = 42935;
$dbname = 'railway';
$usernamedb = 'root';
$passworddb = 'LDAZSTdTYoqcZqmCrJDXkWDCzYmXxsZO';

$dbhost = $dbhost_name . ':' . $dbport;

// اتصال mysqli
$connect = mysqli_connect($dbhost_name, $usernamedb, $passworddb, $dbname, $dbport);
if ($connect->connect_error) { die("error" . $connect->connect_error); }
mysqli_set_charset($connect, "utf8mb4");

// اتصال PDO
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

// --- جیگرکی: ساخت خودکار جدول کاربران اگر وجود نداشته باشد ---
// این بخش جلو کرش کردن کد رو به خاطر خالی بودن دیتابیس می‌گیره
try {
    $pdo->exec("CREATE TABLE IF NOT EXISTS `user` (
        `id` bigint(20) NOT NULL,
        `step` varchar(255) DEFAULT 'none',
        `status` varchar(50) DEFAULT 'user',
        PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");
} catch (\PDOException $e) {
    error_log("Table creation failed: " . $e->getMessage());
}

// --- مشخصات ربات و ادمین ---
$APIKEY = '8896976190:AAHxJEwAELLoPsRB5e4ofwSBbBfasBevpF4';
$adminnumber = '6854510555';
$domainhosts = 'Mirzabot-production.up.railway.app';
$usernamebot = 'Pmoiranbot';

?>
