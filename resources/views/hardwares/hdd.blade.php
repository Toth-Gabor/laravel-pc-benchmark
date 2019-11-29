<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@include('includes.head')

<body>

@include('includes.nav')
@include('includes.hardwareNav')

<div class="container-fluid">
    <h1>Test HDD</h1>
    <h3>HDD count: {{{ sizeof($hddAndAvgScoreList) }}}</h3>
    <div class="table">
        <table class="table-bordered">
            <tr>
                <th>Id</th>
                <th>HDD Model</th>
                <th>Average Score</th>
                <th>Action</th>
            </tr>
            @foreach($hddAndAvgScoreList as $hdd)
                <tr>
                    <td>{{{ $hdd->hdd_id }}}</td>
                    <td>{{{ $hdd->model }}}</td>
                    <td>{{{ round($hdd->avg_score, 2) }}}</td>
                    <td><a href="{{{ action('HardwareController@showScoreChart', ['id' => $hdd->hdd_id]) }}}"
                           class="btn btn-info">Select</a></td>
                </tr>
            @endforeach
        </table>
    </div>
</div>

</body>
</html>
