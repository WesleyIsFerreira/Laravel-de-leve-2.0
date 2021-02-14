@extends('layout.base')

@section('body')


<div class="row justify-content-center" style="margin-top: 10%">
    <div class="col-md-3 align-self-center border border-5 bg-light text-dark">
        <main class="text-center form-signin ">
            <form action="/usuarios" method="POST">
            @csrf
            <h1 class="h3 mb-3 fw-normal">Teste de Leve</h1>
            <label for="login" class="visually-hidden">Login</label>
            <input type="text" name="login" id="login" class="form-control" placeholder="Login" required autofocus>
            <label for="inputPassword" class="visually-hidden">Password</label>
            <input type="password" name="inputPassword" id="inputPassword" class="form-control" placeholder="Password" required>
            
            <button class="w-100 btn btn-lg btn-primary" style="margin-top: 20px" type="submit">Sign in</button>
            <p class="mt-5 mb-3 text-muted">&copy; 2021</p>
            </form>
        </main>
    </div>
</div>

    
    
@endsection

@section('javascript')
<script>
    @if ($errors->any())
    cuteToast({
        type: "warning",
        message: "Login:wesley | Senha:123",
        timer: 5000
    })
    @endif
</script>
    
@endsection