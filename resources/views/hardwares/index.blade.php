<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@include('includes.head')

<body>

@include('includes.nav')
@include('includes.hardwareNav')


<h1>Test Hardwares</h1>

<p>{{{ $test }}}</p>


</body>
</html>
