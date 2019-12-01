<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@include('includes.head')
<head>
    <script type="text/javascript">
        window.onload = function () {
            let scoreList = <?php echo json_encode($scoreList); ?>;
            //console.log(scoreList);

            var chart = new CanvasJS.Chart("chartContainer", {
                animationEnabled: true,

                theme: "light2",
                title: {
                    text: '{{{ $hardware->getPartType() . ' Scores Chart'}}}'
                },
                axisX: {


                },
                axisY: {

                    includeZero: true
                },
                data: [{
                    type: "bar",
                    dataPoints: scoreList
                }]
            });
            chart.render();
        }
    </script>
    <title>Cpu</title>
</head>
<body>
@include('includes.nav')
@include('includes.benchmarkNav')

<div class="container-fluid">
    <h1>{{{ $hardware->getPartType() . '  Chart'}}}</h1>
    <h3>{{{ $hardware->getbrand() . ' ' . $hardware->getModel() }}}</h3>
    <h3>{{{ 'This ' . $hardware->getPartType() . ' average score is: ' . $avg_score }}}</h3>
    <h3>{{{  "It's installed in " . $computerFittedWith . ' computers!' }}}</h3>
    <div>
        <a href="{{{ action('ComputerController@store', ['id' => $hardware->getId(), 'avg_score' => $avg_score]) }}}" class="btn-info btn">Add to your Computer</a>
    </div>


    <div id="chartContainer" style="width: 100%;"></div>
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</div>
</body>
</html>
