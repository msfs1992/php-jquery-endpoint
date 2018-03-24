<?php 
header("Content-Type:application/json");
class Response{
	public $Result;
	public $Status;
}
class Endpoint{
	private $request;
	private $value1;
	private $value2;
	private $op;
	private $response;

	public function __construct($data){
		$this->response = new Response();
		$this->request = $data;
		$this->value1 = $this->request["values"][0];
		$this->value2 = $this->request["values"][1];
		$this->op = $this->request["operation"];
		$this->response->Status = "Ok";
	}

	public function errorHandler(){
		$this->response->Status = "Error";
		echo json_encode($this->response);
	}

	public function calc(){
		switch ($this->op) {
		    case "sum":
		        return $this->value1 + $this->value2;
		        break;
		    case "substraction":
		        return $this->value1 - $this->value2;
		        break;
		    case "division":
		        return $this->value1 / $this->value2;
		        break;
		    case "multiplication":
		        return $this->value1 * $this->value2;
		        break;
		}
		
	}

	public function getResult(){
		$this->response->Result = $this->calc();
		echo json_encode($this->response);
	}
	
}

$ep = new Endpoint($_POST);
try{
	$ep->getResult();
}catch(Exception $e){
	$ep->errorHandler();
}

?>