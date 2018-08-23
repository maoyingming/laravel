<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>


## 新增自定义artisan命令

- make:repository repositoryName --model=modelName（默认为repositoryName相对应model）
- make:service serviceName --repository=repositoryName（默认为serviceName相对应repository）

-1、resources/stubs新建模板文件
-2、php artisan make:console MakeRepositoryCommand
   php artisan make:console MakeServiceCommand
-3、然后改下签名、描述和自动生成逻辑 app/Console/Commands/MakeRepositoryCommand
-4、在Console的Kernel里注册命令
