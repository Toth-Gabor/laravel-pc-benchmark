<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@include('includes.head')

<body>

@include('includes.nav')
@include('includes.benchmarkNav')

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
                    <td>
                        <a href="{{{ action('HardwareController@showScoreChart',
                            ['id' => $ram->ram_id, 'avg_score' => round($ram->avg_score, 2)]) }}}"
                           class="btn btn-info">Select</a>
                        <a href="{{{ action('ComputerController@store',
                            ['id' => $ram->ram_id, 'avg_score' => round($ram->avg_score, 2)]) }}}"
                           class="btn-info btn">Add to your Computer</a>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
</div>

</body>
</html>
