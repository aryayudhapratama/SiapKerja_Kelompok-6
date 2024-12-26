<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="fonts/icomoon/style.css">

    <link rel="stylesheet" href="css/owl.carousel.min.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    
    <!-- Style -->
    <link rel="stylesheet" href="css/style.css">

    <title>Register Page</title>
  </head>
  <body>
  

  <div class="d-lg-flex half">
    <div class="bg order-1 order-md-2" style="background-image: url('images/bg_4.jpeg');"></div>
    <div class="contents order-2 order-md-1">

      <div class="container">
        <div class="row align-items-center justify-content-center">
          <div class="col-md-7">
            <h3 style="text-align:center"><strong>SiapKerja</strong></h3>
            <p style="text-align:center" class="mb-4">Start Find Your Dream Work</p>


            <form method="POST" action="{{ route('register') }}">
        @csrf
        <form method="POST" action="{{ route('login') }}">
        @csrf
        <!-- NAME -->
              <div class="form-group first">
                <label for="username">Username</label>
                <input type="text" class="form-control block mt-1 w-full" placeholder="Input Your Username Here" id="name" type="text" name="name" :value="old('name')" required autofocus autocomplete="name">
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
              </div>
              <!-- EMAIL ADDRESS -->
              <div class="form-group last mb-3">
                <label for="email">Email</label>
                <input type="email" class="form-control block mt-1 w-full" placeholder="Input Your Email Here" id="email" name="email" :value="old('email')" required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
              </div>

          <!-- ROLE -->
<div class="form-group last mb-3">
    <label for="role">Select Your Role</label>
    <select id="role" name="role" class="form-control block mt-1 w-full" required>
        <option value="" disabled selected>Select Role</option>
        <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User</option>
        <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
    </select>
    <x-input-error :messages="$errors->get('role')" class="mt-2" />
</div>


              <!-- PASSWORD -->
              <div class="form-group last mb-3">
                <label for="password">password</label>
                <input type="password" class="form-control block mt-1 w-full" placeholder="Input Your password Here" id="password" name="password" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
              </div>

               <!-- CONFIRM PASSWORD -->
               <div class="form-group last mb-3">
                <label for="password">password</label>
                <input type="password" class="form-control block mt-1 w-full" placeholder="Input Your Password Confirmation Here" id="password_confirmation" name="password_confirmation" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

              
              <!-- <div class="d-flex mb-5 align-items-center">
                <label class="control control--checkbox mb-0"><span class="caption">Remember me</span>
                  <input type="checkbox" checked="checked"/>
                  <div class="control__indicator"></div>
                </label>
                <span class="ml-auto"><a href="#" class="forgot-pass">Forgot Password</a></span> 
              </div> -->
              <div class="flex items-center justify-end mt-2">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>
              <button type="submit" value="register" class="btn btn-block btn-success mt-3">
              {{ __('Register') }}
              </button>

            </form>
          </div>
        </div>
      </div>
    </div>

    
  </div>
    
    

    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
  </body>
</html>