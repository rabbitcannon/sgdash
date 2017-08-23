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
            $this->call('migrate:reset');
            $this->call('migrate');
            $this->call('db:seed', ['--class' => 'DevSeeder']);

            $bar = $this->output->createProgressBar(30);

            for ($i = 0; $i <= 30; $i++) {
                sleep(1);
                $bar->advance(1);
            }

            $bar->finish();

            $this->info("\n" . 'Database reset and deployed' . "\n");
        }
        else {
            $this->error('You must say yes to continue running the deployment.');
        }
    }
}
