<?php

namespace App\Modules\Shop\Models;

use App\Model\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

/**
 * Class Product
 * @package App\Modules\User\Models
 */
class Product extends Model
{
    use HasApiTokens, Notifiable;

    /**
     * @var string
     */
    protected $table = 'monz_store_product';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'created_by',
        'name',
        'slug',
        'description',
        'price',
        'quantity',
        'sku',
        'barcode',
        'instock',
        'discount_type_percent',
        'discount',
        'discount_start_date',
        'discount_end_date',
        'include_taxes',
        'length_units',
        'weight_units',
        'length',
        'width',
        'height',
        'weight',
        'deleted',
        'status',
        'short_description'
    ];
}
