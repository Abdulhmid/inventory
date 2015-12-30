<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ResetDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reset:db';

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
      try {
          /*
          * Truncante Data Dummy
          */

          $tableNames = \Schema::getConnection()->getDoctrineSchemaManager()
                                                ->listTableNames();
          foreach ($tableNames as $key => $name) {
              if ($name == 'migrations') {
                  continue;
              }
              \DB::statement('TRUNCATE TABLE ' . $name . ' CASCADE');
          }

          /*
          * Call Artisan Command Default Data
          */
          \Artisan::call('db:seed');
          echo PHP_EOL . "Sukses" . PHP_EOL;
      } catch (Exception $e) {
          echo PHP_EOL . "Failed" . PHP_EOL;
      }

    }
}
