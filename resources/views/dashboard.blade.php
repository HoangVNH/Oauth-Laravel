@extends('layouts.app')

@section('content')

  @if(\Session::has('success'))
    <div class="alert alert-success text-center">
      <p>{{ \Session::get('success') }}</p>
    </div>
  @elseif(\Session::has('failed'))
    <div class="alert alert-danger text-center">
      <p>{{ \Session::get('failed') }}</p>
    </div>
  @endif

  <div class="dashboard-wrapper">
    <nav class="side-bar">
      <ul>
        <li><a href="/dashboard">Users</a></li>
      </ul>
    </nav>
    <div class="container-fluid dashboard-right">
      <div class="heading-container">
        <h1 class="mt-4">Dashboard</h1>
        <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#createUserModal">
          Create new user
        </button>
      </div>

      <div class="content">

        <table class="table table-hover" id="myTable">
          <thead>
            <tr>
              <th scope="col">Name</th>
              <th scope="col">Email</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach($users as $user)
              <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                  <button><i class="far fa-edit fa-lg edit" data-toggle="modal" data-target="#editUserModal"></i></button>
                  <button><i class="far fa-trash-alt fa-lg" ></i></button>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>

        <!-- Start Create Modal -->
        <div class="modal fade" id="createUserModal" tabindex="-1" role="dialog" aria-labelledby="createUserModal" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Create new user</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <form action="{{ action('DashboardController@findOrCreate') }}" method="POST">
                @csrf
                <div class="modal-body">
                  <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" required name="name" class="form-control" placeholder="Your name">
                  </div>
                  <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" required name="email" class="form-control" placeholder="Your email">
                  </div>
                  <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" required name="password" class="form-control" placeholder="Your password">
                  </div>
                </div>

                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Create</button>
                </div>
              </form>
            </div>
          </div>
        </div>
        <!-- End Create Modal -->

        <!-- Start Edit Modal -->
        <div class="modal fade" id="editUserModal" tabindex="-1" role="dialog" aria-labelledby="editUserModal" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Edit user</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <form action="{{ action('DashboardController@findOrCreate') }}" method="POST" id="editForm">
                @csrf
                @method('PUT')
                <div class="modal-body">
                  <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" required name="name" id="name" class="form-control" placeholder="Your name">
                  </div>
                  <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" required name="email" id="email" class="form-control" placeholder="Your email">
                  </div>
                  <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" required name="password" id="password" class="form-control" placeholder="Your password">
                  </div>
                </div>

                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary update" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Update</button>
                </div>
              </form>
            </div>
          </div>
        </div>
        <!-- End Edit Modal -->
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.js" integrity="sha256-DrT5NfxfbHvMHux31Lkhxg42LY6of8TaYyK50jnxRnM=" crossorigin="anonymous"></script>

  <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js" defer></script>
  <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js" defer></script>
  <script type="text/javascript">

    $(document).ready(function() {

      var table = $('#myTable').DataTable();

      // Start edit user
      table.on('click', '.edit', function() {
        $tr = $(this).closest('tr');
        if($($tr).hasClass('child')) {
          $tr = $tr.prev('.parent');
        }

        var data = table.row($tr).data();

        $('#name').val(data[0]);
        $('#email').val(data[1]);


      })
    });
  </script>
@endsection
