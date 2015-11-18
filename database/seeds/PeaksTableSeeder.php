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
		    $peak = new \App\Peak();
			$peak->created_at = Carbon\Carbon::now()->toDateTimeString();
			$peak->updated_at = Carbon\Carbon::now()->toDateTimeString();
	      	$peak->name = $row[0];
	        $peak->elevation = $row[1];
	        $peak->prominence = $row[2];
	        $peak->location = $row[3];
	        $peak->state = $row[4];
	        $peak->range = $row[5];
	        $peak->forecast_link = $row[6];
	        $peak->description_link = $row[7];
	        $peak->save();
		});
		$peakscsv = database_path() . '/seeds/peaks.csv';
		$lexer->parse($peakscsv, $interpreter);
    }
        
}
