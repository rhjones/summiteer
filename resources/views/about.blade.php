@extends('layouts.master')

@section('title', 'About Summitteer')

@section('content')

	<div class="container">

		<h1>Welcome to Summiteer</h1>
		<p>Summitteer helps you log your hikes as you work toward joining the <a href="http://www.amc4000footer.org/">AMC 4000 Footer Club</a> by hiking all 48 of the <a href="/peaks">4000-foot peaks</a> in New Hampshire’s White Mountains. Summiteer helps you track which peaks you've climbed and when, mileage, and notes (on things like gear, companions, trail(s) used, weather, and trail conditions).</p>

		<p>You can log hikes publicly (in which case, they'll show up on the page for an individual peak; the 10 most recent public hikes are listed on the home page) or privately (in which case, they're only viewable by you).</p>

		<p>Read enough? <a href="{{ Auth::check() ? '/log' : '/login' }}">Start tracking.</a>

		<h1>4000 Footers</h1>
		<p>The 4000 Footers are a group of 67 peaks in New England with an elevation of more than 4000 feet and a <a href="https://en.wikipedia.org/wiki/Four-thousand_footers#Prominence_criterion">prominence</a> of at least 200 feet. Summiteer focuses on the <a href="/peaks">48 4000 footers in New Hampshire's White Mountains</a>.</p> 

		<p>For more on the 4000 Footers, check out:</p>

		<ul>
			<li><a href="http://www.amc4000footer.org/">AMC 4000 Footer Club</a></li>
			<li><a href="http://4000footers.com/">4000footers.com</a></li>
			<li><a href="http://home.earthlink.net/~ellozy/nh-4000-footers.html">New Hampshire 4000 Footers</a></li>
		</ul>

		<h1>Behind the Scenes</h1>
		<p>Summiteer was built by <a href="https://github.com/rebekahheacock">Rebekah Heacock Jones</a> for the Harvard Extension School's <a href="http://dwa15.com">CSCI E-15 Dynamic Web Applications</a> class in the Fall of 2015.</p>

		<p>Summiteer is written in PHP using the <a href="http://laravel.com/">Laravel</a> framework. All of the Summiteer code is available on <a href="https://github.com/rebekahheacock/summiteer">GitHub</a>.</p>

		<p>Photo on the home page taken on <a href="/peaks/10">Mount Moosilauke</a> by Rebekah Heacock Jones.</p>
		
		<p>Mountain icon used in the Summiteer logo by <a href="https://thenounproject.com/term/mountains/70650/">Julien Meysmans via The Noun Project</a>.</p>


	</div>

@stop
