@if(isset($errors) && $errors->any())
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-md-10">
                        <div class="alert alert-danger">
                            <button class="close" type="button" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <ul>
                                @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            @if(session()->has('success'))
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-md-10">
                        <div class="alert alert-success">
                            <button class="close" type="button" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <ul>
                                @foreach(session()->get('success') as $message)
                                <li>{{ $message }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            @if(session()->has('impersonated_by'))
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-md-10">
                        <div class="alert alert-success">
                            <button class="close" type="button" data-dismiss="alert" aria-hidden="true">&times;</button>
                            Usted se encuentra navegando como el usuario {{ auth()->user()->name }}. Click <a href="{{ route('impersonate.stop') }}">aqui</a> para recuperar su sesion.
                        </div>
                    </div>
                </div>
            </div>
            @endif