<?php

class Connection
{

	private $server = "mysql:host=localhost;dbname=db_minera3H";
	private $username = "root";
	private $password = "";
	private $options  = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8");
	protected $conn;

	public function open()
	{
		try {
			$this->conn = new PDO($this->server, $this->username, $this->password, $this->options);
			return $this->conn;
		} catch (PDOException $e) {
			echo "There is some problem in connection: " . $e->getMessage();
		}
	}

	public function close()
	{
		$this->conn = null;
	}
}


//session start
session_start();

if (!isset($_SESSION['uname'])) {
	header("Location: ../../login.php");
}

// 

$host = "localhost"; /* Host name */
$user = "root"; /* User */
$password = ""; /* Password */
$dbname = "db_minera3H"; /* Database name */

$con = mysqli_connect($host, $user, $password, $dbname);
$con->set_charset("utf8");
// Check connection
if (!$con) {
	die("Connection failed: " . mysqli_connect_error());
}


function connect()
{
	$hostname = 'localhost';
	$name = 'db_minera3H';
	$user = 'root';
	$password = '';
	return new PDO('mysql:host=' . $hostname . ';dbname=' . $name, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
}

/*$mysqli = new mysqli("localhost", "root", "", "db_minera3H");
$mysqli -> set_charset("utf8");

if (mysqli_connect_errno()) {
	echo 'Conexion fallida: ', mysqli_connect_errno();
	exit();
}
*/
$mysqli = new mysqli("localhost", "root", "", "db_minera3H");
$mysqli->set_charset("utf8");
if ($mysqli->connect_errno) {
	echo "Fallo al conectar a MySQL:(" . $mysqli->connect_errno . ")" . $mysqli->connect_errno;
}
