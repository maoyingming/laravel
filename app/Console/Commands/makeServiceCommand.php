<?php

namespace App\Console\Commands;

use Config;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Composer;

class makeServiceCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:service {service} {--repository=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'make a service';

    /**
     * @var
     */
    protected $service;

    /**
     * @var
     */
    protected $repository;

    /**
     * @var
     */
    protected $files;

    /**
     * @var
     */
    protected $composer;

    /**
     * Create a new command instance.
     *
     * @param Filesystem $filesystem
     * @param Composer $composer
     */
    public function __construct(Filesystem $filesystem, Composer $composer)
    {
        parent::__construct();

        $this->files    = $filesystem;
        $this->composer = $composer;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //获取service和repository两个参数值
        $argument = $this->argument('service');
        $option   = $this->option('repository');
        //自动生成RepositoryInterface和Repository文件
        $this->writeService($argument, $option);
        //重新生成autoload.php文件
        $this->composer->dumpAutoloads();
    }

    private function writeService($service, $repository)
    {
        if($this->createService($service, $repository)){
            //若生成成功,则输出信息
            $this->info('Success to make a '.ucfirst($service).' Service');
        }
    }

    private function createService($service, $repository)
    {
        // getter/setter 赋予成员变量值
        $this->setService($service);
        $this->setRepository($repository);
        // 创建文件存放路径
        $this->createDirectory();
        // 生成文件
        return $this->createClass();
    }

    private function createDirectory()
    {
        $directory = $this->getDirectory();
        //检查路径是否存在,不存在创建一个,并赋予775权限
        if(! $this->files->isDirectory($directory)){
            return $this->files->makeDirectory($directory, 0755, true);
        }
    }

    private function getDirectory()
    {
        return Config::get('command.service.directory_path');
    }

    private function createClass()
    {
        //渲染模板文件,替换模板文件中变量值
        $template = $this->templateStub();
        $class     = null;
        //根据不同路径,渲染对应的模板文件
        $class = $this->files->put($this->getPath(), $template);
        return $class;
    }

    private function getPath()
    {
        // 文件路径
        return $this->getDirectory().DIRECTORY_SEPARATOR.$this->getServiceName().'.php';;
    }

    private function getServiceName()
    {
        // 根据输入的service变量参数,是否需要加上'Service'
        $serviceName = $this->getService();
        $serviceName .= 'Service';
        return $serviceName;
    }

    /**
     * @return mixed
     */
    public function getService()
    {
        return $this->service;
    }

    /**
     * @param mixed $service
     */
    public function setService($service)
    {
        $this->service = $service;
    }

    /**
     * @return mixed
     */
    public function getRepository()
    {
        return $this->repository;
    }

    /**
     * @param mixed $repository
     */
    public function setRepository($repository)
    {
        $this->repository = $repository;
    }

    private function templateStub()
    {
        // 获取模板文件
        $stubs        = $this->getStub();
        // 获取需要替换的模板文件中变量
        $templateData = $this->getTemplateData();
        // 进行模板渲染
        $renderStubs = $this->getRenderStub($templateData, $stubs);

        return $renderStubs;
    }

    private function getStub()
    {
        $stubs = $this->files->get(resource_path('stubs').DIRECTORY_SEPARATOR.'service.stub');
        return $stubs;
    }

    private function getTemplateData()
    {
        $serviceNamespace          = Config::get('command.service.service_namespace');
        $repositoryNamespace       = 'App\\Repositorys\\'.$this->getRepositoryName();
        $className                 = $this->getServiceName();
        $repositoryName            = $this->getRepositoryName();

        $templateVar = [
            'service_namespace'           => $serviceNamespace,
            'repository_namespace'        => $repositoryNamespace,
            'class_name'                  => $className,
            'repository_name'             => $repositoryName,
            'repository_var_name'         => ucwords($repositoryName),
        ];

        return $templateVar;
    }

    private function getRenderStub($templateData, $stub)
    {
        foreach ($templateData as $search => $replace) {
            $stub = str_replace('$'.$search, $replace, $stub);
        }

        return $stub;
    }

    private function getRepositoryName()
    {
        $RepositoryName = $this->getRepository();
        if(isset($RepositoryName) && !empty($RepositoryName)){
            $RepositoryName = ucfirst($RepositoryName);
        }else{
            // 若option选项没写,则根据service来生成repository Name
            $RepositoryName = $this->getRepositoryFromService();
        }

        return $RepositoryName;
    }

    private function getRepositoryFromService()
    {
        $service = strtolower($this->getService());
        $repository = str_replace('Service', '', $service);
        $repository .= 'Repository';
        return ucfirst($repository);
    }
}
