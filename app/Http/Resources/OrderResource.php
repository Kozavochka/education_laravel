<?php

namespace App\Http\Resources;


use App\Models\Order;
use Illuminate\Http\Resources\Json\JsonResource;
/**
 * Class OrderResource
 * @package App\Http\Resources
 * @mixin Order
 */
class OrderResource extends JsonResource
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
            'id' => $this->id,
            'user' => UserResource::make($this->user),
            'description' => $this->description,
            'cars' => CarResource::collection($this->cars),
            'created_at'=>$this->created_at?->toDayDateTimeString(),
        ];
    }
}
