<?php
namespace App\Services;

use App\Repositorys\AdministratorRepository;

class AdministratorService
{
    /**
     * @var \App\Repositorys\AdministratorRepository
     */
    protected $AdministratorRepository;

    public function __construct(AdministratorRepository $AdministratorRepository)
    {
        $this->AdministratorRepository = $AdministratorRepository;
    }
    public function loginCheck($request){
        $param = $request->all();
        //return $this->AdministratorRepository->findOne(['email' => $param['email'], 'password' => $param['password']]);
        return $this->AdministratorRepository->find(1);
    }
}