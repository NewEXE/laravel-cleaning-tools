<?php

namespace Newexe\LaravelCleaningTools\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

/**
 * Class ClearAllCachedData
 * @package Newexe\Commands
 */
class ClearAllCachedData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'clear:data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear all cached data';

    protected $commands = [
        'clear-compiled',
        'optimize',

        'cache:clear',

        'route:clear',
        'route:cache',

        'view:clear',
        'view:cache',

        'config:clear',
        'config:cache',

        'auth:clear-resets',

        'package:discover',
    ];

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $errors = [];
        foreach ($this->commands as $command) {
            try {
                Artisan::call($command);
            } catch (\Exception $e) {
                $errors[] = $command;
            }
        }

        if (! empty($errors)) {
            $errorsStr = implode(', ', $errors);
            $this->output->writeln("Some commands not finish successfully: $errorsStr.");
            return 1;
        } else {
            $this->output->success('All cached data cleared!');
            return 0;
        }
    }
}
