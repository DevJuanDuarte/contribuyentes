<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
       $role1 = Role::create(["name"=> "superadmin"]);
       $role2 = Role::create(["name"=> "administrador"]);
       $user1 = User::find(1);
       $user1->assignRole($role1);
       $user2 = User::find(2);
       $user2->assignRole($role2);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
    }
};
