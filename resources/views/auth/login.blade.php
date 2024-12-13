<style>
  *{
    font-family: "Poppins", sans-serif;
  }
.body {
    width: 100%;
    height: 100vh;
    margin: 0;
    font-size: 16px;
  }
    form {
    width: 30vw;
    max-width: 700px;
    min-width: 500px;
    background-color: #e7e7e7;
    margin: 20px auto 10px;
    padding:1em 2em;
    border: 0.1px solid rgb(212, 212, 212);
    border-radius: 25px;
    overflow: none;
    box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.4);
}
  
  /* Header for Login */
  .title {
  font-size: 31px;
  font-weight: 70px;
  color: #1D2A32;
  margin-bottom: 6px;
  text-align: center;
}
.headerImg {
  width: 80px;
  height: 80px;
  align-self: center;
  display: block;
  margin: 18px auto;
}
  h1 {
    text-align: center;
  }
  fieldset {
    border: none;
    padding: 2rem 0;
    /* background-color: red; */
  }
  label{
    margin: 0.5rem ;
    display: block; 
    font-size: 16px;
    font-weight: bold;
    margin-bottom: 18px;
  }
  .inputLabel {
  font-size: 17px;
  font-weight: 600px;
  color: #222;
  margin-bottom: 5px;
  display: block;
}
input[type="email"],input[type="password"] {
  height: 50;
  background-color: #fff4b4;
  width: 100%;
  border-radius: 12px;
  font-size: 15px;
  font-weight: 500px;
  color: #222;
  border-width: 1;
  border-color: #C9D3DB;
  border-style: solid;
}
  /* input {
    margin: 10px 25px 0 25px;
    width: 90%;
    min-height: 2em;
    display: relative;
    border: 1px solid #0a0a23;
    border-radius: 5px;
  } */
  button{
  flex-direction: row;
  align-items: center;
  color: whitesmoke;
  justify-content: center;
  border-radius: 15px;
  padding: 10px 20px;
  width: 100%;
  font-weight: bold;
  border-width: 1px;
  background-color: #00a859;
  margin-bottom: 20px;
  /* border-color: #00a859; */
  }
  button:hover { 
      cursor: pointer;
      background-color: white;
      color: #00a859;
      border: 1px solid #00a859;
      border-radius: 15px;
      transition-duration: 1s;
  }
  
  .register-link {
    text-align: center;
    margin-top: 15px;
    font-size: 14px;
  }
  
  .register-link a {
    color: #00a859;
    text-decoration: none;
    font-weight: bold;
  }
  
  .register-link a:hover {
    text-decoration: underline;
  }

</style>

<div class="card-body">
  <form method="POST" action="{{ route('login') }}">
    <img src="{{ asset('CapLogo.png') }}" alt="Car Rental Tracking Logo" class="headerImg"/>
    <p class="title">Log In To <span style="color: #00a859;display:block">Vehicle Rental Tracker</span></p>
    @csrf
    <fieldset>

      <div class="row mb-3">
        <label for="email"><span class="inputLabel">{{ __('Email Address') }}</span>
          <div class="col-md-6">
            <input id="email" type="email" class="inputControl @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
            @error('email')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
        </label>
      </div>

      <div class="row mb-3">
        <label for="password" id="password"><span class="inputLabel">{{ __('Password') }}</span>
          <div class="col-md-6">
            <input id="password" type="password" class="inputControl @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
            @error('password')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
        </label>
      </div>

      <div class="row mb-3">
        <div class="col-md-6 offset-md-4">
          <div class="form-check">
            <label class="form-check-label" for="remember">
              {{ __('Remember Me') }}
              <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
            </label>
          </div>
        </div>
      </div>
      
      <div class="row mb-0">
        <div class="col-md-8 offset-md-4">
          <button id="submit" type="submit" class="">
            {{ __('Login') }}
          </button>
          @if (Route::has('password.request'))
          <a class="btn btn-link" href="{{ route('password.request') }}">
            {{ __('Forgot Your Password?') }}
          </a>
          @endif
          <a style="float:right;text-decoration: none;" class="btn btn-link" href="{{ route('register') }}">
  {{ __('Sign-Up') }}
</a>
        </div>
      </div>
    </fieldset>
  </form>
</div>
           

