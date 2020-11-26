<?php
/*
 * DB Class
 * This class is used for database related (connect, insert, update, and delete) operations
 * @author	CodexWorld.com
 * @url		http://www.codexworld.com
 * @license	http://www.codexworld.com/license
 */
class DB{
	private $dbHost     = "localhost";
	private $dbUsername = "root";
	private $dbPassword = "";
	private $dbName     = "batik_id";
	
	public function __construct(){
		if(!isset($this->db)){
			// Connect to the database
			$conn = new mysqli($this->dbHost, $this->dbUsername, $this->dbPassword, $this->dbName);
			if($conn->connect_error){
				die("Failed to connect with MySQL: " . $conn->connect_error);
			}else{
				$this->db = $conn;
			}
		}
	}
    
	/*
	 * Returns rows from the database based on the conditions
	 * @param string name of the table
	 * @param array select, where, order_by, limit and return_type conditions
	 */
	public function getRows($table,$conditions = array()){
		$sql = 'SELECT ';
		$sql .= array_key_exists("select",$conditions)?$conditions['select']:'*';
		$sql .= ' FROM '.$table;
		if(array_key_exists("where",$conditions)){
			$sql .= ' WHERE ';
			$i = 0;
			foreach($conditions['where'] as $key => $value){
				$pre = ($i > 0)?' AND ':'';
				$sql .= $pre.$key." = '".$value."'";
				$i++;
			}
		}
		
		if(array_key_exists("order_by",$conditions)){
			$sql .= ' ORDER BY '.$conditions['order_by']; 
		}
		
		if(array_key_exists("start",$conditions) && array_key_exists("limit",$conditions)){
			$sql .= ' LIMIT '.$conditions['start'].','.$conditions['limit']; 
		}elseif(!array_key_exists("start",$conditions) && array_key_exists("limit",$conditions)){
			$sql .= ' LIMIT '.$conditions['limit']; 
		}
		
		$result = $this->db->query($sql);
		
		if(array_key_exists("return_type",$conditions) && $conditions['return_type'] != 'all'){
			switch($conditions['return_type']){
				case 'count':
					$data = $result->num_rows;
					break;
				case 'single':
					$data = $result->fetch_assoc();
					break;
				default:
					$data = '';
			}
		}else{
			if($result->num_rows > 0){
				while($row = $result->fetch_assoc()){
					$data[] = $row;
				}
			}
		}
		return !empty($data)?$data:false;
	}
	
	/*
	 * Insert data into the database
	 * @param string name of the table
	 * @param array the data for inserting into the table
	 */
	public function insert($table,$data){
		if(!empty($data) && is_array($data)){
			$columns = '';
			$values  = '';
			$i = 0;
			if(!array_key_exists('created',$data)){
				$data['created'] = date("Y-m-d H:i:s");
			}
			if(!array_key_exists('modified',$data)){
				$data['modified'] = date("Y-m-d H:i:s");
			}
			foreach($data as $key=>$val){
				$pre = ($i > 0)?', ':'';
				$columns .= $pre.$key;
				$values  .= $pre."'".$val."'";
				$i++;
			}
			$query = "INSERT INTO ".$table." (".$columns.") VALUES (".$values.")";
			$insert = $this->db->query($query);
			return $insert?$this->db->insert_id:false;
		}else{
			return false;
		}
	}
	
	/*
	 * Update data into the database
	 * @param string name of the table
	 * @param array the data for updating into the table
	 * @param array where condition on updating data
	 */
	public function update($table,$data,$conditions){
		if(!empty($data) && is_array($data)){
			$colvalSet = '';
			$whereSql = '';
			$i = 0;
			if(!array_key_exists('modified',$data)){
				$data['modified'] = date("Y-m-d H:i:s");
			}
			foreach($data as $key=>$val){
				$pre = ($i > 0)?', ':'';
				$colvalSet .= $pre.$key."='".$val."'";
				$i++;
			}
			if(!empty($conditions)&& is_array($conditions)){
				$whereSql .= ' WHERE ';
				$i = 0;
				foreach($conditions as $key => $value){
					$pre = ($i > 0)?' AND ':'';
					$whereSql .= $pre.$key." = '".$value."'";
					$i++;
				}
			}
			$query = "UPDATE ".$table." SET ".$colvalSet.$whereSql;
			$update = $this->db->query($query);
			return $update?$this->db->affected_rows:false;
		}else{
			return false;
		}
	}
	
