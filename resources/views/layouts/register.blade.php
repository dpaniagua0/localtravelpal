<!-- Modal -->
<div class="modal fade" id="register-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-md4" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <h1>Sign In</h1>
        <br> 
  <a href="/auth/facebook"  class="fb-login-btn"  data-show-faces="false" data-auto-logout-link="false">
   <i class="fa fa-facebook"></i> Sign In with Facebook
  </a>
        <br>
        <legend>OR</legend>
         <form role="form" method="POST" action="{{ url('/register') }}">
                        {!! csrf_field() !!}

                         <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <input type="text" class="form-control name-icon" name="name"
                                placeholder="Name">

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <input type="email" class="form-control email-icon" name="email" placeholder="Email">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <input type="password" class="form-control password-icon" name="password"
                                placeholder="Password">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                        </div>

                       
                        <div class="form-group mb-5">
                                <button type="submit" class="btn btn-default btn-block">
                                    SIGN UP
                                </button>

                        </div>
                        <p class="terms-text">By creating an account, you confirm that you accept out <a>TERMS OF SERVICE</a></p>
                    </form>
      </div>
    </div>
  </div>
</div>