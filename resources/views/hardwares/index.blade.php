<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@include('includes.head')

<body>
@include('includes.nav')
@include('includes.benchmarkNav')
@include('includes.hardwareNav')



<h1>Hardware</h1>

<p>{{{ $test }}}</p>


</body>
</html>
