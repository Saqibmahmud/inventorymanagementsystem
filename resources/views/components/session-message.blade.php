@if(session('success'))
  <div class="alert alert-success" id="success-alert">
    {{session('success')}}
  </div>
  @endif
  @if(session('update_success'))
  <div class="alert alert-success" id="success-alert">{{session('update_success')}}</div>
  @endif
    @if(session('delete_success'))
  <div class="alert alert-danger" id="success-alert">{{session('delete_success')}}</div>
  @endif