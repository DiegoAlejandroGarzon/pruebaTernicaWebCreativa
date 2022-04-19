@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">CREAR TAREA</div>

                <div class="card-body">
                    <form class="was-validated" id="formTarea">
                        <div class="mb-3">
                            <label for="nombre">Nombre de la tarea</label><br>
                            <input id="nombre" name="nombre" type="text" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="fechaInicio">Fecha de inicio</label><br>
                            <input id="fechaInicio" name="fechaInicio" type="text" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="fechaFin">Fecha de fin</label><br>
                            <input id="fechaFin" name="fechaFin" type="date" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="estado" >Estado</label><br>
                            <select name="estado" id="estado" class="custom-select" required>
                                    <option value="INICIADA">INICIADA</option>
                                    <option value="EN PROCESO">EN PROCESO</option>
                                    <option value="CANCELADA">CANCELADA</option>
                                    <option value="COMPLETADA">COMPLETADA</option>
                            </select>
                        </div>
                    </form>
                    <button class="btn btn-primary btn-lg btn-block" id="newHomeWork">Registrar nueva tarea</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="{{asset('js/newHomeWork.js')}}"></script>
@endsection
