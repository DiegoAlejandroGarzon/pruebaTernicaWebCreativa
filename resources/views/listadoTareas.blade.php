@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md">
            <div class="card">
                <div class="card-header">TABLA DE TAREA</div>

                <div class="card-body py-3">
                    <table id="tablaTareas" class="table display responsive nowrap">
                        <thead class="thead-dark">
                            <tr>
                                <th ></th>
                                <th >Nombre</th>
                                <th >Fecha Inicio</th>
                                <th >Fecha Fin</th>
                                <th >Estado</th>
                                <th >Acciones</th>
                            </tr>
                        </thead>
                        <tbody style="color:black"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modalEdit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Edición de tarea</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body" id="contenidoModalEdicion">
            <div class="card-body py-3">
                <div class="mb-3">
                    <input type="text" id="id" name="id" hidden>
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
                </div>
            </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" id="guardarEdicion">Guardar</button>
    </div>
    </div>
</div>
</div>
@endsection

@section('scripts')
<script type="text/javascript" src="{{asset('js/homeWorkList.js')}}"></script>
@endsection