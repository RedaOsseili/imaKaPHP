<?php

include('config.php');
include('library/Requests.php');
Requests::register_autoloader();

class IK_PHP {

	

	public function all($tableName){
		include('auth_process.php');
		$response = $this->sendGetRequest($url,$headers);
		return $response;
		//RESULT STORED IN response.body.result
		//CODE STATUS STORED IN response.status_code
	}

	public function getBy($tableName, $columnName, $columnValue){
		//?sysparm_query=sys_id=9c573169c611228700193229fff72400';
		include('auth_process.php');
		$url = $url . '?sysparm_query=' . $columnName . 'IS' . $columnValue;
		$response = $this->sendGetRequest($url,$headers);
		return $response;
	}

	public function where($tableName, $columnName, $operator, $columnValue){
		include('auth_process.php');
		$url = $url . '?sysparm_query=' . $columnName . $this->transformOperator($operator) . $columnValue;
		$response = $this->sendGetRequest($url,$headers);
		return $response;
	}


	public function insert($tableName,$object) {
		include('auth_process.php');
		$response = $this->sendPostRequest($url,$headers,$object);
		return $response;
	}

	public function update($tableName,$sys_id,$object) {
		include('auth_process.php');
		$response = $this->sendPutRequest($url,$headers,$object);
		return $response;
	}

	public function delete($tableName,$sys_id) {
		include('auth_process.php');
		$response = $this->sendDeleteRequest($url,$headers);
		return $response;
	}


	// SEND REQUESTS FUNCTIONS

	public function sendPostRequest($url,$headers,$object){
		$response = Requests::post($url, $headers, $object);
		return $response;
	}

	public function sendGetRequest($url,$headers){
		$response = Requests::get($url, $headers);
		return $response;
	}

	public function sendDeleteRequest($url,$headers){
		$response = Requests::delete($url, $headers);
		return $response;
	}

	public function sendPutRequest($url,$headers,$object){
		$response = Requests::put($url, $headers, $object);
		return $response;
	}

	public function sendPatchRequest($url,$headers,$object){
		$response = Requests::patch($url, $headers, $object);
		return $response;
	}


	
	// OPERATORS FUNCTION 

	public function transformOperator($operator){
		switch (strtoupper($operator)) {
			case 'BETWEEN':
				return 'BETWEEN'; //2@4
				break;
			case '!=':
				return 'ISNOT';
				break;
			case '*':
				return 'CONTAINS';
				break;
			case '*_':
				return 'STARTSWITH';
				break;
			case '!*':
				return 'NOT LIKE';
				break;
			default:
				return $operator;
				break;

			/* >, <, <=, >= are default cases */
		}
	}






}


?>