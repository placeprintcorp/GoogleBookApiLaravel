<!DOCTYPE html>
<html>
<head>
<title>Test</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="data:image/x-icon;base64,AAABAAEAEBAAAAAAAABoBQAAFgAAACgAAAAQAAAAIAAAAAEACAAAAAAAAAEAAAAAAAAAAAAAAAEAAAAAAAAAAAAAhuj8AHLa+wDXx34A67V2APfVhwDr6uoA9/X0APv8+QD37KoA9eOzAOPNhgD39/cA3JYxAEmz5wBOx/kA9+ePAPGeOwDc3NkAhuP7APGqQwD35qMA7rVWAPbihQDr1YkA9MxoAPf08AD9/v0A7u/uAO/v7gDl5OQA/KsfANbV1QD28OsA5MByAOTe1ADyn2MA9stbAPv26wD37aEA7e/vAP7+/gDum28A+fr5APbpnAD19vQA3dzbAPDJpADa0s4A4NzbAG/Z+QDomkkA4ch+AO/ioADXsnIA6enoANLW1AD36I8A7unoAP/+/wD21H0A+6ZAAPXs6AD3+PgA8ePQAPj4+AD17aMA8rRkAN6QFADp5uEA4dKNAPfmlgDn5+cA5dvPAFnL+gD18vEA19HTAN/f3QDWzc4A9eKJAPT09AD48ewA7stnAPLrogDywVoA9tyjAOrk4AD5nlkA+fTkANbU1AD7/PcA////AOe4hQD55YoA2tbXANTS0gBSxPcA/f39APfjqQD+/f0A7eahAODf3wD265sAr9zyAOTKhQD55JYA+uiTAPnjgAD29/YA9u+pAPHz8QDnxXIA3cuLAHzg+gDu69YAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAHigcHTcjAAAAAAAAAAAASAYAAAAtZTAAAAAAAAAAAG4AAAAAABtWGgdYCkcXCQApRVAAbE0xEitjQDVrXTliAABOSyBZXy5bO1FcBGkQLAAAQT84TF4IW2FaJW1tahUAAABBckk6IT4mFCptZicAAAAADB9SNg1EMyIvU0JPAAAAAFU8VBFDbzQDRmQZAAAAAAAFPVckFhgLcGhnAAAAAAAAAAAAAAAADmAPcQEAAAAAAAAAAAAAAABKMgITAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAP//AAD//wAAgf8AADj/AAB8AQAAEAAAAMAAAADAAAAA4AEAAOABAADgAwAA4AcAAP+DAAD/wwAA//8AAP//AAA=" rel="icon" type="image/x-icon" />
    <!-- BEGIN: Theme CSS-->
     <!-- BEGIN: Vendor CSS-->
     <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>

<script src="{{url('assets/js/jquery-2.2.4.min.js')}}" ></script>

<!-- Bootstrap files (jQuery first, then Popper.js, then Bootstrap JS) -->
<link href="{{url('assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
<script src="{{url('assets/js/bootstrap.bundle.min.js')}}" type="text/javascript"></script>
 <link href="{{url('/assets/plugins/bootstrap-sweetalert/sweetalert.css')}}" rel="stylesheet" type="text/css" />
<!-- <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"> -->
<!-- Custom Theme files -->
    <link href="{{ url('css/app.css') }}" type="text/css" rel="stylesheet"/>
<link href="{{url('css/style.css')}}" rel="stylesheet" type="text/css" media="all" />


</head>
<body>

@include('layouts.header')
<!-- Wrapper Start -->
<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
<input type="hidden" name="url" id="url" value="{{ URL::to('/') }}">
@if(session('success')) <div class="alert alert-success"> {{session('success')}} </div> @endif 
@if(session('error')) <div class="alert alert-danger"> {{session('error')}} </div> @endif 

  @yield('content')
  
<script src="{{ url('js/app.js') }}" type="text/javascript"></script>
   
@include('layouts.footer')





