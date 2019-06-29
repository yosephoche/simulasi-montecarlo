@extends('layouts.master')
@section('content')
<!-- MAIN CONTENT -->
<div class="main-content">
	<div class="container-fluid">
		<h3 class="page-title">Charts</h3>

		<div class="row">
			<div class="col-md-6">
				<div class="panel">
					<div class="panel-heading">
						<h3 class="panel-title">Line Chart</h3>
					</div>
					<div class="panel-body">
						<div id="demo-line-chart" class="ct-chart"></div>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="panel">
					<div class="panel-heading">
						<h3 class="panel-title">Bar Chart</h3>
					</div>
					<div class="panel-body">
						<div id="demo-bar-chart" class="ct-chart"></div>
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-6">
				<div class="panel">
					<div class="panel-heading">
						<h3 class="panel-title">Area Chart</h3>
					</div>
					<div class="panel-body">
						<div id="demo-area-chart" class="ct-chart"></div>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="panel">
					<div class="panel-heading">
						<h3 class="panel-title">Multiple Chart</h3>
					</div>
					<div class="panel-body">
						<div id="multiple-chart" class="ct-chart"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- END MAIN CONTENT -->
@endsection
@section('js')
<script>
	var data2 = {!! json_encode($data) !!};
    console.log(data2.label);
	$(function() {
		var options;
		var data = {
			labels: data2.label,
			series: [
				data2.series,
			]
		};

		// line chart
		options = {
			height: "300px",
			showPoint: true,
			axisX: {
				showGrid: false
			},
			lineSmooth: false,
		};

		new Chartist.Line('#demo-line-chart', data, options);
	
		// bar chart
		options = {
			height: "300px",
			axisX: {
				showGrid: false
			},
		};

	});
</script>
@endsection