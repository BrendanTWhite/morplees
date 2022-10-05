<?php

namespace App\Actions\DatabaseMask;

use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Spatie\DbSnapshots\Helpers\Format;
use Spatie\DbSnapshots\SnapshotFactory;
use Spatie\DbSnapshots\Snapshot;
use Illuminate\Console\Command;
use Exception;
use Spatie\DbSnapshots\SnapshotRepository;
use Faker\Factory;
use Illuminate\Support\Facades\Log;


use Illuminate\Container\Container;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;

use Psr\Log\LoggerInterface;

class BackupDatabase
{


    private $logger;
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * Create a backup.
     *
     * @return Snapshot
     */
    public function __invoke(){

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

}
