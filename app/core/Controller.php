<?php declare(strict_types=1);

class Controller{
	private $model;
	private $view;
	private $input=[];
	private $method='';
	private $sortIndex=[];
	private $params=[];
	
	public function __construct(){  ### this metod cannot be private
		
		### this code handles whatever input is received from the user
		$this->input=$this->parseInput(); ### the method parseInput grabs the input, sanitizes it and returns an array of method and any params
		$this->method=$this->input[0];
		unset($this->input[0]);
		$this->params=$this->input?array_values($this->input):[];###if the array is not null, array_values re-bases the array to zero for the method strings that have already been unset (line 16); otherwise, it returns an empty array
		
		### the Model must be instantiated *before* the call to functions which rely on the Model's methods.
		require_once 'wp-content/plugins/a2-oop-plugin/app/core/Model.php';
		$this->model=new Model;	
		
		if($this->method=='sortUser'){
			$output=call_user_func_array([$this, $this->method], [$this->params]); ### note that $this->params is an array
		}else{
			### this calls a method according to what has been received from the user
			if($this->method!='')call_user_func_array([$this, $this->method], $this->params);
			
			### this is called to dislay the results of the previous method sorted by dob - unless the previous method was sortUser
			$output=$this->model->getAllUsers();
		}
		
		### if the View is instantiated at the end of the __construct() method, the user sees the results straight away (rather than having to refresh)
		require_once 'wp-content/plugins/a2-oop-plugin/app/core/View.php';
		$this->view=new View($output);
	}
	
	
	private function createUser($fn,$ln,$dob){	### these methods can be private and the instantiation $this->model is private
		$this->model->setUser($fn,$ln,$dob);
	}
	
	private function deleteUser($id){
		$this->model->dropUser($id);
	}
	
	private function sortUser($arg=[]){		
		$result=$this->model->sortAndGetUsers($arg);
		return $result;
	}
	
	private function parseInput(){
		$this->input=do_shortcode('[urlparam param="input"]');
		//echo'<br>The result of $_GET[\'url\'] is '.$_GET['url'].'<br>';
		//echo'<br>The result of do_shortcode(\'[urlparam param=\"input\"]\') is '.$this->input.'<br>';
		//echo'<br>The result of $_SERVER[\'REQUEST_URI\'] is '.$_SERVER['REQUEST_URI'].'<br>';

		if(isset($this->input)){
			$this->input=filter_var($this->input,FILTER_SANITIZE_STRING); ###sanitise the string that has been passed
			$this->input=EXPLODE(',',$this->input);
			return $this->input;
		}
	}
	
	
}