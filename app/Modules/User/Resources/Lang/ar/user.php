<?php

return [
	'title'=>'المستخدمين', 
	'newOne' => 'اضافة مستخدم جديد',
	'form' => [
		'name' => 'الاسم',
		'email' => 'البريد الالكتروني',
		'password' => 'كلمة المرور',
		'password_confirmation' => 'تأكيد كلمة المرور',
		'role' => 'المجموعة',
		'last_login' => 'اخر عملية تسجيل دخول',
		'extra_permissions' => 'الصلاحيات الاضافية',
		'first_name' => 'الاسم الاول',
		'last_name' => 'الاسم الاخير',
		'image' => 'الصورة الشخصية',
		'change_image_p' => 'تغيير صورة المستخدم',
		'validations' => [
			'email_required' => 'البريد الالكتروني مطلوب!',
			'email_email' => 'صيغة البريد الإلكتروني غير صحيح!',
			'email_unique' => 'تم استخدام البريد الإلكتروني بالفعل!',
			'first_name_unique' => 'الاسم الأول مطلوب!',
			'role_id_unique' => 'المجموعة مطلوب!',
			'password_required' => 'كلمة المرور مطلوبة!',
			'password_confirmed' => 'كلمة السر غير متطابقة!',
			'password_min' => 'يجب أن تتكون كلمة المرور من 6 أحرف على الأقل!',
		],
	], 
];