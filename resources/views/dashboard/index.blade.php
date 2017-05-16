@extends('layouts.admin')
@section('content')
<div class="row">
	<div class="col-md-12">
		<h2>Dashboard</h2>
		<p>Manage your every things here</p>
		<hr>
		<h3>Overview <small>Today's Events</small></h3>
		<div class="row">
			<div class="col-md-3">
				<div class="panel panel-blue">
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-3">
								<h1><span class="glyphicon glyphicon-th-list"></span></h1>
							</div>
							<div class="col-xs-9 text-right">
								<div class="huge">26</div>
								<div>Total Reports</div>
							</div>
						</div>
					</div>
					<a href="#">
						<div class="panel-footer">
							<span class="pull-left">View Details</span>
							<span class="pull-right glyphicon glyphicon-cog"></span>
							<div class="clearfix"></div>
						</div>
					</a>
				</div>
			</div>
			<div class="col-md-3">
				<div class="panel panel-red">
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-3">
								<h1><span class="glyphicon glyphicon-flag"></span></h1>
							</div>
							<div class="col-xs-9 text-right">
								<div class="huge">12</div>
								<div>Very Urgent</div>
							</div>
						</div>
					</div>
					<a href="#">
						<div class="panel-footer">
							<span class="pull-left">View Details</span>
							<span class="pull-right glyphicon glyphicon-cog"></span>
							<div class="clearfix"></div>
						</div>
					</a>
				</div>
			</div>
			<div class="col-md-3">
				<div class="panel panel-yellow">
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-3">
								<h1><span class="glyphicon glyphicon-align-left"></span></h1>
							</div>
							<div class="col-xs-9 text-right">
								<div class="huge">26</div>
								<div>Pending</div>
							</div>
						</div>
					</div>
					<a href="#">
						<div class="panel-footer">
							<span class="pull-left">View Details</span>
							<span class="pull-right glyphicon glyphicon-cog"></span>
							<div class="clearfix"></div>
						</div>
					</a>
				</div>
			</div>
			<div class="col-md-3">
				<div class="panel panel-green">
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-3">
								<h1><span class="glyphicon glyphicon-ok-sign"></span></h1>
							</div>
							<div class="col-xs-9 text-right">
								<div class="huge">12</div>
								<div>Solved</div>
							</div>
						</div>
					</div>
					<a href="#">
						<div class="panel-footer">
							<span class="pull-left">View Details</span>
							<span class="pull-right glyphicon glyphicon-cog"></span>
							<div class="clearfix"></div>
						</div>
					</a>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-8">
				<h3>Report Spots <small>32 found</small></h3>
				<div id="map" style="height:500px"></div>
			</div>
			<div class="col-md-4">
				<h3>Recents</h3>
				<ul class="list-group">
					<li class="list-group-item">
						<h4 class="list-group-item-heading">List group item heading</h4>
						<p class="list-group-item-text">Cras justo odio de lorem ipsum</p>
					</li>
					<li class="list-group-item">
						<h4 class="list-group-item-heading">List group item heading</h4>
						<p class="list-group-item-text">Cras justo odio de lorem ipsum</p>
					</li>
					<li class="list-group-item">
						<h4 class="list-group-item-heading">List group item heading</h4>
						<p class="list-group-item-text">Cras justo odio de lorem ipsum</p>
					</li>
					<li class="list-group-item">
						<h4 class="list-group-item-heading">List group item heading</h4>
						<p class="list-group-item-text">Cras justo odio de lorem ipsum</p>
					</li>
				</ul>
			</div>
		</div>
	</div>
</div>
@endsection

@section('scripts')
<script>
// The following code creates markers in Kuala Lumpur based on report API using a DROP animation
var map;

function initMap() {
	var kualaLumpur = {lat: 3.1465167, lng: 101.6978024}
	map = new google.maps.Map(document.getElementById('map'), {
		zoom: 14,
		center: kualaLumpur
	});

	var marker = new google.maps.Marker({
		map: map,
		// draggable: true,
		animation: google.maps.Animation.DROP,
		position: {lat: 3.1465167, lng: 101.6978024},
	});
}

function addMarkerAt(latitude, longitude) {
	
}

</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC7agwlerw2gHZVLp5wJCRHR1eKbQrs41k&callback=initMap"></script>
@endsection
