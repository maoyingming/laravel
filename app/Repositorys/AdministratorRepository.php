<?php
namespace App\Repositorys;

use App\Models\Administrator;

class AdministratorRepository
{
    /**
     * @var \App\Models\Administrator
     */
    public $administrator;

    public function __construct(Administrator $administrator)
    {
        $this->administrator = $administrator;
    }

    /**
     * @param array $columns
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function all($columns = array('*'))
    {
        return $this->administrator->all($columns);
    }

    /**
     * @param int $perPage
     * @param array $columns
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function paginate($perPage = 15, $columns = array('*'))
    {
        return $this->administrator->paginate($perPage, $columns);
    }

    /**
     * Create a new administrator
     * @param array $data
     * @return \App\Models\Administrator
     */
    public function create(array $data)
    {
        return $this->administrator->create($data);
    }

     /**
       * Update a administrator
       * @param array $data
       * @param $id
       * @return \App\Models\Administrator
       */
    public function update($data = [], $id)
    {
        return $this->administrator->whereId($id)->update($data);
    }

    /**
     * Store a administrator
     * @param array $data
     * @return \App\Models\Administrator
     */
    public function store($data = [])
    {
        $this->administrator->id = $data['id'];
        //...
        return $this->administrator->save();
    }

    /**
     * Delete a administrator
     * @param array $data
     * @param $id
     * @return \App\Models\Administrator
     */
    public function delete($data = [], $id)
    {
        return $this->administrator->whereId($id)->delete();
    }

    /**
     * @param $id
     * @param array $columns
     * @return array|\Illuminate\Database\Eloquent\Collection|static[]
     */
    public function find($id, $columns = array('*'))
    {
        $Administrator = $this->administrator->whereId($id)->get($columns);
        return $Administrator;
    }

    /**
     * @param $field
     * @param $value
     * @param array $columns
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function findBy($field, $value, $columns = array('*'))
    {
        $Administrator = $this->administrator->where($field, '=', $value)->get($columns);
        return $Administrator;
    }

}