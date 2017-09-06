@extends('store.layouts.main')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-4 col-sm-offset-1">
            <div class="login-form">
            <h2>Entre com sua conta</h2>
                        
                    <form  method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}

                        

                                <input id="email" type="email" class="form-group{{ $errors->has('email') ? ' has-error' : '' }}" name="email" value="{{ old('email') }}" placeholder="Email" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                           
                        

                        
                            
                                <input id="password" type="password" placeholder="Senha" class="form-group{{ $errors->has('password') ? ' has-error' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                           
                       

                      

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Login
                                </button>

                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    Esqueceu a senha?
                                </a>
                            </div>
                        </div>
                    </form>
                
            </div>
        </div>
        <div class="col-sm-1">
                    <h2 class="or">OU</h2>
                </div>
                <div class="col-sm-4">
                    <div class="signup-form"><!--sign up form-->
                        <h2>Crie uma nova conta!</h2>
                        <form action="#">
                            <input type="text" placeholder="Name"/>
                            <input type="email" placeholder="Email Address"/>
                            <input type="password" placeholder="Password"/>
                            <button type="submit" class="btn btn-default">Signup</button>
                        </form>
                    </div><!--/sign up form-->
                </div>
    </div>

    
</div>
@endsection
