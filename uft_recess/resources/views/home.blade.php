@extends('layouts.app')

@section('content')
<head>
<style type="text/css">
    body {
        background-size: 100%;
        background-image:url("/images/e2.jpg");
        background-repeat:no-repeat;
    }
    .panel-body {
        background-size: 100%;
        background-image:url("/images/e2.jpg");
        color:#fff;
    }
   .logo{
        height:5px;
        text-align:center;
    }
</style>
</head>
<body>
    <div class="row">
        <div class="col-md-10">
            <div class="panel panel-default">
                <div class="panel-heading">Admin Dashboard</div>

                <div class="panel-body">
                <span class="logo">
               
               <img src="/images/logo.png">
  
               </span>
                </div>
                  <!-- /.content-wrapper -->
  <footer class="main-footer" >
  
  <div class="pull-right hidden-xs">
    <b>UFT</b> 
  </div>
  <strong>Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved @unitedfrontfortransformation.</strong> 
</footer>

            </div>
        </div>
    </div>
    </body>
@endsection
