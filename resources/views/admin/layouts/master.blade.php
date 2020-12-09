<!--
=========================================================
Material Dashboard - v2.1.2
=========================================================

Product Page: https://www.creative-tim.com/product/material-dashboard
Copyright 2020 Creative Tim (https://www.creative-tim.com)
Coded by Creative Tim

=========================================================
The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software. -->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="{{asset('UI/assets/img/apple-icon.png')}}">
  <link rel="icon" type="image/png" href="{{asset('UI/assets/img/favicon.png')}}">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>{{ config('app.name', 'Laravel') }}</title>

  <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  
  <!-- CSS Files -->
  <link href="{{asset('UI/assets/css/material-dashboard.css?v=2.1.2')}}" rel="stylesheet" />
</head>

<body class="">

    @include('admin.layouts.sidebar')
    @include('admin.layouts.header')
    <div class="content">
        <div class="container-fluid">
            @yield('content')
        </div>
    </div>
    @include('admin.layouts.footer')


<!--   Core JS Files   -->
<script src="{{asset('UI/assets/js/core/jquery.min.js')}}"></script>
<script src="{{asset('UI/assets/js/core/popper.min.js')}}"></script>
<script src="{{asset('UI/assets/js/core/bootstrap-material-design.min.js')}}"></script>
<script src="{{asset('UI/assets/js/plugins/perfect-scrollbar.jquery.min.js')}}"></script>


<script>
$(document).ready(function() {
  // Javascript method's body can be found in assets/js/demos.js
  md.initDashboardPageCharts();

});
</script>
<script type="text/javascript">
  //format date
   $(document).ready(function(){
      $("#datepicker").datetimepicker({
          format: 'YYYY-MM-DD'
      });
  }); 


  const checkMorn = document.getElementById('checkMorn');
  
  checkMorn.addEventListener( 'change', function() {
      const checkBoxes = document.querySelectorAll("#check");
      const timesArr = document.querySelectorAll("#allTimes");
      const end = Math.round(checkBoxes.length/2);
      if(this.checked) {
          for(let i = 0; i < end; i++){
              checkBoxes[i].classList.add('active');
              timesArr[i].checked = true;
          }
      }else{
          for(let i = 0; i < end; i++){
              checkBoxes[i].classList.remove('active');
              timesArr[i].checked = false;
          }
      }
  });

  //check Afternoon boxes
  const checkArvo = document.getElementById('checkArvo');

  checkArvo.addEventListener( 'change', function() {
      const checkBoxes = document.querySelectorAll("#check");
      const timesArr = document.querySelectorAll("#allTimes");
      const start = Math.round(checkBoxes.length/2);
      
      if(this.checked) {
          for(let i = start; i < checkBoxes.length; i++){
              checkBoxes[i].classList.add('active');
              timesArr[i].checked = true;
          }
      }else{
          for(let i = start; i < checkBoxes.length; i++){
              checkBoxes[i].classList.remove('active');
              timesArr[i].checked = false;
          }
      }
  });

  

</script>
</body>
</html>