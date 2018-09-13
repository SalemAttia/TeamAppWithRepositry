<?php

namespace App\Repos;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Collection;
use Validator;


abstract class AbstractRepo
{
    /**
     * @var Model|Builder
     */
    public $model;

    /**
     * @param $data
     *
     * @return Model
     */
    public function create($data)
    {

        $Validator = Validator::make($data, $this->model->validationRules);
        if ($Validator->fails()) {
            return [
                'data' => $Validator->errors(),
                'valid' => false
            ];
        }

        $item = $this->model->create($data);

        return [
            'data' => $item,
            'valid' => true
        ];
    }

    /**
     * @param $idOrModel
     * @param $data
     *
     * @return Model
     *
     * @throws \App\Exceptions\ValidationException
     */
    public function update($idOrModel, $data)
    {

        $item = $this->getItem($idOrModel);

        if (! $item || ! $item->id) {
            return $this->create($data);
        }

        $Validator = Validator::make($data, $this->model->validationRules);

        if ($Validator->fails()) {
            return [
                'data' => $Validator->errors(),
                'valid' => false
            ];

        }


        $item->update($data);

        return [
            'data' => $item,
            'valid' => true
        ];
    }

    /**
     * Get all records.
     *
     * @param array $with
     * @param array $limit
     * @param array $offset
     *
     * @return Collection|Builder
     */
    public function findAll($with = [],$limit = 10,$offset = 0)
    {
        $query = $this->model
            ->with($with)
            ->limit($limit)
            ->offset($offset)
            ->orderBy('id', 'DESC');

        return $query->get();
    }

    /**
     * Find a record by a specific key.
     *
     * @param array $with
     *
     * @param $id
     *
     * @return mixed|static
     */
    public function findOneBy($id,$with = [])
    {
        $item = $this->model->with($with)->find($id);
        if(!$item){
            return [
                'notFounded' => true,
                'data' => null
            ];
        }
        return [
            'notFounded' => false,
            'data' => $item
        ];

    }

    /**
     * Find a record by a specific key of Fail.
     *
     * @param array $filters
     * @param array $with
     *
     * @return Model
     */
    public function findOneByOrFail($filters = [], $with = [])
    {
        return $this->model->where($filters)->with($with)->firstOrFail();
    }


    /**
     * Delete a record by id.
     *
     * @param $id
     *
     * @return int
     */
    public function delete($id)
    {
        return $this->model->destroy($id);
    }

    /**
     * @param $idOrModel
     *
     * @return Model
     */
    protected function getItem($idOrModel)
    {
        return gettype($idOrModel) == 'object' ? $idOrModel : $this->model->find($idOrModel);
    }

}
