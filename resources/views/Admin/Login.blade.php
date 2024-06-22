<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Login - SB Admin</title>
    <link href="{{ url('public/admin/css/styles.css') }}" rel="stylesheet" />
    <script src="{{url('public/admin/js/all.js')}}"></script>
    {{-- <script src="https://cdn.tailwindcss.com"></script> --}}
</head>

<body >
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <div class="card shadow-lg border-0 rounded-lg mt-5">
                    <div class="card-header">
                        <h3 class="text-center font-weight-light my-2">Login</h3>
                    </div>
                    <div class="card-body">
                        <form id="login_form">
                            <div class="form-floating mb-3">
                                <input class="form-control" name="user_email" type="email"  />
                                <label>Email address</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input class="form-control" name="user_password" type="password" />
                                <label>Password</label>
                            </div>

                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                {{-- <a class="small" >Need an account? Sign up!</a> --}}
                                <a class="btn btn-primary" onclick="login()">Login</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ url('public/admin/js/scripts.js') }}"></script>
    <script src="{{ url('public/admin/js/jquery.min.js') }}"></script>
    <script src="{{ url('public/admin/js/sweetalert.min.js') }}"></script>

    <script>
        function login(){
            $.post("{{route('LoginUser')}}", $("#login_form").serialize(),
                function (data) {
                    if(data.success){
                        window.location.href = "Dashboard";
                    }else{
                        swal("Error!", data.message, "error");
                    }
                }
            );
         }
    </script>

</body>

</html>
