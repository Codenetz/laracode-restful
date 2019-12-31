<?php
namespace  App\Modules\Shop\Entities;

use App\Model\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="monz_store_product")
 */
class ProductEntity extends Entity
{
    /**
     * @ORM\Column(name="name", type="string", length=250)
     */
    protected $name;

    /**
     * @ORM\Column(name="slug", type="string", length=250)
     */
    protected $slug;

    /**
     * @ORM\Column(name="short_description", type="text")
     */
    protected $short_description;

    /**
     * @ORM\Column(name="description", type="text")
     */
    protected $description;

    /**
     * @ORM\Column(name="price", type="bigint")
     */
    protected $price;

    /**
     * @ORM\Column(name="quantity", type="integer", options={"default" : 0})
     */
    protected $quantity;

    /**
     * @ORM\Column(name="sku", type="string", length=250, nullable=true)
     */
    protected $sku;

    /**
     * @ORM\Column(name="barcode", type="string", length=250, nullable=true)
     */
    protected $barcode;

    /**
     * @ORM\Column(name="instock", type="boolean", options={"default" : true})
     */
    protected $instock;

    /**
     * @ORM\Column(name="discount_type_percent", type="boolean", options={"default" : true})
     */
    protected $discount_type_percent;

    /**
     * @ORM\Column(name="discount", type="bigint", options={"default" : 0})
     */
    protected $discount;

    /**
     * @ORM\Column(name="discount_start_date", type="integer", nullable=true)
     */
    protected $discount_start_date;

    /**
     * @ORM\Column(name="discount_end_date", type="integer", nullable=true)
     */
    protected $discount_end_date;

    /**
     * @ORM\Column(name="include_taxes", type="boolean", options={"default" : true})
     */
    protected $include_taxes;

    /**
     * For example: cm, mm
     * @ORM\Column(name="length_units", type="string", length=50, nullable=true)
     */
    protected $length_units;

    /**
     * For example: kg
     * @ORM\Column(name="weight_units", type="string", length=50, nullable=true)
     */
    protected $weight_units;

    /**
     * @ORM\Column(name="length", type="integer", nullable=true)
     */
    protected $length;

    /**
     * @ORM\Column(name="width", type="integer", nullable=true)
     */
    protected $width;

    /**
     * @ORM\Column(name="height", type="integer", nullable=true)
     */
    protected $height;

    /**
     * @ORM\Column(name="weight", type="integer", nullable=true)
     */
    protected $weight;

    /**
     * @ORM\ManyToOne(targetEntity="App\Modules\User\Entities\UserEntity")
     * @ORM\JoinColumn(name="created_by", referencedColumnName="id", onDelete="SET NULL")
     */
    protected $created_by;
}
