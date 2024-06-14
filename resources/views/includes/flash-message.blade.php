<div id="autoTimeOut"> 
  @if($errors->any())
      <div class="alert absolte_alert alert-danger alert-dismissible" onClick= "this.remove();">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          <h4><i class="icon fa fa-ban"></i> Error!</h4>
          <ul>
              @foreach($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
  @endif
  @if(session()->has('success') or session()->has('warning') or session()->has('info') or session()->has('danger') or session()->has('error'))
  <div class="flash-message" onClick= "this.remove();">
      @foreach (['danger', 'warning', 'success', 'info','error'] as $msg)
          @if(session()->has($msg))
              <p class="alert absolte_alert  alert-{{ $msg }}">{{ session()->get($msg)}} <a href="javascript:void(0)" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
          @endif
      @endforeach
  </div> <!-- end .flash-message -->
  @endif
  </div>
   <script type="text/javascript">
     setTimeout(function() {
            $("#autoTimeOut").fadeOut(1500);
          }, 5000);
  
  </script>