<!DOCTYPE html>
<html>
<head>
    <title>Management | Trident Infoway</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>

    @if(Session::has('trident_status'))
        <div class="container-fluid mt-3">
            <a href="/logout-data" class="float-right btn btn-primary">Logout <i class="fa fa-sign-out" aria-hidden="true"></i></a>
        </div>

        <div class="clearfix"></div>

        <div class="container mt-1">
            <div class="row">
                <div class="col-md-6">
                    <p class="font-weight-bold">Whole Database</p>
                    <div class="card">
                        <div class="card-header">
                          Featured
                        </div>
                        <div class="card-body">
                          <h5 class="card-title">Refresh Database</h5>
                          <p class="card-text"> - In This Option Lose All Data Of Your All Table And Regenerate All Tables With Empty Table.</p>
                          <a href="" class="btn btn-primary"><i class="fa fa-refresh"></i> Refresh Your Database</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <p class="font-weight-bold">Only User's</p>
                    <div class="card">
                        <div class="card-header">
                          Featured
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">User Table</h5>
                            <p class="card-text">
                                - In This Option Lose All Data Of Your User Table. And Also Lose User's Permission And User &nbsp;&nbsp;Access.<br>
                                - After This Option You Can Restore Only <b>Super Admin Credential</b> &nbsp;&nbsp;Using <b>Restore Super Admin Credential</b> Option.
                            </p>
                          <a href="" class="btn btn-primary"><i class="fa fa-refresh"></i> Refresh Your User Table</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 mb-4">
                    <p class="font-weight-bold">Restore User's</p>
                    <div class="card">
                        <div class="card-header">
                          Featured
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Restore Super Admin Credential</h5>
                            <p class="card-text">
                                - In This Option Restore Your <b>Super Admin Credential</b><br>
                            </p>
                          <a href="" class="btn btn-primary"><i class="fa fa-undo" aria-hidden="true"></i> Retore Super Admin</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    @else
        <div class="modal fade" id="myModal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Trident Infoway Site Management</h5>
                    </div>
                    
                    <form id="LoginFormData">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Username :</label>
                                <span id="Error" class="float-right text-danger"></span>
                                <input type="text" name="username" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Password :</label>
                                <input type="password" name="password" class="form-control">
                            </div>
                        </div>
                    
                        <div class="modal-footer">
                            <button type="button" id="SendLoginData" class="btn btn-success">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function(){
            $('#myModal').modal('show');
        });
    </script>

    <script type="text/javascript">
        $('#SendLoginData').click(function(){
            $.ajax({
                type: "POST",
                url: "/login-data",
                data: $('#LoginFormData').serialize(),
                success:function(data){
                    if (data.status == 0) {
                        $('#Error').html(data.message)
                    }
                    if (data.status == 1) {
                        window.location.reload(true);
                        $('#myModal').modal('hide');
                    }

                }
            });
        });
    </script>
</body>
</html>