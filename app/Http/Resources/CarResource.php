<?php

namespace App\Http\Resources;

use App\Models\Car;
use Illuminate\Http\Resources\Json\JsonResource;
/**
 * Class CarResource
 * @package App\Http\Resources
 * @mixin Car
 */
class CarResource extends JsonResource
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
            'id'=> $this->id,
            'name' =>$this->name,
            'year' => $this->year,
            'price' => $this->price,
            'format_price' => $this->format_price,
            'created_at'=>$this->created_at?->toDayDateTimeString(),
        ];
    }
}
