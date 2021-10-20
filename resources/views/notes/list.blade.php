@extends('layouts.app')

@section('title', 'Mis notas')

@section('title-icon', 'fas fa-sticky-note')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="/{{$instance}}">Home</a></li>
    <li class="breadcrumb-item active">@yield('title')</li>
@endsection

@section('content')

    <div class="row">
        <div class="col-lg-12">

            <div class="card shadow-lg">

                <div class="card-body">
                    <div class="table-responsive">
                        <table id="dataset" class="table table-hover table-responsive">
                            <thead>
                            <tr>
                                <th class="d-none d-sm-none d-md-table-cell d-lg-table-cell">ID</th>
                                <th class="d-none d-sm-none d-md-table-cell d-lg-table-cell">Título</th>
                                <th class="d-none d-sm-none d-md-table-cell d-lg-table-cell">Contenido</th>
                                <th class="d-none d-sm-none d-md-table-cell d-lg-table-cell">Editada</th>
                                <th class="d-none d-sm-none d-md-table-cell d-lg-table-cell">Creada</th>
                                <th class="d-none d-sm-none d-md-table-cell d-lg-table-cell">Opciones</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($notes as $note)
                                <tr>
                                    <td class="d-none d-sm-none d-md-table-cell d-lg-table-cell">{{$note->id}}</td>
                                    <td><a href="{{route('note.view',['instance' => $instance, 'id' => $note->id])}}">{{$note->title}}</a></td>
                                    <td>{{$note->body}}</td>

                                    <td class="d-none d-sm-none d-md-table-cell d-lg-table-cell"> {{ \Carbon\Carbon::parse($note->updated_at)->diffForHumans() }} </td>


                                    <td class="d-none d-sm-none d-md-table-cell d-lg-table-cell"> {{ \Carbon\Carbon::parse($note->created_at)->diffForHumans() }} </td>

                                    <td class="align-middle">
                                        <a class="btn btn-primary btn-sm" href="{{route('note.view',['instance' => $instance, 'id' => $note->id])}}">
                                            <i class="fas fa-eye"></i>
                                            <span class="d-none d-sm-none d-md-none d-lg-inline"></span>
                                        </a>

                                        <a class="btn btn-info btn-sm" href="{{route('note.edit',['instance' => $instance, 'id' => $note->id])}}">
                                            <i class="fas fa-pencil-alt">
                                            </i>
                                            <span class="d-none d-sm-none d-md-none d-lg-inline"></span>
                                        </a>


                                        <a class="btn btn-danger btn-sm" href="#" data-toggle="modal" data-target="#modal-remove-{{$note->id}}">

                                            <i class="fas fa-trash"></i> <span class="d-none d-sm-none d-md-none d-lg-inline"> </span>

                                        </a>

                                        <div class="container" style="display: inline; padding: 0px">
                                            <div class="modal fade" id="modal-remove-{{$note->id}}">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content" style="overflow: visible">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title text-wrap">¿Seguro?</h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">×</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body text-wrap">
                                                            <p>La nota se borrará</p>
                                                        </div>
                                                        <div class="modal-footer justify-content-between">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                                            <button type="button" onclick="event.preventDefault(); document.getElementById('buttonconfirm-form-{{$note->id}}').submit();" class="btn btn-danger" data-dismiss="modal">
                                                                <i class="fas fa-trash"></i> &nbsp;Sí, eliminar
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <form id="buttonconfirm-form-{{$note->id}}" action="{{route('note.remove',$instance)}}" method="POST" style="display: none;">
                                               @csrf
                                                <input type="hidden" name="note_id" value="{{$note->id}}">
                                            </form>
                                        </div>


                                    </td>

                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>

            </div>

        </div>

    </div>

@endsection
