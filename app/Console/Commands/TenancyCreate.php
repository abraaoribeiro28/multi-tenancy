<?php

namespace App\Console\Commands;

use App\Models\Tenancy;
use App\Tenancy\Connect;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;
use function Laravel\Prompts\text;

class TenancyCreate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tenancy:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $name = text('Give me a name');
        $domain = text('The domain');
        $database = explode('.', $domain)[0].'.sqlite';

        $tenancy = Tenancy::query()->createOrFirst([
           'name' => $name,
           'domain' => $domain,
           'database' => $database
        ]);

        if (! File::exists(database_path($database))) {
            File::put(database_path($database), '');
        }

        (new Connect($tenancy))->setDefault();

        $this->call('migrate');
    }
}
