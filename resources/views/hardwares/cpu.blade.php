<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@include('includes.head')

<body>

@include('includes.nav')
@include('includes.benchmarkNav')

<div class="container-fluid">
    <h1>Test CPU</h1>
    <h3>Cpu count: {{{ sizeof($cpuAndAvgScoreList) }}}</h3>
    <div class="table">
        <table class="table-bordered">
            <tr>
                <th>Id</th>
                <th>CPU Model</th>
                <th>Average Score</th>
                <th>Action</th>
            </tr>
            @foreach($cpuAndAvgScoreList as $cpu)
                <tr>
                    <td>{{{ $cpu->cpu_id }}}</td>
                    <td>{{{ $cpu->model }}}</td>
                    <td>{{{ round($cpu->avg_score, 2) }}}</td>
                    <td><a href="{{{ action('HardwareController@showScoreChart', ['id' => $cpu->cpu_id, 'avg_score' => round($cpu->avg_score, 2)]) }}}"
                           class="btn btn-info">Select</a></td>
                </tr>
            @endforeach
        </table>
    </div>
</div>
</body>
</html>
