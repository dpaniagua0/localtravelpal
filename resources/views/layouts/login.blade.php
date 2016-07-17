<!-- Modal -->
<div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
         <form role="form" method="POST" action="{{ url('/login') }}">
                        {!! csrf_field() !!}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <input type="email" class="form-control" name="email" value="{{ old('email') }}"
                                placeholder="Email">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <input type="password" class="form-control" name="password"
                                placeholder="Password">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                        </div>

                       
                        <div class="form-group">
                                <button type="submit" class="btn btn-default btn-block">
                                    LOGIN
                                </button>

                                <a class="btn btn-link forgot-password" href="{{ url('/password/reset') }}">Forgot Your Password?</a>
                        </div>
                    </form>
      </div>
    </div>
  </div>
</div>