<?php 

require_once("vendor/autoload.php");

use \Slim\Slim;
use \Hcode\Page;
use\Hcode\PageAdmin;
use \Hcode\Model\User;
use \Hcode\DB\Sql;

$app = new Slim();

$app->config('debug', true);

$app->get('/', function() {
    
	$page = new Page();
	$page->setTpl("index");

});

$app->get('/admin', function() {
    
	$page = new PageAdmin();
	$page->setTpl("index");

});

$app->get('/admin/login', function() {
    
	$page = new PageAdmin($opts = [
		'header'=>false,
		'footer'=>false
	]);
	$page->setTpl("login");

});

$app->post('/admin/login', function() {

	User::login($_POST["login"], $_POST["password"]);

	header("Location: /admin");
	exit;

});

$app->get('/admin/inserir', function() {

	$sql = new Sql();
	$data = date('Y-m-d');
	define('SECRET_IV', pack('a16', 'acesso'));
	define('SECRET', pack('a16', 'acesso'));
	$senha = 'oi';
	$openssl = openssl_encrypt(
		$senha,
		'AES-128-CBC',
		SECRET,
		0,
		SECRET_IV
	);

	$sql->query("insert into tb_users values (3, 3, 'biel', :OPEN, 0,  :DATA)", array(
		':OPEN'=>$openssl,
		':DATA'=>$data
	));

});

$app->run();


?>