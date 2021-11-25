<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;

class MakeCrud extends Command
{
    protected $signature = 'make:crud {modelName?}';
    protected $description = 'Command description';
    private $modelNamespaceBase = 'App\Models\\';
    private $singularModelName;

    private $makeBackpackCrud = false;
    private $makeService = false;
    private $makeRepository = false;

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $this->singularModelName = Str::studly($this->argument('modelName'));
        $this->checkIfModelExists($this->singularModelName);
        $this->questionnaire();
    }

    private function questionnaire(){
        $this->info('Use Y / N to answer. Default value N');
        if ($this->confirm('Do you want to create the Backpack Crud?', false)) {
            $this->makeBackpackCrud = true;
        }
        if ($this->confirm('Do you want to create the Service?', false)) {
            $this->makeService = true;
        }
        if ($this->confirm('Do you want to create the Repository?', false)) {
            $this->makeRepository = true;
        }
        $this->makeCrud();
    }

    private function makeCrud(){
        if ($this->makeBackpackCrud){
            $this->makeBackpackCrud();
        }

        if ($this->makeService && $this->makeRepository){
            $this->makeRepository();
            $this->makeFullService();
        }
        else{
            if ($this->makeService){
                $this->makeService();
            }
            if ($this->makeRepository){
                $this->makeRepository();
            }
        }
    }

    private function makeFullService(){
        Artisan::call('make:full-service ' . $this->singularModelName);
        $this->info($this->singularModelName . ' folder created successfully into Services folder!');
    }

    private function makeBackpackCrud(){
        Artisan::call('backpack:crud ' . $this->singularModelName);
        $this->info($this->singularModelName . ' Backpack CRUD created successfully!');
    }

    private function makeService(){
        Artisan::call('make:service ' . $this->singularModelName);
        $this->info($this->singularModelName . ' folder created successfully into Services folder!');
    }

    private function makeRepository(){
        Artisan::call('make:repository ' . $this->singularModelName);
        $this->info($this->singularModelName . ' folder created successfully into Repositories folder!');
    }

    private function checkIfModelExists(string $model)
    {
        if (!class_exists($this->modelNamespaceBase . $model)) {
            $this->error('The model ' . $model . ' was not found in this project.');
            die(1);
        }
    }
}
