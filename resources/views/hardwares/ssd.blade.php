<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@include('includes.head')

<body>

@include('includes.nav')
@include('includes.benchmarkNav')

<div class="container-fluid">
    <h1>Test SSD</h1>
    <h3>SSD count: {{{ sizeof($ssdAndAvgScoreList) }}}</h3>
    <div class="table">
        <table class="table-bordered">
            <tr>
                <th>Id</th>
                <th>SSD Model</th>
                <th>Average Score</th>
                <th>Action</th>
            </tr>
            @foreach($ssdAndAvgScoreList as $ssd)

                <tr>
                    <td>{{{ $ssd->ssd_id }}}</td>
                    <td>{{{ $ssd->model }}}</td>
                    <td>{{{ round($ssd->avg_score, 2) }}}</td>
                    <td><a href="{{{ action('HardwareController@showScoreChart', ['id' => $ssd->ssd_id]) }}}"
                           class="btn btn-info">Select</a></td>
                </tr>
            @endforeach
        </table>
    </div>
</div>

</body>
</html>
