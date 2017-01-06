@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <h5>Novo Banco</h5>

            {!! Form::open(['route' => 'admin.banks.store', 'files' => true]) !!}

                @include('admin.banks._form')

            {!! Form::close() !!}
        </div>
    </div>
@endsection