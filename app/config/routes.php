<?php
<<<<<<< HEAD
 return [
	 ''=>[
		 'controller'=>'main',
		 'action'=>'index',
	 ],
	 'main/login'=>[
		 'controller'=>'main',
		 'action'=>'login',
	 ],
	 'main/logout'=>[
		 'controller'=>'main',
		 'action'=>'logout',
	 ],
	 'main/organization'=>[
		 'controller'=>'main',
		 'action'=>'organization',
	 ],
	 'worker/information'=>[
		 'controller'=>'worker',
		 'action'=>'information',
	 ],
	 
	 'admin/organization/view'=>[
		 'controller'=>'admin',
		 'action'=>'view',
	 ],
	 'admin/worker/view'=>[
		 'controller'=>'admin',
		 'action'=>'workerView',
	 ],
	 'admin/organization/delete'=>[
		 'controller'=>'admin',
		 'action'=>'delete',
	 ],
	
	 'admin/organization'=>[
		 'controller'=>'admin',
		 'action'=>'organization',
	 ],
	
	 'admin/xml'=>[
		 'controller'=>'admin',
		 'action'=>'xml',
	 ],
 ];
=======
	return [
		'' => [
			'controller' => 'main',
			'action' => 'index',
		],
		'main/login' => [
			'controller' => 'main',
			'action' => 'login',
		],
		'main/logout' => [
			'controller' => 'main',
			'action' => 'logout',
		],
		'main/organization' => [
			'controller' => 'main',
			'action' => 'organization',
		],
		'worker/information' => [
			'controller' => 'worker',
			'action' => 'information',
		],
		
		'admin/worker' => [
			'controller' => 'workers',
			'action' => 'index',
		],
		'admin/worker/view' => [
			'controller' => 'workers',
			'action' => 'view',
		],
		'admin/worker/update' => [
			'controller' => 'workers',
			'action' => 'update',
		],
		'admin/worker/delete' => [
			'controller' => 'workers',
			'action' => 'delete',
		],
		'admin/worker/create' => [
			'controller' => 'workers',
			'action' => 'create',
		],
		
		'admin/organization' => [
			'controller' => 'organizations',
			'action' => 'index',
		],
		'admin/organization/view' => [
			'controller' => 'organizations',
			'action' => 'view',
		],
		'admin/organization/delete' => [
			'controller' => 'organizations',
			'action' => 'delete',
		],
		'admin/organization/update' => [
			'controller' => 'organizations',
			'action' => 'update',
		],
		'admin/organization/create' => [
			'controller' => 'organizations',
			'action' => 'create',
		],
		'admin/organization/addWorker' => [
			'controller' => 'organizations',
			'action' => 'addWorker',
		],
		
		'admin/xml' => [
			'controller' => 'admin',
			'action' => 'xml',
		],
	];
>>>>>>> master
