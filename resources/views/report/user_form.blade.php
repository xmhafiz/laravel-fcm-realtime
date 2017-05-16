@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <!-- put contents in panel -->
        <h2><span class="glyphicon glyphicon-comment"></span> Submit Report</h2>
        <div class="panel panel-default">
            <div class="panel-body">
                <form class="form-horizontal" method="post" action="{{ route('report.store') }}">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Title</label>
                        <div class="col-sm-8">
                            <input type="text" name="report_title" class="form-control" placeholder="Enter Report Title" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Report Description</label>
                        <div class="col-sm-8">
                            <textarea name="report_description" class="form-control" rows="10" required placeholder="Enter Report Detail"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Map Location</label>
                        <div class="col-sm-8">
                            <input id="pac-input" class="controls" type="text" placeholder="Type Location..">
                            <div id="map" style="height: 300px"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Location Address</label>
                        <div class="col-sm-8">
                            <input id="place-address" type="text" name="address" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Coordinate</label>
                        <div class="col-sm-8">
                            <input id="place-coordinate" type="text" name="coordinate" class="form-control" readonly>

                            <input type="hidden" id="lat">
                            <input type="hidden" id="lng">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-6">
                            <button type="submit" class="btn btn-success">Submit Now</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection


@section('scripts')
<script>

// google maps and getting coordinate listner
function initMap() {

    var kualaLumpur = {lat: 3.1465167, lng: 101.6978024}
    var map = new google.maps.Map(document.getElementById('map'), {
        center: kualaLumpur,
        zoom: 16
    });

    var input = /** @type {!HTMLInputElement} */ (
        document.getElementById('pac-input'));

    map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

    var autocomplete = new google.maps.places.Autocomplete(input);
    autocomplete.bindTo('bounds', map);

    var infowindow = new google.maps.InfoWindow();
    autocomplete.addListener('place_changed', function() {

        var marker = new google.maps.Marker({
            map: map,
            anchorPoint: new google.maps.Point(0, -29),
            position: map.center,
            title: 'Media Prima Berhad'
        });

        infowindow.close();
        marker.setVisible(true);
        var place = autocomplete.getPlace();
        if (!place.geometry) {
            window.alert("Autocomplete's returned place contains no geometry");
            return;
        }

        // If the place has a geometry, then present it on a map.
        if (place.geometry.viewport) {
            map.fitBounds(place.geometry.viewport);
        } else {
            map.setCenter(place.geometry.location);
            map.setZoom(17); // Why 17? Because it looks good.
        }
        marker.setIcon( /** @type {google.maps.Icon} */ ({
            url: place.icon,
            size: new google.maps.Size(71, 71),
            origin: new google.maps.Point(0, 0),
            anchor: new google.maps.Point(17, 34),
            scaledSize: new google.maps.Size(35, 35)
        }));
        marker.setPosition(place.geometry.location);
        marker.setVisible(true);

        var address = '';
        if (place.address_components) {
            address = [
            (place.address_components[0] && place.address_components[0].short_name || ''),
            (place.address_components[1] && place.address_components[1].short_name || ''),
            (place.address_components[2] && place.address_components[2].short_name || '')
            ].join(' ');
        }

        // popup on marker
        infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address);
        infowindow.open(map, marker);

        // update textfield
        var placeAddress = place.name, address;
        var placeCoords = place.geometry.location.lat() + ',' + place.geometry.location.lng();

        $('#place-coordinate').val(placeCoords);
        $('#place-address').val(placeAddress);

    });
}
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC7agwlerw2gHZVLp5wJCRHR1eKbQrs41k&libraries=places&callback=initMap" async defer></script>

@endsection
