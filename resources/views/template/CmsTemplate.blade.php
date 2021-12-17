<!doctype html>
<html lang="en">

<head>
    <title>Chatbot management system</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.3.0/dist/sweetalert2.css"
        integrity="sha256-4i04vyxyYj3lml1qZ3C3PyEl0+9dwi4pEgWYYOUjMmw=" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <style>
        .form-primary {
            border: 1px solid blue;
        }

        .form-height {
            width: 100%;
            height: 150px;
        }

    </style>
</head>

<body>

    <div class="wrapper d-flex align-items-stretch">
        <nav id="sidebar" class="">
            <div class="custom-menu">
                <button type="button" id="sidebarCollapse" class="btn btn-primary">
                    <i class="fa fa-bars"></i>
                    <span class="sr-only">Toggle Menu</span>
                </button>
            </div>
            <div class="p-4">
                <h1><a href="#" class="logo">ChatBOT</a></h1>
                <ul class="list-unstyled components mb-5">
                    <li class=" {{ Route::is('dashboard.index') ? 'active' : '' }}">
                        <a href="#"><span class="fa fa-home mr-3"></span> Dashboard</a>
                    </li>

                </ul>
                <ul class="list-unstyled components mb-5">
                    <li class="{{ Route::is('message.index') ? 'active' : '' }}">
                        <a href="{{ route('message.index') }}"><span class="ml-3 mr-3"></span> Message</a>
                    </li>
                    <li class="{{ Route::is('choice.index') ? 'active' : '' }}">
                        <a href="{{ route('choice.index') }}"><span class="ml-3 mr-3"></span> Choice</a>
                    </li>
                    <li>
                        <a href="#"><span class="ml-3 mr-3"></span> Routing</a>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- Page Content  -->
        <div id="content" class="p-4 p-md-5 pt-5">
            @yield('content')
        </div>
    </div>

    <div class="modal fade" id="myModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title">Modal Heading</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <form id="input-form" action="" method="POST">
                    @csrf
                    <div class="modal-body">


                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI="
        crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.3.0/dist/sweetalert2.js"
        integrity="sha256-0pXtxoXUDqN0o8Ebqzf8omN7RoFr7E3FFZIJzO5y0UA=" crossorigin="anonymous"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>

    @yield('js')
</body>

</html>
