<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class CreateRepositories extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:repo {module}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Module Repositories';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $module = $this->argument('module');
        if (File::exists(base_path('app/Repositories/' . $module))) {
            return $this->error("Created module repository '{$module}' already exists");
        }
        $srcFolder = base_path('app/Repositories/' . $module);
        if (!File::exists($srcFolder)) {
            File::makeDirectory($srcFolder, 0755, true);
        }
        if (!File::exists($srcFolder . "/" . $module . "Repository.php")) {
            $modelsFile = "app/Console/Commands/Templates/CreateRepositories.txt";
            $modelsContent = File::get($modelsFile);
            $modelsContent = str_replace("{module}", $module, $modelsContent);
            File::put($srcFolder . "/" . $module . "Repository.php", $modelsContent);
            return $this->info("Created module repository '{$module}' successfully");
        } else {
            return $this->error("Created module repository '{$module}' already exists");
        }
    }

}
