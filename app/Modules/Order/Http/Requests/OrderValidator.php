<?php namespace App\Http\Requests;
use App\Abstracts\EntityValidator;
use App\Interfaces\ValidationInterface;

class OrderValidator extends EntityValidator implements ValidationInterface
{
    /**
     * Validation for creating a new Object
     *
     * @var array
     */
    protected $rules = [
         'name' => 'required' , 
          'email' => 'required|email' , 
          'phone' => 'required' , 
          'service_id' => 'required' , 
          'message' => 'required' , 
          'status' => 'nullable' , 
    ];
    
    /**
     * Messages for creating a new Object
     *
     * @var array
     */
    public function messages(){
        return [
            'name.required' => 'Name is required!' , 
            'email.required' => 'Email is required!' , 
            'email.email' => 'Email is format is incorrect!' , 
            'phone.required' => 'Phone is required!' , 
            'service_id.required' => 'Service is required!' , 
            'message.required' => 'Message is required!' , 
        ];
    }
    
}
