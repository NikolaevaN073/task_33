<?php

namespace App\Core;

use App\Core\Model;
use App\Core\View;

class Controller 
{
	public $model;
	public $view;
	
	function __construct()
	{		
		$this->model = new Model(ClassName::class);
		$this->view = new View;		
	}

	function action_index()
	{
		
	}
}
