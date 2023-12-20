<?php

namespace App\System\VendorModifier;

use Illuminate\Support\Facades\DB;
use Spatie\Multitenancy\Concerns\UsesMultitenancyConfig;
use Spatie\Multitenancy\Exceptions\InvalidConfiguration;
use Spatie\Multitenancy\Models\Tenant;
use Spatie\Multitenancy\Tasks\SwitchTenantTask;

class SwitchTenantDatabaseTask implements SwitchTenantTask
{
    use UsesMultitenancyConfig;

    public function makeCurrent(Tenant $tenant): void
    {
        $this->setTenantConnectionDatabaseName($tenant->getDatabaseName(), $tenant->hostname, $tenant->username);

    }

    public function forgetCurrent(): void
    {
        $this->setTenantConnectionDatabaseName(null, null, null);
    }

    protected function setTenantConnectionDatabaseName(?string $databaseName, ?string $hostName, ?string $userName)
    {
        $tenantConnectionName = $this->tenantDatabaseConnectionName();

        if ($tenantConnectionName === $this->landlordDatabaseConnectionName()) {
            throw InvalidConfiguration::tenantConnectionIsEmptyOrEqualsToLandlordConnection();
        }

        if (is_null(config("database.connections.{$tenantConnectionName}"))) {
            throw InvalidConfiguration::tenantConnectionDoesNotExist($tenantConnectionName);
        }

        config([
            "database.connections.{$tenantConnectionName}.database" => $databaseName,
            "database.connections.{$tenantConnectionName}.host" => $hostName,
            "database.connections.{$tenantConnectionName}.username" => $userName,
        ]);

        DB::purge($tenantConnectionName);
    }
}
