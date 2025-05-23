<?php namespace App\Http\Requests;
use App\Abstracts\EntityValidator;
use App\Interfaces\ValidationInterface;

class CompanyValidator extends EntityValidator implements ValidationInterface
{
    /**
     * Validation for creating a new Object
     *
     * @var array
     */
    protected $rules = [
            'name_ar' => 'required' , 
            'name_en' => 'nullable' ,
            'category_id' => 'required' , 
            'phone' => 'required' , 

            'description_ar' => 'nullable' , 
            'description_en' => 'nullable' , 
            'status' => 'nullable' , 
            'image' => 'nullable' , 
            'views' => 'nullable' , 
            'rate' => 'nullable' , 
            'location' => 'nullable' , 
            'email' => 'nullable' , 
            'website' => 'nullable' , 
            'whatsapp' => 'nullable' , 
            'facebook' => 'nullable' , 
            'twitter' => 'nullable' , 
            'linkedin' => 'nullable' , 
            'instagram' => 'nullable' , 
      ];
    
    /**
     * Messages for creating a new Object
     *
     * @var array
     */
    public function messages(){
        return [
            'name_ar.required' => 'Name Ar is required!' , 
            'name_en.required' => 'Name En is required!' , 
            'phone.required' => 'Phone is required!' , 
            'category_id.required' => 'Category is required!' , 
        ];
    }
    
}
