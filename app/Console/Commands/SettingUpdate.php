<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SettingUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'wncms:setting-update {key} {value?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $key = $this->argument('key');
        $value = $this->argument('value');
        uss($key, $value);
        $this->info("Setting $key has been updated to " . gss($key));
    }
}
