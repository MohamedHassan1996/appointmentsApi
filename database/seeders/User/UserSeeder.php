<?php

namespace Database\Seeders\User;

use App\Enums\User\UserStatus;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $this->command->info('Creating Admin User...');


        $user = new User();
        $user->name = 'Mohamed Hassan';
        $user->email = 'mr10dev10@gmail.com';
        $user->password = 'Mans123456';
        $user->is_active = UserStatus::ACTIVE;
        $user->email_verified_at = now();
        $user->phone = '1234567890';
        $user->address = 'Admin Address';
        $user->save();

        $role = Role::where('name', 'super admin')->first();

        $user->assignRole($role);

        /*User 2 */

        $user2 = new User();
        $user2->name = 'Ahmed Adel';
        $user2->email = 'admin2@admin.com';
        $user2->password = 'Mans123456';
        $user2->is_active = UserStatus::ACTIVE;
        $user2->email_verified_at = now();
        $user2->phone = '1234567890';
        $user2->address = 'Admin Address';
        $user2->save();

        $role2 = Role::where('name', 'admin')->first();

        $user2->assignRole($role2);



    }
}
