@extends('layouts.auth')

@section('htmlheader_title')
    Register
@endsection

@section('content')

    <body class="hold-transition register-page">
    <div align="center">
			<img src=" {{URL::to('img/2.jpg')}}" 
	style="width: 100%;
    height: 100%;
    position: absolute;
    top: 0;
    left: 0;
    z-index: -5000;">
   
    </div>
    <div class="register-box" style="float: right; margin-right: 10%;">
        <div class="register-logo">
             <a href="{{ url('https://github.com/WISPBill') }}"><b>WISP</b>Bill</a>
        </div>

        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="register-box-body">
            <p class="login-box-msg">Register a new membership</p>
            <form action="{{ url('/register') }}" method="post" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group has-feedback">
                    <input type="text" class="form-control" placeholder="Full name" name="name" value="{{ old('name') }}"/>
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="email" class="form-control" placeholder="Email" name="email" value="{{ old('email') }}"/>
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
						  <div class="form-group has-feedback">
                    <input type='tel' class="form-control" placeholder="Phone Number 000-000-0000" name="phone" value="{{ old('phone') }}"/>
                    <span class="glyphicon glyphicon-earphone form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" class="form-control" placeholder="Password" name="password"/>
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" class="form-control" placeholder="Retype password" name="password_confirmation"/>
                    <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
                </div>
                    <div class="form-group has-feedback">
                  <select class="form-control" name="skin" required>
					<option value='' selected disabled>Please Select a Skin</option>
                    <option value="skin-blue">Blue</option>
                    <option value="skin-blue-light">Light Blue</option>
                    <option value="skin-yellow">Yellow</option>
                    <option value="skin-yellow-light">Light Yellow</option>
                    <option value="skin-green">Green</option>
                    <option value="skin-green-light">Light Green</option>
                    <option value="skin-purple">Purple</option>
                    <option value="skin-purple-light">Light Purple</option>
                    <option value="skin-red">Red</option>
                    <option value="skin-red-light">Light Red</option>
                    <option value="skin-black">Black</option>
                    <option value="skin-black-light">White</option>
                  </select>
                </div>
						 
                    <div class="form-group has-feedback">
                    <label class="control-label">JPEG Profile Picture</label>
                    <input type="file" name="img" id="file">
                </div>
                <div class="row">
                    
                    <div class="col-xs-4">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
                    </div><!-- /.col -->
                </div>
            </form>

         

            <a href="{{ url('/login') }}" class="text-center">I already have a membership</a>
        </div><!-- /.form-box -->
    </div><!-- /.register-box -->

    @include('layouts.partials.scripts_auth')

    <script>
        $(function () {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' // optional
            });
        });
        
    </script>
            <div style="position: fixed; bottom: 0; width: 98%;">
	<p style="font-size: 8pt; float: right; color: black;">"Cell Tower" by <a href="http://www.flickr.com/photos/ervins_strauhmanis/" style="color: black;">Ervins Strauhmanis</a> available under a 
    	<a href="http://creativecommons.org/licenses/by/2.0/deed.en" style="color: black;"> Creative Commons Attribution 2.0 Generic </a></p>
	</div>	
</body>

@endsection
