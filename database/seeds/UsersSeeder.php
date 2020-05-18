<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Role;
use App\User;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();
        DB::table('users_roles')->delete();

        $admin_role = Role::where('name', 'admin')->first();
        $student_role = Role::where('name', 'student')->first();

        $user = User::create([
            'first_name' => 'Jeroen',
            'last_name' => 'Postema',
            'email' => 'jeroen@script.nl',
            'email_verified_at' => now(),
            'password' => Hash::make('postema'),
            'remember_token' => Str::random(10)
        ]);

        $user->save();
        $user->roles()->attach($admin_role);
        $user->roles()->attach($student_role);

        $user = User::create([
            'first_name' => 'Bas',
            'last_name' => 'Wollinga',
            'email' => 'bwollinga@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('wollinga2020'),
            'remember_token' => Str::random(10),
        ]);

        $user->save();
        $user->roles()->attach($student_role);

        $user = User::create([
            'first_name' => 'Mathijs',
            'last_name' => 'Lohr',
            'email' => 'mathijslohr@ziggo.nl',
            'email_verified_at' => now(),
            'password' => Hash::make('lohr2020'),
            'remember_token' => Str::random(10),
        ]);

        $user->save();
        $user->roles()->attach($student_role);

        factory(User::class, 50)->create()->each(function ($user) use ($student_role) {
            $user->roles()->attach($student_role);
        });
    }
}
