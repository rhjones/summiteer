<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
	{

	    $user = \App\User::firstOrCreate(['email' => 'jill@harvard.edu']);
	    $user->username = 'jillharvard';
	    $user->firstname = 'Jill';
	    $user->lastname = 'Harvard';
	    $user->email = 'jill@harvard.edu';
	    $user->password = \Hash::make('helloworld');
	    $user->save();

	    $user = \App\User::firstOrCreate(['email' => 'jamal@harvard.edu']);
	    $user->username = 'jamalharvard';
	    $user->firstname = 'Jamal';
	    $user->lastname = 'Harvard';
	    $user->email = 'jamal@harvard.edu';
	    $user->password = \Hash::make('helloworld');
	    $user->save();

	}
}
