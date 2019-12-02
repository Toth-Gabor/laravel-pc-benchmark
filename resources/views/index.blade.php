<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@include('includes.head')

<body>

@include('includes.nav')

<h1>Computer</h1>
<div class="container-fluid">
    <p>Built status: {{{ $status ?? '' }}}</p>
    <p>Gamer score: {{{ $scores['gamer'] ?? '' }}}</p>
    <p>Workstation score: {{{ $scores['work'] ?? ''}}}</p>
    <p>Desktop score: {{{ $scores['desk'] ?? ''}}}</p>
</div>
@foreach($computer as $part)
    <div class="container-fluid">
        @if (is_array($part) && !empty($part))

            <p>Storages, count({{{ sizeof($part) }}})</p>
            <div class="container-fluid">
                @foreach($part as $storage)
                    <div class="row ">
                        <p>{{{ $storage->getPartType() }}}</p>
                        <div class="col">
                            <a href="{{{ action('ComputerController@remove',
                            ['id' => $storage->getId(), 'type' => $storage->getPartType()]) }}}" class="btn-block ">Remove</a>
                            <p>{{{ 'Id: ' . $storage->getId() }}}</p>
                            <p>{{{ 'Brand: ' . $storage->getBrand() }}}</p>
                            <p>{{{ 'Model: ' . $storage->getModel() }}}</p>
                            <p>{{{ 'Score: ' . $storage->getScore() }}}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        @elseif (!is_array($part) && !empty($part))
            <div class="container-fluid">
                <div class="row ">
                    <p>{{{ $part->getPartType() }}}</p>
                    <div class="col">
                        <a href="{{{ action('ComputerController@remove',
                            ['id' => $part->getId(), 'type' => $part->getPartType()]) }}}" class="btn-block ">Remove</a>
                        <p>{{{ 'Id: ' . $part->getId() }}}</p>
                        <p>{{{ 'Brand: ' . $part->getBrand() }}}</p>
                        <p>{{{ 'Model: ' . $part->getModel() }}}</p>
                        <p>{{{ 'Score: ' . $part->getScore() }}}</p>
                    </div>
                </div>
            </div>
        @endif
    </div>

@endforeach

</body>
</html>
