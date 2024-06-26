<?php
namespace App\Http\Resources;
use Illuminate\Http\Resources\Json\JsonResource;
class Register extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
        "id"=>$this->id,
        "name"=>$this->name,
        "email"=>$this->email,
        "password"=>$this->password,
        "phone"=>$this->phone,
        "address"=>$this->address,
        'created_at'=>$this->created_at->format('d/m/Y'),
        'updated_at'=>$this->updated_at->format('d/m/Y'),

        ];
    }
}
