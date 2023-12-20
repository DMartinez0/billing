<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'cod' => $this->cod,
            'description' => $this->description,
            'quantity' => $this->quantity,
            'category' => CategoryResource::make($this->category),
            'quantity_unit' => QuantityUnitResource::make($this->quantityUnit),
            'provider' => ContactResource::make($this->provider),
            'brand' => BrandResource::make($this->brand),
            'prices' => PriceResource::collection($this->prices),
            'information' => $this->information,
            'tags' => $this->tags,
            'minimum_stock' => $this->minimum_stock,
            'expires' => $this->expires,
            'composed' => $this->composed,
            'prescription' => $this->prescription,
            'service' => $this->service,
            'promotion' => $this->promotion,
            'ecommerce' => $this->ecommerce,
        ];
    }
}
