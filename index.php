
<?php 
require __DIR__ . '/vendor/autoload.php';
use \Slim\App;
 
$app = new App();
  
//run App
$app->run();

 
// Mengkonfigurasi Server dan database kita
$dbhost = '127.0.0.1';
$dbuser = 'root';
$dbpass = '';
$dbname = 'makanan';
$dbmethod = 'mysql:dbname=';
 
$dsn = $dbmethod.$dbname;
$pdo = new PDO($dsn, $dbuser, $dbpass);
$db  = new NotORM($pdo);
 
$app-> get('/', function(){
    echo "API Makanan";
});
 
$app ->get('/menu', function() use($app, $db){
	$makanan["error"] = false;
	$makanan["message"] = "Berhasil mendapatkan data dosen";
    foreach($db->menu() as $data){
        $dosen['semuadosen'][] = array(
            'no' => $data['no'],
            'nama' => $data['nama']
            );
    }
    echo json_encode($makanan);
});
 
$app->run();