<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Storage;

class RefreshCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'shop:refresh';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Installation';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        if (app()->isProduction()) {
            return self::FAILURE;
        }

        (new Filesystem())->cleanDirectory(
            Storage::path('images/products')
        );

        $this->call('migrate:fresh', [
            '--seed' => true
        ]);

        return Command::SUCCESS;
    }
}
