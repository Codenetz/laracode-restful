<?php

namespace App\Modules\Shop\Repository;

use App\Model\Repository;
use App\Modules\Shop\Models\Product as ProductModel;
use \Illuminate\Support\Collection;

/**
 * Class Product
 * @package App\Modules\Shop\Repository
 */
class Product extends Repository
{
    /**
     * @return mixed
     */
    public function model()
    {
        return ProductModel::class;
    }

    /**
     * @param array $filters
     * @return mixed|null
     */
    public function fetchProduct(array $filters = [])
    {
        return $this->fetchProducts($filters, ['id', 'DESC'], 1, 0)->first();
    }

    /**
     * @param array $filters
     * @param array $orderBy
     * @param int $limit
     * @param int $offset
     * @return Collection
     */
    public function fetchProducts(array $filters = [], array $orderBy = ['id', 'ASC'], int $limit = 10, int $offset = 0): Collection
    {
        $builder = $this->queryBuilder();

        $builder->whereRaw('deleted = false');

        if (isset($filters['slug'])) {
            $builder->whereRaw('slug = ?', [$filters['slug']]);
        };

        if (isset($filters['id'])) {
            $builder->whereRaw('id = ?', [(int)$filters['id']]);
        };

        return new Collection($this->hydrate($builder->get()->all()));
    }
}
