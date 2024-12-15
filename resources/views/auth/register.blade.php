<style>
  @import url('https://fonts.googleapis.com/css?family=Montserrat:400,800');
  
  * {
    box-sizing: border-box;
  }
  
  body {
    background: #f6f5f7;
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    font-family: 'Montserrat', sans-serif;
    height: 100vh;
    margin: -20px 0 50px;
  }
  
  h1 {
    font-weight: bold;
    margin: 0;
  }
  
  h2 {
    text-align: center;
  }
  
  p {
    font-size: 14px;
    font-weight: 100;
    line-height: 20px;
    letter-spacing: 0.5px;
    margin: 20px 0 30px;
  }
  
  .inputLabel {
   font-size: .875rem;
   color: #222;
   display: block;
   text-align: left;
  }
  
  span {
    font-size: 12px;
  }
  
  a {
    color: #333;
    font-size: 14px;
    text-decoration: none;
    margin: 15px 0;
  }
  
  button {
    border-radius: 20px;
    border: 1px solid #F2eee3;
    background: transparent;
    color: black;
    font-size: 12px;
    font-weight: bold;
    padding: 12px 45px;
    letter-spacing: 1px;
    text-transform: uppercase;
    background-color: #00a859;
    transition-duration: 0.5s;
  }
  
  button:active {
    transform: scale(0.95);
  }
  
  button:focus {
    outline: none;
  }
  
  button.ghost {
    background-color: transparent;
    border-color: #00a859;
  }
  
  button.ghost:hover {
  cursor: pointer;
    background-color: white;
    color: #00a859;
    border: 1px solid #00a859;
    border-radius: 15px;
  }
  
  .button {
    border-radius: 20px;
    border: 1px solid #F2eee3;
    background-color: #F2eee3;
    color: black;
    font-size: 12px;
    font-weight: bold;
    padding: 12px 45px;
    letter-spacing: 1px;
    text-transform: uppercase;
    transition: transform 80ms ease-in;
    background-color: #00a859;
    transition-duration: 1.5s;
  }
  
  a:active {
    transform: scale(0.95);
  }
  
  a:focus {
    outline: none;
  }
  
  a.ghost {
    background-color: transparent;
  }
  
  a.ghost:hover {
    cursor: pointer;
    background-color: white;
    color: #00a859;
    border: 1px solid #00a859;
    border-radius: 15px;
    transition-duration: 1.5s;
  }
  
  form {
    background-color: #e2e2e2;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
    padding: 0 50px;
    height: 100%;
    text-align: center;
  }
  
  input {
    background-color: #f2eee3;
    border: none;
    padding: 12px 15px;
    margin: 8px 0;
    width: 100%;
    background-color: #fff4b4;
  }
  
  .container {
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 14px 28px rgba(0,0,0,0.25),
        0 10px 10px rgba(0,0,0,0.22);
    position: relative;
    overflow: hidden;
    width: 768px;
    max-width: 100%;
    min-height: 480px;
  }
  
  .form-container {
    position: absolute;
    top: 0;
    height: 100%;
    transition: all 0.6s ease-in-out;
  }
  
  .sign-in-container {
    left: 0;
    width: 50%;
    z-index: 2;
  }
  
  .container.right-panel-active .sign-in-container {
    transform: translateX(100%);
  }
  
  .sign-up-container {
    left: 0;
    width: 50%;
    opacity: 0;
    z-index: 1;
  }
  
  .container.right-panel-active .sign-up-container {
    transform: translateX(100%);
    opacity: 1;
    z-index: 5;
    animation: show 0.6s;
  }
  
  @keyframes show {
    0%, 49.99% {
      opacity: 0;
      z-index: 1;
    }
  
    50%, 100% {
      opacity: 1;
      z-index: 5;
    }
  }
  
  .overlay-container {
    position: absolute;
    top: 0;
    left: 50%;
    width: 50%;
    height: 100%;
    overflow: hidden;
    transition: transform 0.6s ease-in-out;
    z-index: 100;
  }
  
  .container.right-panel-active .overlay-container{
    transform: translateX(-100%);
  }
  
  .overlay {
    background: #F2eee3;
    background: -webkit-linear-gradient(to right, #F2eee3, #e7d4c5);
    background: linear-gradient(to right, #F2eee3, #e7d4c5);
    background-repeat: no-repeat;
    background-size: cover;
    background-position: 0 0;
    color: black;
    position: relative;
    left: -100%;
    height: 100%;
    width: 200%;
      transform: translateX(0);
    transition: transform 0.6s ease-in-out;
  }
  
  .container.right-panel-active .overlay {
      transform: translateX(50%);
  }
  
  .overlay-panel {
    position: absolute;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
    padding: 0 40px;
    text-align: center;
    top: 0;
    height: 100%;
    width: 50%;
    transform: translateX(0);
    transition: transform 0.6s ease-in-out;
  }
  
  .overlay-left {
    transform: translateX(-20%);
  }
  
  .container.right-panel-active .overlay-left {
    transform: translateX(0);
  }
  
  .overlay-right {
    color: #f2eee3;
    right: 0;
    transform: translateX(0);
    background-color: #00a859;
  }
  
  .container.right-panel-active .overlay-right {
    transform: translateX(20%);
  }
  
  
  input[type="checkbox"] {
    -webkit-appearance: checkbox;
       -moz-appearance: checkbox;
            appearance: checkbox;
    display: inline-block;
    width: auto;
  }
  </style>
  
<div class="container" id="container">
  <div class="form-container sign-in-container">
    <form method="POST" action="{{ route('register') }}">
      <img src="{{ asset('CapLogo.png') }}" alt="Car Rental Tracking Logo" class="headerImg" style=" width:50px; height: 50px; margin-bottom: none" />
      <p class="title" style="font-size: 20px;margin: 5px auto 5px;">Register To <span style="color: #00a859;display:block">Vehicle Rental Tracker</span></p>
      @csrf

      <label for="name" ><span class="inputLabel">{{ __('Name') }}</span>
        <input id="name" type="text" class="inputControl @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus/>
          @error('name')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
      </label>

          <label for="email" class="col-md-4 col-form-label text-md-end"><span class="inputLabel">{{ __('Email Address') }}</span>
            <input id="email" type="email" class="inputControl @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
            @error('email')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </label>
      
        <label for="password" class="col-md-4 col-form-label text-md-end"><span class="inputLabel">{{ __('Password') }}</span>
          <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
          @error('password')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </label>
     
      
     
        <label for="password-confirm" class="col-md-4 col-form-label text-md-end"><span class="inputLabel">{{ __('Confirm Password') }}</span>
          <input id="password-confirm" type="password" class="inputControl" name="password_confirmation" required autocomplete="new-password">
        </label>

          <button type="submit" class="btn btn-primary ghost">
            {{ __('Register') }}
          </button>
    </form>
  </div>

  <div class="overlay-container">
    <div class="overlay">
      <div class="overlay-panel overlay-right">
        <h1>Welcome!</h1>
        <p>To Vehicle Rental Tracker</p>
        <a class="button ghost" id="signUp" href="javascript:history.back()" style="color: black; background-color: white;
        border: 1px solid black"> 
        {{ __('<  Back To Log-In') }}</a>
      </div>
    </div>
  </div>
</div>
</div>