	/*
	 * Delete data from the database
	 * @param string name of the table
	 * @param array where condition on deleting data
	 */
	public function delete($table,$conditions){
		$whereSql = '';
		if(!empty($conditions)&& is_array($conditions)){
			$whereSql .= ' WHERE ';
			$i = 0;
			foreach($conditions as $key => $value){
				$pre = ($i > 0)?' AND ':'';
				$whereSql .= $pre.$key." = '".$value."'";
				$i++;
			}
		}
		$query = "DELETE FROM ".$table.$whereSql;
		$delete = $this->db->query($query);
		return $delete?true:false;
	}
	public function take($table){
		$query = "select max(id_batik) as kode from ".$table;
		$rantai = $this->db->query($query);
		$cari = $rantai->fetch_assoc();
		return $cari;
}
	public function cekPass($tblAran,$username){
		

		$query="select password from ".$tblAran." where username='$username'" ;
		$pas = $this->db->query($query);
		$hasil = $pas->fetch_assoc();
		return $hasil;
	}
	public function gantiadm($tblAran,$hash,$username){
		$query="UPDATE ".$tblAran." set password='$hash' where username='$username'";
		$pas= $this->db->query($query);
		return $pas?true:false;
	}
	/*public function gambar_in($tblAran,$caption,$image_cap){
		$query="INSERT INTO ".$tblAran." ";
		$pas= $this->db->query($query);
		return $pas?true:false;
	}*/
}

class barcodeQR {
	/**
	 * Chart API URL
	 */
	const API_CHART_URL = "http://chart.apis.google.com/chart";

	/**
	 * Code data
	 *
	 * @var string $_data
	 */
	private $_data;

	/**
	 * Bookmark code
	 *
	 * @param string $title
	 * @param string $url
	 */
	public function bookmark($title = null, $url = null) {
		$this->_data = "MEBKM:TITLE:{$title};URL:{$url};;";
	}

	/**
	 * MECARD code
	 *
	 * @param string $name
	 * @param string $address
	 * @param string $phone
	 * @param string $email
	 */
	public function contact($name = null, $address = null, $phone = null, $email = null) {
		$this->_data = "MECARD:N:{$name};ADR:{$address};TEL:{$phone};EMAIL:{$email};;";
	}

	/**
	 * Create code with GIF, JPG, etc.
	 *
	 * @param string $type
	 * @param string $size
	 * @param string $content
	 */
	public function content($type = null, $size = null, $content = null) {
		$this->_data = "CNTS:TYPE:{$type};LNG:{$size};BODY:{$content};;";
	}

	/**
	 * Generate QR code image
	 *
	 * @param int $size
	 * @param string $filename
	 * @return bool
	 */
	public function draw($size = 150, $filename = null) {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, self::API_CHART_URL);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, "chs={$size}x{$size}&cht=qr&chl=" . urlencode($this->_data));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_TIMEOUT, 30);
		$img = curl_exec($ch);
		curl_close($ch);

		if($img) {
			if($filename) {
				if(!preg_match("#\.png$#i", $filename)) {
					$filename .= ".png";
				}
				
				return file_put_contents($filename, $img);
			} else {
				header("Content-type: image/png");
				print $img;
				return true;
			}
		}

		return false;
	}

	/**
	 * Email address code
	 *
	 * @param string $email
	 * @param string $subject
	 * @param string $message
	 */
	public function email($email = null, $subject = null, $message = null) {
		$this->_data = "MATMSG:TO:{$email};SUB:{$subject};BODY:{$message};;";
	}

	/**
	 * Geo location code
	 *
	 * @param string $lat
	 * @param string $lon
	 * @param string $height
	 */
	public function geo($lat = null, $lon = null, $height = null) {
		$this->_data = "GEO:{$lat},{$lon},{$height}";
	}

	/**
	 * Telephone number code
	 *
	 * @param string $phone
	 */
	public function phone($phone = null) {
		$this->_data = "TEL:{$phone}";
	}

	/**
	 * SMS code
	 *
	 * @param string $phone
	 * @param string $text
	 */
	public function sms($phone = null, $text = null) {
		$this->_data = "SMSTO:{$phone}:{$text}";
	}

	/**
	 * Text code
	 *
	 * @param string $text
	 */
	public function text($text = null) {
		$this->_data = $text;
	}

	/**
	 * URL code
	 *
	 * @param string $url
	 */
	public function url($url = null) {
		$this->_data = preg_match("#^https?\:\/\/#", $url) ? $url : "http://{$url}";
	}

	/**
	 * Wifi code
	 *
	 * @param string $type
	 * @param string $ssid
	 * @param string $password
	 */
	public function wifi($type = null, $ssid = null, $password = null) {
		$this->_data = "WIFI:S:{$ssid};T:{$type};P:{$password};;";
	}
}
?>