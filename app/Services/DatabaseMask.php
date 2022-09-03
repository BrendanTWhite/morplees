<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Spatie\DbSnapshots\Helpers\Format;
use Spatie\DbSnapshots\SnapshotFactory;
use Spatie\DbSnapshots\Snapshot;

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

        $environmentName = App::environment();
        $currentTimeString = Carbon::now()->format('Y-m-d_H-i-s');
        $snapshotName = $environmentName.'_'.$currentTimeString;

        $compress = config('db-snapshots.compress', false);

        $snapshot = app(SnapshotFactory::class)->create(
            $snapshotName,
            config('db-snapshots.disk'),
            $connectionName,
            $compress
        );

        return $snapshot;

    }

    public static function restore(){

    }

    public static function mask(){

    }
}
