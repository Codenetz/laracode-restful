<?php

namespace App\Modules\Shop\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

/**
 * Class Product
 * @package App\Modules\User\Resources
 */
class Product extends JsonResource
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        $user = Auth::user();
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'description' => $this->description,
            'price' => $this->price,
            'quantity' => $this->quantity,
            'sku' => $this->sku,
            'barcode' => $this->barcode,
            'instock' => $this->when($user && $user->isAdmin(), $this->instock),
            'discount_type_percent' => $this->discount_type_percent,
            'discount' => $this->discount,
            'discount_start_date' => $this->discount_start_date,
            'discount_end_date' => $this->discount_end_date,
            'include_taxes' => $this->include_taxes,
            'length_units' => $this->length_units,
            'weight_units' => $this->weight_units,
            'length' => $this->length,
            'width' => $this->width,
            'height' => $this->height,
            'weight' => $this->weight,
            'short_description' => $this->short_description,
            'status' => $this->status,
            'date_added' => $this->when($user && $user->isAdmin(), $this->date_added),
            'date_modified' => $this->when($user && $user->isAdmin(), $this->date_modified)
        ];
    }
}
