<?php
	/**
	 * Created by PhpStorm.
	 * User: vipvi_mc4
	 * Date: 24.12.2018
	 * Time: 12:24
	 */
	
	namespace app\models;
	
	
	use app\core\Model;
	
	class worker extends Model
	{
		
		const id = 'id';
		const organizations_id = 'organizations_id';
		
		public static function tableName()
		{
			return 'workers';
		}
		
		
	}