<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@include('includes.head')

<body>

@include('includes.nav')

<h1>Test DB</h1>

@foreach($testVar as $var)
    <?php var_dump($var) ?>
@endforeach


</body>
</html>
