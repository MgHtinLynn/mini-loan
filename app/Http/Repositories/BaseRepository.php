<?php
/**
 * Created by PhpStorm.
 * User: htinlynn
 * Date: 10/24/18
 * Time: 11:04 PM
 */

namespace App\Http\Repositories;


use Illuminate\Database\Eloquent\Model;

class BaseRepository
{
    protected $model;

    /**
     * BaseRepository constructor.
     * @param $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * @return Model
     */
    public function getModel()
    {
        return $this->model;
    }


    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAll()
    {
        return $this->model->all();
    }

    /**
     * @param $data
     * @return mixed
     */
    public function create(array $data)
    {
        return $this->model->create($data);
    }


    /**
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        return $this->model->findorFail($id);
    }

    /**
     * @param array $model
     * @return \Illuminate\Database\Eloquent\Builder|static
     */
    public function with(array $model)
    {
        return $this->model->with($model);
    }

    /**
     * @param $data
     * @param $id
     * @return mixed
     */
    public function update(array $data, $id)
    {
        return tap($this->model->find($id))->update($data);
    }

    /**
     * @return mixed
     */
    public function getCount()
    {
        return $this->model->count();
    }


    /**
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        return $this->model->query();
    }

    /**
     * @param $tableName
     * @return mixed
     */
    public function getModelByTableName($tableName)
    {
        $className = 'App\\Models\\' . studly_case(str_singular($tableName));
        if (class_exists($className)) {
            $model = new $className;
            return $model;
        } else {
            return null;
        }

    }
}