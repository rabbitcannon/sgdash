<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class DeployDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'deploy:database';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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

        if($this->confirm('Do you wish to reset the database and run the seeder?')) {
            $bar = $this->output->createProgressBar(100);

            $this->call('migrate:reset');
//            $bar->advance(33);

            $this->call('migrate');
//            $bar->advance(33);

            $this->call('db:seed', ['--class' => 'DevSeeder']);

            for ($i = 0; $i <= 100; $i++) {
                sleep(1);
                $bar->advance($i);
            }

            $bar->finish();

            $this->info("\n" . 'Database reset and deployed' . "\n");
        }
        else {
            $this->error('You must say yes to continue running the deployment.');
        }
    }
}
