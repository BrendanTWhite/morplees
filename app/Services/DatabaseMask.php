<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Spatie\DbSnapshots\Helpers\Format;
use Spatie\DbSnapshots\SnapshotFactory;
use Spatie\DbSnapshots\Snapshot;
use Illuminate\Console\Command;
use Exception;
use Spatie\DbSnapshots\SnapshotRepository;
use Faker\Factory;

class DatabaseMask
{

    /**
     * Create a backup.
     *
     * @return Snapshot
     */
    public static function backup(){

        $connectionName = config('db-snapshots.default_connection')
            ?? config('database.default');

        $appName = config('app.name');
        $environmentName = App::environment();
        $currentTimeString = Carbon::now()->format('Y-m-d_H-i-s');
        $snapshotName = $appName.'_'.$environmentName.'_'.$currentTimeString;

        $compress = config('db-snapshots.compress', false);

        $snapshot = app(SnapshotFactory::class)->create(
            $snapshotName,
            config('db-snapshots.disk'),
            $connectionName,
            $compress
        );

        return $snapshot;

    }

    public static function restore($filename){

            // We will NEVER restore a backup to a Production environment

            $environment = App::environment();
            if ($environment == 'production') {
                throw new Exception("DBM will not restore to a '$environment' environment.");
            } 

            // OK. We have a filename. Let's get the snapshot with that name.

            /** @var \Spatie\DbSnapshots\Snapshot $snapshot */
            $snapshot = app(SnapshotRepository::class)->findByName($filename);

            if (! $snapshot) {
                throw new Exception("Snapshot `{$filename}` does not exist!");    
                return Command::INVALID;
            }

            // We are good to go. Let's load this thing.

            $snapshot->load();

    }

    public static function mask(){
        
    }
}
