<?php

namespace App\Model;

abstract class ConfigDb

{
	public $host = 'mysql.seguidor.com.br';
	public $usuario = 'seguidor';
	public $senha = '33jps665';
	public $db = 'seguidor';

	public function __construct()
	{
	}
}
