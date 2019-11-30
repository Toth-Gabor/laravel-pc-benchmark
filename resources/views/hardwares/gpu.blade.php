<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@include('includes.head')

<body>

@include('includes.nav')
@include('includes.benchmarkNav')

<div class="container-fluid">
    <h1>Test Gpu</h1>
    <h3>Gpu count: {{{ sizeof($gpuAndAvgScoreList) }}}</h3>
    <div class="table">
        <table class="table-bordered">
            <tr>
                <th>Id</th>
                <th>GPU Model</th>
                <th>Average Score</th>
                <th>Action</th>
            </tr>
            @foreach($gpuAndAvgScoreList as $gpu)
                <tr>
                    <td>{{{ $gpu->gpu_id }}}</td>
                    <td>{{{ $gpu->model }}}</td>
                    <td>{{{ round($gpu->avg_score, 2) }}}</td>
                    <td><a href="{{{ action('HardwareController@showScoreChart', ['id' => $gpu->gpu_id]) }}}"
                           class="btn btn-info">Select</a></td>
                </tr>
            @endforeach
        </table>
    </div>
</div>

</body>
</html>
