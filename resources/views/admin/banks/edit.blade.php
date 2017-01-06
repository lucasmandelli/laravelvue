@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">

            <h5>Editar Banco {{ $bank->name }}</h5>

            {!! Form::model($bank, [
                    'route' => ['admin.banks.update', 'bank' => $bank->id],
                    'method' => 'PUT',
                    'files' => true
                ]) !!}

                @include('admin.banks._form')

            {!! Form::close() !!}
        </div>
    </div>
@endsection