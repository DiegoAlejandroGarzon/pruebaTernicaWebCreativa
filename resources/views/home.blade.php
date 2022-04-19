@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">DahBoard</div>

                <div class="card-body">
                    <div id="reporteEstados" style="width: 100%;height: 400px;margin: 0;padding: 0;"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script type="text/javascript" src="{{asset('js/dashBoard.js')}}"></script>
<script src="https://cdn.anychart.com/releases/8.11.0/js/anychart-core.min.js"></script>
<script src="https://cdn.anychart.com/releases/8.11.0/js/anychart-pie.min.js"></script>         
@endsection
