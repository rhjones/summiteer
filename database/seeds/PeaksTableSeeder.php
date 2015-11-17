<?php

use Illuminate\Database\Seeder;
use Goodby\CSV\Import\Standard\Lexer;
use Goodby\CSV\Import\Standard\Interpreter;
use Goodby\CSV\Import\Standard\LexerConfig;

class PeaksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$lexer = new Lexer(new LexerConfig());
		$interpreter = new Interpreter();
		$interpreter->addObserver(function(array $row) {
		    DB::table('peaks')->insert([
	        	'created_at' => Carbon\Carbon::now()->toDateTimeString(),
	        	'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
	        	'name' => $row[0],
	        	'elevation' => $row[1],
	        	'prominence' => $row[2],
	        	'location' => $row[3],
	        	'state' => $row[4],
	        	'range' => $row[5],
	        	'forecast_link' => $row[6],
	        	'description_link' => $row[7],
	        ]);
		});
		$peakscsv = database_path() . '/seeds/peaks.csv';
		$lexer->parse($peakscsv, $interpreter);
    }
        
}
