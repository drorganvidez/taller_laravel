@extends('layouts.app')

@isset($edit)
    @section('title', 'Editar nota: '.$note->title)
@else
    @section('title', 'Crear nota')
@endisset

@section('title-icon', 'fas fa-sticky-note')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="/{{$instance}}">Home</a></li>
    <li class="breadcrumb-item active">@yield('title')</li>
@endsection

@section('content')

    <div class="row">

        <div class="col-md-12">

            <div class="card shadow-sm">

                <div class="card-body">

                    @isset($edit)

                        <form method="POST" action="{{route('note.edit_p',\Instantiation::instance())}}">

                    @else

                        <form method="POST" action="{{route('note.create_p',\Instantiation::instance())}}">

                    @endisset

                    <form method="POST" action="{{route('note.create_p',\Instantiation::instance())}}">

                        @csrf

                        @isset($edit)

                            <input type="hidden" name="note_id" value="{{$note->id}}" />

                        @endisset

                        <div class="form-row">

                            <x-input col="6" attr="title" :value="$note->title ?? ''" label="Título" description="Escribe un título para tu nota"/>

                        </div>

                        <div class="form-row">

                            <x-input col="6" attr="body" :value="$note->body ?? ''" label="Cuerpo" description="Escribe un contenido para tu nota"/>

                        </div>

                        <div class="form-row">
                            <div class="col-lg-4 mt-1">
                                <button type="submit"  class="btn btn-primary btn-block">

                                    <i class="fas fa-sticky-note"></i>

                                    @isset($edit)

                                        Guardar

                                    @else

                                        Crear

                                    @endif

                                    nota
                                </button>
                            </div>
                        </div>

                    </form>

                </div>

            </div>

        </div>
    </div>


@endsection
