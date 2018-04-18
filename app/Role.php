<?php 

namespace App;

class Role 
{
	// @ToDo: create cud for role
	public static function all() 
	{
		return [
			'admin' => 'Адмiнiстратор',
			'superadmin' => 'Суперадмiн',
		];
	}
}