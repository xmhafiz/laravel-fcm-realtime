@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <!-- put contents in panel -->
        <h2 class="text-primary"><span class="glyphicon glyphicon-comment"></span> Submit Report</h2>
        <span class="text-danger"><ul id="error-messages"></ul></span>
        <div class="panel panel-default">
            <div class="panel-body">
                <form class="form-horizontal" method="post" action="{{ route('report.store') }}">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Title</label>
                        <div class="col-sm-8">
                            <input type="text" name="report_title" class="form-control" placeholder="What happenend?" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Report Description</label>
                        <div class="col-sm-8">
                            <input type="text" name="report_description" class="form-control" placeholder="Enter Details" required>
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
                        <div class="col-sm-4">
                            <input type="text" id="lat" class="form-control" name="latitude" readonly placeholder="Latitude">
                            <input type="text" id="lng" class="form-control" name="longitude" readonly placeholder="Longitude">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-6">
                            <button id="submit-button" type="submit" class="btn btn-primary">Submit Now</button>
                        </div>
                    </div>
                    <div class="alert alert-success" style="display:none">
                        <strong>Thank you!</strong> Your report has been successfully submitted.
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
        var placeAddress = place.name + ', '  + address;

        $('#lat').val(place.geometry.location.lat());
        $('#lng').val(place.geometry.location.lng());
        $('#place-address').val(placeAddress);

    });
}

// processing submission
$(document).ready(function() {
    $('form').on('submit', function(e) {
        e.preventDefault()

        // clear state
        $('#error-messages').empty();

        $('#submit-button').button('loading');

        // get submit url
        var url = $(this).attr('action');

        // setup form data
        var formData = new FormData(this);
        console.log('saving..');

        // send post
        axios.post(url, formData)
        .then(function(response){
            // when success
            $('.alert-success').show();

            // reset form
            $('form')[0].reset();

            // remove loading
            $('#submit-button').button('reset');
            // debug
            console.log('saved successful');
        })
        .catch(function (error) {
            // debug
            console.log(error);

            // remove loading
            $('#submit-button').button('reset');

            if (error.response) {
                // bad request form
                if (error.response.status == 422) {
                    var errors = error.response.data;

                    $(errors).each(function(i, row) {
                        $('#error-messages').append('<li>' + row + '</li>');
                    });
                }
            }
        });
    })

    // hide success and error message on editing 
    $(document).on("click","input[type='text']", function(){             
        $('#error-messages').empty();
        $('.alert-success').hide();
    });
})


</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC7agwlerw2gHZVLp5wJCRHR1eKbQrs41k&libraries=places&callback=initMap" async defer></script>

@endsection
