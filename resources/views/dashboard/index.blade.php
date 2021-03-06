@extends('layouts.admin')
@section('content')
<div class="row">
	<div class="col-md-12">
		<h2>Dashboard</h2>
		<p>Manage your everything here 💚</p>
		<hr>
		<div class="row">
			<div class="col-md-8">
				<h3>Report Spots <small id="report-count"></small></h3>
				<div id="map" style="height:500px;background-color:#eee">Loading...</div>
			</div>
			<div class="col-md-4 list-placeholder">
				<h3>Recents</h3>
				<div class="list-content">
					<ul class="list-group"></ul>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('scripts')
<script type="text/javascript" src="{{ asset('js/firebase-app.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/firebase-messaging.js') }}"></script>
<script type="text/javascript" src="{{ asset('firebase-messaging-sw.js') }}"></script>
<script>
// The following code creates markers in Kuala Lumpur based on report API using a DROP animation
var map;

function initMap() {
	var kualaLumpur = {lat: 3.1465167, lng: 101.6978024}
	map = new google.maps.Map(document.getElementById('map'), {
		zoom: 14,
		center: kualaLumpur
	});
}

function addMarkerAt(latitude, longitude) {
	var marker = new google.maps.Marker({
		map: map,
		// draggable: true,
		animation: google.maps.Animation.DROP,
		position: {lat: latitude, lng: longitude},
	});
}

function addToList(data, append = true) {
	var row = '';
	row += '<li class="list-group-item" id="row-' + data.id + '" style="display:none">';
	row += '  <h4 class="list-group-item-heading">' + data.report_title + '</h4>';
	row += '  <p class="list-group-item-text">' + data.address + '</p>';
	row += '  <p class="list-group-item-text text-primary">' + data.created_at_formatted + '</p>';
	row += '</li>';
		
		
	if (append) {
		$('.list-group').append(row);
	}	
	else {
		$('.list-group').prepend(row);
	}

	$('#row-' + data.id).slideToggle('slow');
}

function updateView(json) {
	// this will be called by firebase setBackgroundMessageHandler method or messaging.onMessage
	
	// convert json string to object
	var item = JSON.parse(json.item);

	var lat = parseFloat(item.latitude);
	var lng = parseFloat(item.longitude);

	addMarkerAt(lat, lng);
	addToList(item, false);
	
}

$(document).ready(function() {
	axios.get('/api/reports')
	.then(function(response){
        console.log(response.data);

        if (response.data) {
        	var data = response.data;

        	$('#report-count').html(data.length + ' item(s) found')
        	data.forEach(function(item, index) {
        		
        		// add delay between item
        		setTimeout(function() {
        			var lat = parseFloat(item.latitude);
        			var lng = parseFloat(item.longitude);
        			addMarkerAt(lat, lng);
        			addToList(item)

        		}, 500 * index);
        	})
        }
    })
	.catch(function (error) {
        // debug
        console.log(error);

        if (error.response) {
            // bad request form
            console.log(error.response.status);
            console.log(error.response.data);
        }
    });
})

</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC7agwlerw2gHZVLp5wJCRHR1eKbQrs41k&callback=initMap"></script>
@endsection
