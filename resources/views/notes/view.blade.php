@extends('layouts.app')

@section('title', 'Nota')

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

                    <h3>{{$note->title}}</h3>

                    <p>
                        {{$note->body}}
                    </p>

                </div>

            </div>

        </div>

    </div>

@endsection
