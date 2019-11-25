@extends('layouts.app')
@section('title')
Edit RelocationStore #{{ $relocationstore->id }}
@endsection
@section('content')
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">RelocationStore</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    @include('layouts.admin_partial.alert')
    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                  Edit RelocationStore #{{ $relocationstore->id }}
                </div>
                <div class="panel-body">
                    <a href="{{ url('/relocation-stores') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                    <br />
                    <br />

                    @if ($errors->any())
                        <ul class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif

                    {!! Form::model($relocationstore, [
                        'method' => 'PATCH',
                        'url' => ['/relocation-stores', $relocationstore->id],
                        'files' => true
                    ]) !!}

                    @include ('relocation-stores.form', ['formMode' => 'edit'])

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('footer-script')
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBzC94pnwIAUI5G3HQKxFCnFBiDiHIIfJk&libraries=places"></script>
<script type="text/javascript">
    function initialize() {
        var input = document.getElementById('autocomplete');
        var autocomplete = new google.maps.places.Autocomplete(input);
        google.maps.event.addListener(autocomplete, 'place_changed', function () {
            var place = autocomplete.getPlace();
            console.log(place);
            // document.getElementById('city2').value = place.name;
            document.getElementById('lat').value = place.geometry.location.lat();
            document.getElementById('lng').value = place.geometry.location.lng();

        });
    }
    google.maps.event.addDomListener(window, 'load', initialize); 
</script>
@endsection