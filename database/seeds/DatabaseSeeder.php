<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

        \Illuminate\Support\Facades\DB::table('users')->delete();
        \Illuminate\Support\Facades\DB::table('roles')->delete();
        \Illuminate\Support\Facades\DB::table('phones')->delete();
        \Illuminate\Support\Facades\DB::table('role_user')->delete();

        // tạo data user và phone
        factory(\App\User::class, 30)->create()->each(function ($u) {
            $u->phone()->save(
                factory(\App\Phone::class)->make()
            );
        });

        // tạo data role
        $role = ['manager', 'admin', 'user'];
        for ($i = 0; $i < count($role); $i++)
        {
            \App\Role::create([
                'name' => $role[$i]
            ]);
        }

        // tạo data role_user
        $roles = \App\Role::all();
        $roleCount = count($roles);
        foreach (\App\User::all() as $user){
            for ($i = 0; $i < rand(0, $roleCount); $i++)
            {
                $role_id = $roles[$i];
                $user->roles()->attach($role_id);
            }
        }

    }
}
