<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@include('includes.head')

<body>

@include('includes.nav')
@include('includes.hardwareNav')

<h1>Computer</h1>

<p>{{{ $testVar }}}</p>


</body>
</html>
