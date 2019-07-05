@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>Pagar por el monitoreo de un Dispositivo</h4>
                </div>
                <div class="card-body">
                    <p>Elige el tipo de pago que deseas realizar, al finalizar la trasaccion podras elegir a que dispositivo asignar el pago</p>
                    <hr>
                    <a mp-mode="dftl" href="https://www.mercadopago.com/mla/checkout/start?pref_id=38459944-a2a0f886-f169-46d0-af47-c5596a69bfd9" name="MP-payButton" type="button" class="btn btn-primary mb-2 btn-lg btn-block">Pagar por 30 dias de monitoreo</a>
                    <p>
                        Por 30 dias de monitoreo el costo es de $850 Ars ($28.3Ars/dia).
                    </p>
                    <hr>
                    <a mp-mode="dftl" href="https://www.mercadopago.com/mla/checkout/start?pref_id=38459944-6acb9d81-9f31-425d-96e7-87fc30aa78b6" name="MP-payButton" type="button" class="btn btn-primary mb-2 btn-lg btn-block">Pagar por 60 dias de monitoreo</a>
                    <p>
                        Por 60 dias de monitoreo el costo es de $1400 Ars ($23.3Ars/dia).
                    </p>
                    <hr>
                    <a mp-mode="dftl" href="https://www.mercadopago.com/mla/checkout/start?pref_id=38459944-9de6faea-8209-45af-9b69-7db272459580" name="MP-payButton" type="button" class="btn btn-primary mb-2 btn-lg btn-block">Pagar por 360 dias de monitoreo</a>
                    <p>
                        Por 360 dias de monitoreo el costo es de $7800 Ars ($21.6Ars/dia).
                    </p>
                    <hr>
                    <a href="https://www.mercadopago.com/mla/debits/new?preapproval_plan_id=4ca3459697b64d22a309a1f129b8b78a" type="button" class="btn btn-primary mb-2 btn-lg btn-block">Suscribirme a debito automatico</a>
                    <p>
                        Si te adheris a debito automatico el costo mensual es de $650 Ars ($21.6Ars/dia).
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('pie')

    <script type="text/javascript">
    (function(){function $MPC_load(){window.$MPC_loaded !== true && (function(){var s = document.createElement("script");s.type = "text/javascript";s.async = true;s.src = document.location.protocol+"//secure.mlstatic.com/mptools/render.js";var x = document.getElementsByTagName('script')[0];x.parentNode.insertBefore(s, x);window.$MPC_loaded = true;})();}window.$MPC_loaded !== true ? (window.attachEvent ?window.attachEvent('onload', $MPC_load) : window.addEventListener('load', $MPC_load, false)) : null;})();
    </script>

    <script type="text/javascript">
    (function(){function $MPC_load(){window.$MPC_loaded !== true && (function(){var s = document.createElement("script");s.type = "text/javascript";s.async = true;s.src = document.location.protocol+"//secure.mlstatic.com/mptools/render.js";var x = document.getElementsByTagName('script')[0];x.parentNode.insertBefore(s, x);window.$MPC_loaded = true;})();}window.$MPC_loaded !== true ? (window.attachEvent ?window.attachEvent('onload', $MPC_load) : window.addEventListener('load', $MPC_load, false)) : null;})();
    </script>

    <script type="text/javascript">
        (function() {
            function $MPC_load() {
                window.$MPC_loaded !== true && (function() {
                    var s = document.createElement("script");
                    s.type = "text/javascript";
                    s.async = true;
                    s.src = document.location.protocol + "//secure.mlstatic.com/mptools/render.js";
                    var x = document.getElementsByTagName('script')[0];
                    x.parentNode.insertBefore(s, x);
                    window.$MPC_loaded = true;
                })();
            }
            window.$MPC_loaded !== true ? (window.attachEvent ? window.attachEvent('onload', $MPC_load) : window.addEventListener('load', $MPC_load, false)) : null;
        })();
    </script>

@endsection