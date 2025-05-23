<?php 

return [
	'title' => 'Sign In',
	'email' => 'Email',
	'password' => 'Password',
	'btn' => 'Sign In',
	'validations'   => [
        'email'     => [
            'email'     => 'Please add correct email format',
            'required'  => 'Please add your email address',
        ],
        'failed'    => 'These credentials do not match our records.',
        'password'  => [
            'min'       => 'Password must be more than 6 characters',
            'required'  => 'The password field is required',
        ],
        'mustLogin' => 'You To Login First',
        'invalidUser' => 'This User Does not exist',
        'invalidPassword' => 'Invlaid User Password',
    ],
    'welcome' => 'Welcome  ',
    'seeYou' => "See You Soon ;)",
];