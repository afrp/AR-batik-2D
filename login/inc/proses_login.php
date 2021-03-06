<?php
session_start();
require("PasswordHash.php");


$db_host = 'localhost';
$db_port = 3306;
$db_user = 'root';
$db_pass = '';
$db_name = 'batik_id';

$hash_cost_log2 = 8;
// Do we require the hashes to be portable to older systems (less secure)?
$hash_portable = FALSE;

// Are we debugging this code?  If enabled, OK to leak server setup details.
$debug = TRUE;

function fail($pub, $pvt = '')
{
	global $debug;
	$msg = $pub;
	if ($debug && $pvt !== '')
		$msg .= ": $pvt";
/* The $pvt debugging messages may contain characters that would need to be
 * quoted if we were producing HTML output, like we would be in a real app,
 * but we're using text/plain here.  Also, $debug is meant to be disabled on
 * a "production install" to avoid leaking server setup details. */
	exit("An error occurred ($msg).\n");
}

function get_post_var($var)
{
	$val = $_POST[$var];
	if (get_magic_quotes_gpc())
		$val = stripslashes($val);
	return $val;
}

//header('Content-Type: text/plain');

$user = get_post_var('username');
/* Sanity-check the username, don't rely on our use of prepared statements
 * alone to prevent attacks on the SQL server via malicious usernames. */
if (!preg_match('/^[a-zA-Z0-9_]{1,60}$/', $user))
	fail('Invalid username');

$pass = get_post_var('password');
/* Don't let them spend more of our CPU time than we were willing to.
 * Besides, bcrypt happens to use the first 72 characters only anyway. */
if (strlen($pass) > 72)
	fail('The supplied password is too long');

$db = new mysqli($db_host, $db_user, $db_pass, $db_name);
if (mysqli_connect_errno())
	fail('MySQL connect', mysqli_connect_error());

$hasher = new PasswordHash($hash_cost_log2, $hash_portable);


	$hash = '*'; // In case the user is not found
	($stmt = $db->prepare('select password from tb_admin where username=?'))
		|| fail('MySQL prepare', $db->error);
	$stmt->bind_param('s', $user)
		|| fail('MySQL bind_param', $db->error);
	$stmt->execute()
		|| fail('MySQL execute', $db->error);
	$stmt->bind_result($hash)
		|| fail('MySQL bind_result', $db->error);
	if (!$stmt->fetch() && $db->errno)
		fail('MySQL fetch', $db->error);

	if ($hasher->CheckPassword($pass, $hash)) {
			//header("Location: index.php");
			echo "<META HTTP-EQUIV='Refresh' Content='0; URL=../admin/index.php'>";
			
			$_SESSION['username']=$user;
			$_SESSION['login']=1;
	} else {
		echo '<script>alert("Password anda tidak match");</script>';
 		echo "<META HTTP-EQUIV='Refresh' Content='0; URL=../login.php'>";
	}

?>