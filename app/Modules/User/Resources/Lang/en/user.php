<?php

return [
	'title'=>'Users', 
	'newOne' => 'Add New User', 
	'form' => [
		'name' => 'Name',
		'email' => 'E-Mail',
		'password' => 'Password',
		'password_confirmation' => 'Password Confirmation',
		'role' => 'Role',
		'last_login' => 'Last Login',
		'extra_permissions' => 'Extra Permissions',
		'first_name' => 'First Name',
		'last_name' => 'Last Name',
		'image' => 'Image',
		'change_image_p' => 'Change User Image',
		'validations' => [
			'email_required' => 'Email is required!',
			'email_email' => 'Email Format is Incorrect!',
			'email_unique' => 'Email has been already used!',
			'first_name_unique' => 'First Name is required!',
			'role_id_unique' => 'Role is required!',
			'password_required' => 'Password is required!',
			'password_confirmed' => 'Passwords are not the same!',
			'password_min' => 'Password must be at least 6 characters!',
		],
	], 
];