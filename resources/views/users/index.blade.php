@extends('layouts.main')

@section('page-title')
    User Management | NEWSIM Mobile
@endsection

@section('breadcrumb')
    <ul class="breadcrumb">
        <li><a href="{{ url('home') }}">Home</a></li>
        <li class="active">User Management</li>
    </ul>
@endsection

@section('page-content-title')
    <div class="page-title">
        <h2><span class="fa fa-users"></span> User Management</h2>
    </div>
@endsection

@section('page-content-wrapper')
    <div class="page-content-wrap">

        <div class="row">
            <div class="col-md-12">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">All Users</h3>
                        <ul class="panel-controls">
                            <li><button type="button" class="btn btn-danger btn-rounded" onclick="document.location='{{ route('users.create') }}'"><span class="fa fa-plus"></span> New User</button></li>
                        </ul>
                    </div>
                    <div class="panel-body">
                        <p>Displays all users from all branches</p>
                        <div class="table-responsive">
                            <table class="table table-striped table-condensed table-bordered" id="table-users">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Username</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Branch</th>
                                        <th style="text-align: center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $key => $user)
                                        <tr>
                                            <td>{{ $user->id }}</td>
                                            <td>{{ $user->username }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->branch->name }}</td>
                                            <td align="center">
                                                <a class="btn btn-primary btn-rounded btn-condensed btn-sm" href="{{ route('users.edit', $user->id) }}"><span class="fa fa-pencil"></span></a>
                                                <button class="btn btn-danger btn-rounded btn-condensed btn-sm" onclick="delete_user({{ $user->id }});"><span class="fa fa-times"></span>
                                            </td>
                                            <form method="POST" action="{{ route('users.destroy', $user->id) }}" accept-charset="UTF-8" id="formDelete{{ $user->id }}">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                            </form>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>

    <!-- DELETE ITEM MESSAGE BOX -->
    <div class="message-box animated fadeIn" data-sound="alert" id="mb-delete-user">
        <div class="mb-container">
            <div class="mb-middle">
                <div class="mb-title"><span class="fa fa-times"></span> Archive <strong>User</strong> ?</div>
                <div class="mb-content">
                    <p>Are you sure you want to move this user to archive?</p>
                    <p>Press Yes to move user.</p>
                </div>
                <div class="mb-footer">
    				<div class="pull-right">
    					<button class="btn btn-success btn-lg mb-control-yes">Yes</button>
    					<button class="btn btn-default btn-lg mb-control-close">No</button>
    				</div>
			    </div>
            </div>
        </div>
    </div>
    <!-- DELETE ITEM END MESSAGE BOX-->
@endsection

@section('scripts')
    <script type="text/javascript" src="{{ url('js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script>
    $(function () {
        $('#table-users').dataTable({
            "iDisplayLength": 500,
            "bLengthChange": false,
            "order": [[ 0, "desc" ]],
            "columns": [
                null,
                null,
                null,
                null,
                { "width": "200px" },
                { "width": "150px" },
              ]
        });
    });

    function delete_user(row) {

        var box = $("#mb-delete-user");
        box.addClass("open");

        box.find(".mb-control-yes").on("click",
            function(){
                box.removeClass("open");
                document.getElementById('formDelete' + row).submit();
            }
        );
    }
</script>
    </script>
@endsection
