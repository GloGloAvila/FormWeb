@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Verifique su correo electrónico') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('Un enlace de verificación ha sido enviado a su correo.') }}
                        </div>
                    @endif

                    {{ __('Antes de continuar, por favor verifique su cuenta de correo.') }}
                    {{ __('Si Ud no ha recibido un correo de verificación') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('clic aquí para enviar un nuevo enlace de verificación') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
