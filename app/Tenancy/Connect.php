<?php

namespace App\Tenancy;

use App\Models\Tenancy;
use Illuminate\Support\Facades\Config;

class Connect
{
    public function __construct(
        protected readonly Tenancy $tenancy
    )
    { }

    public function setDefault(): void
    {
        $subDomain = explode('.', $this->tenancy->domain)[0];

        $connection = config('database.connections.sqlite');
        $connection['database'] = database_path($this->tenancy->database);

        Config::set('database.connections.' . $subDomain, $connection);
        Config::set('database.default', $subDomain);
    }
}
