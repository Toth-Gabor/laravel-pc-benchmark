<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@include('includes.head')

<body>

@include('includes.nav')
@include('includes.hardwareNav')

<div class="container-fluid">
    <h1>Test Ram</h1>
    <h3>Ram count: {{{ sizeof($ramAndAvgScoreList) }}}</h3>
    <div class="table">
        <table class="table-bordered">
            <tr>
                <th>Id</th>
                <th>RAM Model</th>
                <th>Average Score</th>
                <th>Action</th>
            </tr>
            @foreach($ramAndAvgScoreList as $ram)
                <tr>
                    <td>{{{ $ram->ram_id }}}</td>
                    <td>{{{ $ram->model }}}</td>
                    <td>{{{ round($ram->avg_score, 2) }}}</td>
                    <td><a href="{{{ action('HardwareController@showScoreChart', ['id' => $ram->ram_id]) }}}"
                           class="btn btn-info">Select</a></td>
                </tr>
            @endforeach
        </table>
    </div>
</div>

</body>
</html>
