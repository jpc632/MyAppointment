
<footer class="footer">
    <div class="container-fluid">
      <nav class="float-left">
        <ul>
          <li>
            <a href="https://www.creative-tim.com">
              Creative Tim
            </a>
          </li>
          <li>
            <a href="https://creative-tim.com/presentation">
              About Us
            </a>
          </li>
          <li>
            <a href="http://blog.creative-tim.com">
              Blog
            </a>
          </li>
          <li>
            <a href="https://www.creative-tim.com/license">
              Licenses
            </a>
          </li>
        </ul>
      </nav>
      <div class="copyright float-right">
        &copy;
        <script>
          document.write(new Date().getFullYear())
        </script>
      </div>
    </div>
  </footer>
</div>
</div>
<div class="fixed-plugin">

</div>
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
