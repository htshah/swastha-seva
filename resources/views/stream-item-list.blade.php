@extends('layouts.main')

@section('title','Listing |')

@section('styles')
<script src='https://api.mapbox.com/mapbox-gl-js/v0.47.0/mapbox-gl.js'></script>
<link href='https://api.mapbox.com/mapbox-gl-js/v0.47.0/mapbox-gl.css' rel='stylesheet' />
<style>

    .data-list{
        height: -webkit-fill-available;
    }
    .collection{
        border:0;
    }

    .collection-item .title{
        font-size:16px;
        font-weight: 500;
        color: #424242;
    }

    #map{
        height: -webkit-fill-available;
        width: 100%;
    }
</style>
@endsection


@section('main-content')
<div class="row no-margin">
    <div class="col l4 white grey-text data-list" style="overflow:auto;">
        <ul class="collection data-list-collection no-margin">
            <li class="collection-item center-align">
                <span class="title">No data found in Blockchain.</span>
            </li>
        </ul>
    </div>
    <div class="col l8 my-map no-padding">
        <div id='map' ></div>
    </div>
</div>
@endsection

@section('scripts')
    @include('templates.data-list')
    <script src="{{ asset('/js/mustache.min.js') }}"></script>
    <script>
        $(document).ready(function(){

            fetchData();
            $("select[name='state']").change(updateCity);

            function updateCity(){
                var state = $("select[name='state']").val();
                $.ajax({
                    url:`/api/state/${state}/city`,
                    type:"GET",
                    success:function(data){
                        $("select#city").html(
                            `<option value="*" selected>All Cities</option>`+
                            Mustache.render("@{{#cities}}<option value='@{{city}}'>@{{city}}</option>@{{/cities}}",{cities:data})
                        );
                    }
                });
            }

            $('#btn-filter-apply').click(fetchData);

            function fetchData(){
                $.ajax({
                    url:"/api/blockchain/stream/view/demo4",
                    type:"POST",
                    data:$("#filter-form").serializeArray(),
                    success:function(data){
                        console.log(data);
                        var template = $("#data-list-template").html();
                        $(".data-list-collection").html(Mustache.render(template,data));
                        placeMarkers();
                    }
                });
            
            }
        });
    </script>

    <script type="text/javascript">
            //Google Maps init
            var address = "400091";
            var lat = 0;
            var lng = 0;
            
            
            
            //Mapbox init
            mapboxgl.accessToken = 'pk.eyJ1Ijoia2JvdGFkcmEiLCJhIjoiY2prMmtkbmI1MHFzdzN3bzJvOHBxZHFjNSJ9.uTgQrRxqcK01my_InEwGMA';
            var map = new mapboxgl.Map({
                container: 'map',
                style: 'mapbox://styles/kbotadra/cjk2khuq73r692rnvemc1fh2q',
                center: [78.591799, 22.546046],
                zoom: 5
            });


            /* isfeteched = false;
            $.getJSON(url, function(data){
                lat = data.results[0].geometry.location.lat;
                lng = data.results[0].geometry.location.lng;
                console.log(lng);  
                isfeteched = true;
            });
            var counter = 0;
            var interval = setInterval(function() {
                counter++;
                if (isfeteched == true) {
                    var marker = new mapboxgl.Marker()
                        .setLngLat([lng, lat])
                        .addTo(map);
                    clearInterval(interval);
                }
            }, 1000); */
            
            function placeMarkers(){
                var count = 0;
                $('.data-list-collection li').each(function(){
                    count++;
                    var data = $.parseJSON($(this).find('p').html());
                    var address = data.pincode;
                    
                    var url = "https://maps.googleapis.com/maps/api/geocode/json?address="+address+"&key=AIzaSyDBsEajGK8Lev3hgGDh679rwlhOPiZiwNU";
                    
                    $.getJSON(url, function(data){
                        if(data.status != 'OK'){
                            console.log(address);
                            return false;
                        }
                        var lat = data.results[0].geometry.location.lat;
                        var lng = data.results[0].geometry.location.lng;

                        new mapboxgl.Marker()
                            .setLngLat([lng, lat])
                            .addTo(map);
                    });

                    
                });

                console.log('Count: '+count);
            }
        </script>
@endsection