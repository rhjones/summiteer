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

	    $user = \App\User::firstOrCreate(['email' => 'rebekah.heacock+test1@gmail.com']);
	    $user->username = 'rebekah1';
	    $user->firstname = 'RebekahOne';
	    $user->lastname = 'HJOne';
	    $user->email = 'rebekah.heacock+test1@gmail.com';
	    $user->password = \Hash::make('helloworld');
	    $user->save();

	    $user = \App\User::firstOrCreate(['email' => 'rebekah.heacock+test2@gmail.com']);
	    $user->username = 'rebekah2';
	    $user->firstname = 'RebekahTwo';
	    $user->lastname = 'HJTwo';
	    $user->email = 'rebekah.heacock+test2@gmail.com';
	    $user->password = \Hash::make('helloworld');
	    $user->save();

	}
}
