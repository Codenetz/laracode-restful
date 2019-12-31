<?php

namespace App\Model;

use Illuminate\Support\Facades\DB;

/**
 * Class Repository
 * @package App\Model
 */
abstract class Repository
{
    /** @var Model $model */
    protected $model;

    /**
     * @return mixed
     */
    abstract protected function model();

    /**
     * Repository constructor.
     */
    public function __construct()
    {
        $this->model = app($this->model());
    }

    /**
     * @param int|Model $item
     * @param callable $cb
     * @return mixed
     */
    protected function performAction($item, callable $cb)
    {
        if (is_int($item)) {
            $item = $this->model->find($item);
        }

        if ($item instanceof Model) {
            return $cb($item);
        }

        return false;
    }

    /**
     * @param string|null $tableName
     * @return \Illuminate\Database\Query\Builder
     */
    protected function queryBuilder(string $tableName = null)
    {
        return DB::table(is_null($tableName) ? $this->model->getTable() : $tableName);
    }

    /**
     * @param array $objects
     * @return mixed
     */
    protected function hydrate(array $objects = [])
    {
        return $this->model::hydrate($objects);
    }

    /**
     * @param int|Model $item
     * @return bool
     * @throws \Exception
     */
    public function hardDelete($item)
    {
        return $this->performAction($item, function ($item) {
            $item->delete();
            return true;
        });
    }

    /**
     * @param int|Model $item
     * @return bool
     */
    public function delete($item)
    {
        return $this->performAction($item, function ($item) {
            $item->deleted = true;
            $item->save();
            return true;
        });
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function insert(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * @param int|Model $item
     * @param array $data
     * @return bool|Model
     */
    public function update($item, array $data)
    {
        return $this->performAction($item, function ($item) use ($data) {
            $item->update($data);
            return $item;
        });
    }
}
