<?php namespace App\Http\Requests;
use App\Abstracts\EntityValidator;
use App\Interfaces\ValidationInterface;

class SliderValidator extends EntityValidator implements ValidationInterface
{
    /**
     * Validation for creating a new Object
     *
     * @var array
     */
    protected $rules = [
        'title_ar' => 'required' , 
        'title_en' => 'nullable' ,
        'page_id' => 'required' , 
        'status' => 'nullable' , 
        'image' => 'nullable' , 
        'description_ar' => 'nullable' , 
        'description_en' => 'nullable' , 
      ];
    
    /**
     * Messages for creating a new Object
     *
     * @var array
     */
    public function messages(){
        return [
            'title_ar.required' => 'Title Ar is required!' , 
            'title_en.required' => 'Title En is required!' , 
            'page_id.required' => 'Page is required!' , 
        ];
    }
    
}
