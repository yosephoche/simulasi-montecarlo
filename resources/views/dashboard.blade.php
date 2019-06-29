@extends('layouts.master')
@section('content')
    <!-- MAIN CONTENT -->
    <div class="main-content">
        <div class="container-fluid">
            <!-- OVERVIEW -->
            <div class="panel panel-headline">
                <div class="panel-heading">
                    <h3 class="panel-title">Weekly Overview</h3>
                    <p class="panel-subtitle">Period: Oct 14, 2016 - Oct 21, 2016</p>
                </div>
                <div class="panel-body">
                    <div class="row">
                        
                    </div>

                    <div class="row">
                        
                    </div>
                </div>
            </div>
            <!-- END OVERVIEW -->

            <!-- INPUTS -->
            <div class="row">
                <div class="col-md-6">
                    <!-- TABLE STRIPED -->
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">Table Distribusi Permintaan</h3>
                        </div>
                        <form action="/" method="post" id="form">
                        @csrf
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <input class="form-control" type="number" id="one" placeholder="permintaan">
                                </div>
                                <div class="col-md-4">
                                    <input class="form-control" type="number" id="two" placeholder="frekuensi">
                                </div>
                                <div class="col-md-4">
                                    <button type="button" id="add" class="btn btn-primary">Add</button>
                                    <!-- <button type="button" id="update" class="btn btn-primary">Update</button><br><br> -->
                                </div>
                            </div>
                            <table class="table table-hover" id="permintaan">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Permintaan perhari</th>
                                        <th>Frekuensi</th>
                                    </tr>
                                </thead>
                                <tbody id="data">
                                </tbody>                                       
                            </table>
                            <br>
                            <hr>
                            <h4>Pembangkit Bilangan Random</h4>
                            <div class="input-group">
                                <span class="input-group-addon">a</span>
                                <input class="form-control" type="number" name="a">
                            </div><br>
                            <!-- <div class="input-group">
                                <span class="input-group-addon">c</span>
                                <input class="form-control" type="number" name="c">
                            </div><br> -->
                            <div class="input-group">
                                <span class="input-group-addon">m</span>
                                <input class="form-control" type="number" name="m">
                            </div><br>
                            <div class="input-group">
                                <span class="input-group-addon">Z</span>
                                <input class="form-control" type="number" name="z">
                            </div><br>
                                <div class="input-group">
                                <span class="input-group-addon">Jumlah Iterasi</span>
                                <input class="form-control" type="number" name="iterasi">
                            </div><br>
                            <button type="submit" id="generate" class="btn btn-primary">Simulate</button><br><br>
                        </div>
                        </form>
                    </div>

                    
                    <!-- END TABLE STRIPED -->
                </div>
                <div class="col-md-6">
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">Table Distribusi Data</h3>
                        </div>
                        <div class="panel-body">
                            <table class="table table-hover" id="permintaan">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Permintaan perhari</th>
                                        <th>Frekuensi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data_distribusi as $key => $value)
                                    <tr>
                                        <td>{{ $key + 1}}</td>
                                        <td>{{ $value['permintaan'] }}</td>
                                        <td>{{ $value['frekuensi'] }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">Table Hasil Simulasi</h3>
                        </div>
                        <div class="panel-body">
                            <table class="table table-hover" id="permintaan">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Bilangan Acak</th>
                                        <th>Kebutuhan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($random as $key => $value)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $value['bilangan'] }}</td>
                                        <td>{{ $value['kebutuhan'] }} Pasang</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                         <div class="panel">
                            <div class="panel-heading">
                                <h3 class="panel-title">Diagram Hasil Simulasi</h3>
                            </div>
                            <div class="panel-body">
                                <div id="simulasi-chart" class="ct-chart"></div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-md-6">
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">Table Interval Bilangan Acak</h3>
                        </div>
                        <div class="panel-body">
                            <table class="table table-hover" id="interval">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Permintaan perhari</th>
                                        <th>Probabilitas</th>
                                        <th>Kumulatif Distribusi</th>
                                        <th>Interval Bilangan Acak</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data_interval as $key => $value)
                                    <tr>
                                        <td>{{$key + 1}}</td>
                                        <td>{{$value['permintaan']}} pasang</td>
                                        <td>{{$value['probabilitas']}}</td>
                                        <td>{{$value['kumulatif']}}</td>
                                        <td>{{$value['interval']['from']}} - {{$value['interval']['to']}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="panel">
                            <div class="panel-heading">
                                <h3 class="panel-title">Diagram Probabilitas Kumulatif</h3>
                            </div>
                            <div class="panel-body">
                                <div id="interval-chart" class="ct-chart"></div>
                            </div>
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
    var newone=[]
    var newtwo=[]

    $("#add").click(function (e) {
        e.preventDefault();
        var one=document.getElementById('one').value
        var two=document.getElementById('two').value
        newone.push(one);
        newtwo.push(two);
        listshow();
    });

    function listshow() {
        var list=""
        for(var i=0;i<newone.length;i++){
            list+= "<tr><td>"+(i+1)+"</td>"+"<td> <input type='hidden' value="+ newone[i] +" name='permintaan[]'>"+newone[i]+"</td>"+"<td> <input type='hidden' value="+ newtwo[i] +" name='frekuensi[]'>"+newtwo[i]+"</td>"+"</tr>"
        }
        document.getElementById('data').innerHTML=list
    }
    var table = $("#permintaan");
</script>

<script>
    var interval_data = {!! json_encode($chart_interval) !!};
    console.log(interval_data);
	$(function() {
		var options;
		var data = {
			labels: interval_data.label,
			series: [
				interval_data.series,
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

		new Chartist.Line('#interval-chart', data, options);
	
		// bar chart
		options = {
			height: "300px",
			axisX: {
				showGrid: false
			},
		};

	});
</script>

<script>
    var simulasi_data = {!! json_encode($chart_simulasi) !!};
    console.log(simulasi_data);
	$(function() {
		var options;
		var data = {
			labels: simulasi_data.label,
			series: [
				simulasi_data.series,
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

		new Chartist.Line('#simulasi-chart', data, options);
	
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