<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Permission;

class AddTicketPermissionsToPermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Create new ticket-related permissions
        Permission::create(['name' => 'create tickets']);
        Permission::create(['name' => 'view tickets']);
        Permission::create(['name' => 'edit tickets']);
        Permission::create(['name' => 'delete tickets']);
        Permission::create(['name' => 'reply tickets']);
        Permission::create(['name' => 'manage tickets']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Remove ticket-related permissions if rolled back
        Permission::findByName('create tickets')->delete();
        Permission::findByName('view tickets')->delete();
        Permission::findByName('edit tickets')->delete();
        Permission::findByName('delete tickets')->delete();
        Permission::findByName('reply tickets')->delete();
        Permission::findByName('manage tickets')->delete();
    }
}
