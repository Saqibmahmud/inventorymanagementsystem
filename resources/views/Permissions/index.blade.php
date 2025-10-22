@extends('layout.app')
@section('title', 'Prmissioons List')
@section('content')
 <style>
.margin{
  margin: 10px
}


 </style>
    
<div class="card">
  <div class="card-header">
    <h3 class="card-title">Permissions</h3>
    <a href="{{route('permissions.create')}}" class="btn btn-info float-right">Add Permissons</a>
  </div>
  <x-session-message/>
  <div class="card-body">
  <form method="get" action="{{route('permissions.search')}}" class="mb-3">
  <input type="text" name="query" class="form-control"
         placeholder="Search by name or code">
  <button type="submit" class="btn btn-primary btn-sm margin">Search</button>
</form>
    <table class="table table-bordered table-striped">
      <thead>
        <tr>
          
          <th>Permissions Name</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody id="permission-data">
    @include('Permissions.load_data', ['permissions' => $permissions])
</tbody>
    </table>
    <a href="{{route('dashboard')}}" class="btn btn-secondary mt-3">Back</a>
    <div style="text-align: center;"><button class="btn btn-primary" id="load-more" data-page="1" >Load More</button></div>
    
  </div>
 
</div>
@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function () {

  
  if ($('#success-alert').length) {
    setTimeout(() => {
      $('#success-alert').fadeOut('slow');
    }, 3000);
  }

  
  $('#load-more').click(function () {
    let button = $(this);
    let page = parseInt(button.data('page')) + 1;

    $.ajax({
        url: "{{ route('permissions.index') }}",
        type: 'GET',
        data: { page: page },
        dataType: 'json',
        success: function (response) {
            if ($.trim(response.html) === '') {
                button.text('No more data').prop('disabled', true);
                return;
            }
            $('#permission-data').append(response.html);
            button.data('page', page); // update page for next click
        },
        error: function (xhr) {
            alert("An error occurred: " + xhr.statusText);
        }
    });
});

  
  window.deletePermission = function (btn, id) {
    if (confirm("Are you sure you want to delete this permission?")) {
      let row = $(btn).closest('tr');

      $.ajax({
        url: "{{ url('permission') }}/" + id,
        type: 'DELETE',
        data: {
          _token: '{{ csrf_token() }}'
        },
        dataType: 'json',
        success: function (response) {
          if (response.status) {
            row.remove();
          } else {
            alert(response.message);
          }
        },
        error: function (xhr) {
          //alert("An error occurred while deleting the permission.");
        } 
      });
    }
  };

});
</script>
