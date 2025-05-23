<?php

namespace App\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            'name'   => $this->name,
            'email'   => $this->email,
            'phone'   => $this->phone,
            'service_id'   => $this->service_id,
            'message'   => $this->message,
            'status'   => $this->status,
            'service_name' => $this->service_name,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at,
        ];
    }
}
