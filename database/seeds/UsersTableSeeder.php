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
	    $user->user_name = 'jillharvard';
	    $user->first_name = 'Jill';
	    $user->last_name = 'Harvard';
	    $user->email = 'jill@harvard.edu';
	    $user->password = \Hash::make('helloworld');
	    $user->save();

	    $user = \App\User::firstOrCreate(['email' => 'jamal@harvard.edu']);
	    $user->user_name = 'jamalharvard';
	    $user->first_name = 'Jamal';
	    $user->last_name = 'Harvard';
	    $user->email = 'jamal@harvard.edu';
	    $user->password = \Hash::make('helloworld');
	    $user->save();

	    $user = \App\User::firstOrCreate(['email' => 'rebekah.heacock+test1@gmail.com']);
	    $user->user_name = 'rebekah1';
	    $user->first_name = 'RebekahOne';
	    $user->last_name = 'HJOne';
	    $user->email = 'rebekah.heacock+test1@gmail.com';
	    $user->password = \Hash::make('helloworld');
	    $user->save();

	    $user = \App\User::firstOrCreate(['email' => 'rebekah.heacock+test2@gmail.com']);
	    $user->user_name = 'rebekah2';
	    $user->first_name = 'RebekahTwo';
	    $user->last_name = 'HJTwo';
	    $user->email = 'rebekah.heacock+test2@gmail.com';
	    $user->password = \Hash::make('helloworld');
	    $user->save();

	}
}
