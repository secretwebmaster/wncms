<?php

namespace App\Console\Commands;

use Artisan;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class CreateModel extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'wncms:create_model {model_name} {--backend}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Quickly create custom model class, view, migration, contoller, files for new Eloquent model';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //namings
        $model_name = str()->snake($this->argument('model_name'));
        $className = str($model_name)->studly();
        $singulaer_camel = str($model_name)->camel()->singular();
        $plural_camel = str($model_name)->camel()->plural();
        $singulaer_snake = str($model_name)->snake()->singular();
        $plural_snake = str($model_name)->snake()->plural();

        //make model
        Artisan::call("make:model {$className} -mcr");
        $this->info(Artisan::output());

        //create model view
        Artisan::call("wncms:create_model_view {$singulaer_snake}");
        $this->info(Artisan::output());

        //add model permission
        Artisan::call("wncms:create_model_permission {$singulaer_snake}");
        $this->info(Artisan::output());

        //Fix Controller
        if ($this->confirm('This may override current Controller file, are you sure to continue?')) {
            //get controller file
            $controller_file = app_path("Http/Controllers/Backend/{$className}Controller.php");
            //if exist
            if (File::exists($controller_file)) {
                $file_content = File::get($controller_file);

                //replace view name
                $updatedContent = str_replace("backend.{$plural_camel}.", "backend.{$plural_snake}.", $file_content);
                //replace route name
                $updatedContent = str_replace("route('{$plural_camel}.", "route('{$plural_snake}.", $updatedContent);
                //replace tag
                $updatedContent = str_replace("->tags(['{$plural_camel}'])", "->tags(['{$plural_snake}'])", $updatedContent);
                //replace model word
                $updatedContent = str_replace("wncms_model_word('{$singulaer_camel}'", " wncms_model_word('{$singulaer_snake}'", $updatedContent);

                File::put($controller_file, $updatedContent);
                $this->info("Controller {$controller_file} has been updated");

            }else{
                $this->info("Controller {$controller_file} is not found");
            }
            //else message
        }

        //append route to backend
        if($this->option('backend')){
            if ($this->confirm('This will append new routes to custom_backend.php file, are you sure?')) {
                //get controller file
                $custom_backend_file = base_path("routes/custom_backend.php");
                //if exist
                if (!File::exists($custom_backend_file)) {
                    $this->info("route file {$custom_backend_file} is not found");
                    File::put($custom_backend_file, "<?php\n\n// Custom backend routes\n");
                    $this->info("Route file {$custom_backend_file} was not found, so it has been created.");
                }

                //Append routes
                $contentToAppend = <<<EOT
                \n\n// starter_model for model StarterModel
                Route::get('starter_models', [StarterModelController::class, 'index'])->middleware('can:starter_model_index')->name('starter_models.index');
                Route::get('starter_models/create', [StarterModelController::class, 'create'])->middleware('can:starter_model_create')->name('starter_models.create');
                Route::get('starter_models/create/{starterModel}', [StarterModelController::class, 'create'])->middleware('can:starter_model_clone')->name('starter_models.clone');
                Route::get('starter_models/{starterModel}/edit', [StarterModelController::class, 'edit'])->middleware('can:starter_model_edit')->name('starter_models.edit');
                Route::post('starter_models/store', [StarterModelController::class, 'store'])->middleware('can:starter_model_create')->name('starter_models.store');
                Route::patch('starter_models/{starterModel}', [StarterModelController::class, 'update'])->middleware('can:starter_model_edit')->name('starter_models.update');
                Route::delete('starter_models/{starterModel}', [StarterModelController::class, 'destroy'])->middleware('can:starter_model_delete')->name('starter_models.destroy');
                Route::post('starter_models/bulk_delete', [StarterModelController::class, 'bulk_delete'])->middleware('can:starter_model_bulk_delete')->name('starter_models.bulk_delete');
                EOT;
                
                $contentToAppend = str_replace("starter_model", $singulaer_snake, $contentToAppend);
                $contentToAppend = str_replace("starterModel", $singulaer_camel, $contentToAppend);
                $contentToAppend = str_replace("StarterModel", $className, $contentToAppend);
                File::append($custom_backend_file, $contentToAppend);
                

                //Prepend use Class;
                $fileContents = file_get_contents($custom_backend_file);
                $newUseStatement = "use App\\Http\\Controllers\\{$className}Controller;";

                if(strpos($fileContents, $newUseStatement) === false){
                    // Find the position of the PHP opening tag
                    $phpTagPos = strpos($fileContents, '<?php');

                    if ($phpTagPos !== false) {
                        // Insert the new "use" statement after the PHP tag
                        $modifiedContents = substr($fileContents, 0, $phpTagPos + 5) . "\n\n" . $newUseStatement . "\n" . substr($fileContents, $phpTagPos + 5);
                        
                        // Write the modified contents back to the file
                        File::put($custom_backend_file, $modifiedContents);

                        $this->info("prepended {$newUseStatement}");
                    } else {
                        $this->info("No <?php tag found in the file.");

                    }
                }else{
                    $this->info("use statement for the same controller class already exist");
                }
            
                $this->info("route file {$custom_backend_file} has been updated");

            }
        }

    }
}
