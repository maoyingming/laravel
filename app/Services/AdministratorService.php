<?php
namespace App\Services;

use App\Repositorys\AdministratorRepository;

class AdministratorService
{
    /**
     * @var \App\Repositorys\AdministratorRepository
     */
    public $AdministratorRepository;

    public function __construct(AdministratorRepository $AdministratorRepository)
    {
        $this->AdministratorRepository = $AdministratorRepository;
    }
}