<?php namespace App\Http\Requests;
use App\Abstracts\EntityValidator;
use App\Interfaces\ValidationInterface;
use Illuminate\Http\Request;

class UserValidator extends EntityValidator implements ValidationInterface
{
    /**
     * Validation for creating a new Object
     *
     * @var array
     */
    protected $rules = [
        'email' => 'required|unique:users,email',
        'first_name' => 'required' ,
        'role_id' => 'required' ,
        'password' => 'required|min:6|same:password_confirmation',
        'password_confirmation' => 'required|min:6',
        'last_name' => 'nullable' ,
        'extra_permissions' => 'nullable' ,
        'image' => 'nullable' ,
    ];


    public function messages()
    {
        return [
            'email.required' => trans('User::user.form.validations.email_required') ,
            'email.email' => trans('User::user.form.validations.email_email') ,
            'email.unique' => trans('User::user.form.validations.email_unique') ,
            'first_name.required' => trans('User::user.form.validations.first_name_unique') ,
            'role_id.required' => trans('User::user.form.validations.role_id_unique') ,
            'password.required' => trans('User::user.form.validations.password_required') ,
            'password.confirmed' => trans('User::user.form.validations.password_confirmed') ,
            'password.min' => trans('User::user.form.validations.password_min') ,
        ];
    }

}
