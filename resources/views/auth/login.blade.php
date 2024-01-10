<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="viewport" content="initial-scale=1, maximum-scale=1">
      <title>Swati Enterprises</title>
      <!-- site icon -->
      <link rel="icon" href="{{ asset('assets/images/fevicon.png')}}" type="image/png" />
      <!-- bootstrap css -->
      <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css')}}" />
      <!-- site css -->
      <link rel="stylesheet" href="{{ asset('assets/style.css')}}" />
      <!-- responsive css -->
      <link rel="stylesheet" href="{{ asset('assets/css/responsive.css')}}" />
      <link rel="stylesheet" href="{{ asset('assets/css/custom.css')}}" />
   </head>
   <body class="inner_page login">
      <div class="full_container">
         <div class="container">
            <div class="center verticle_center full_height">
               <div class="login_section">
                  <div class="logo_login">
                     <div class="center">
                        <img width="210" src="{{ asset('assets/images/logo.png')}}" alt="#" />
                     </div>
                  </div>
                  <div class="login_form">
                    <form action="{{ route('login.post') }}" method="POST">
                        @csrf
                        <fieldset>
                           <div class="field">
                              <label class="label_field">Email Address</label>
                              <input type="email" id="email_address" name="email" placeholder="E-mail" />
                              @if ($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                            @endif
                           </div>
                           <div class="field">
                              <label class="label_field">Password</label>
                              <input type="password" id="password" name="password" placeholder="Password" />
                              @if ($errors->has('password'))
                                <span class="text-danger">{{ $errors->first('password') }}</span>
                            @endif
                           </div>
                           <div class="field">
                              <label class="label_field hidden">hidden label</label>
                              <label class="form-check-label"><input type="checkbox" class="form-check-input"> Remember Me</label>
                              <a class="forgot" href="">Forgotten Password?</a>
                           </div>
                           <div class="field margin_0">
                              <label class="label_field hidden">hidden label</label>
                              <button type="submit"class="main_bt">Sing In</button>
                           </div>
                        </fieldset>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </body>
</html>
