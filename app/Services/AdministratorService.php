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
}