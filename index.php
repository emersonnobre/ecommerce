<?php 

require_once("vendor/autoload.php");

$app = new \Slim\Slim();

$app->config('debug', true);

$app->get('/', function() {
    
	$sql = new Hcode\DB\Sql();
	$results = $sql->select("select * from tb_persons");
	echo json_encode($results);

});

$app->run();


?>