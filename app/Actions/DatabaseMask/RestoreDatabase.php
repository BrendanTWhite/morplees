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

class RestoreDatabase
{


    private $logger;
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
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

}
