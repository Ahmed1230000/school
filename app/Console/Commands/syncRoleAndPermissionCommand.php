<?php

namespace App\Console\Commands;

use Database\Seeders\RoleAndPermissionSeeder;
use Illuminate\Console\Command;

class syncRoleAndPermissionCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:sync-role-and-permission';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Syncing roles and permissions...');

        // Check if the roles and permissions are already synced
        $roleAndPermissionSeeder = new RoleAndPermissionSeeder();
        $roleAndPermissionSeeder->run();
        // You can also check if the roles and permissions already exist in the database

        $this->info('Roles and permissions synced successfully.');
    }
}
