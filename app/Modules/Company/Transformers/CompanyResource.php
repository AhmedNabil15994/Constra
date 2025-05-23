<?php

namespace App\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class CompanyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name_ar'   => $this->name_ar,
            'name_en'   => $this->name_en,
            'description_ar'   => $this->description_ar,
            'description_en'   => $this->description_en,
            'image'   => $this->image,
            'views'   => $this->views,
            'rate'   => $this->rate,
            'location'   => $this->location,
            'phone'   => $this->phone,
            'email'   => $this->email,
            'website'   => $this->website,
            'whatsapp'   => $this->whatsapp,
            'facebook'   => $this->facebook,
            'twitter'   => $this->twitter,
            'linkedin'   => $this->linkedin,
            'instagram'   => $this->instagram,
            'category_id'   => $this->category_id,
            'category_name'   => $this->category_name,
            'status'   => $this->status,
        
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at,
        ];
    }
}
