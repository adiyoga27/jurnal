<!doctype html>
<html lang="en">

    <head>
        
        <meta charset="utf-8" />
        <title>Dashboard | {{Auth::user()->role}} </title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Themesbrand" name="author" />
        
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{url('assets')}}//images/favicon.ico">

        <!-- Bootstrap Css -->
        <link href="{{url('assets')}}//css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="{{url('assets')}}//css/icons.min.css" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="{{url('assets')}}//css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
        <link href="{{ url('assets') }}/extra-libs/toastr/dist/build/toastr.min.css" rel="stylesheet">

        @yield('css')
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    </head>

    <body data-sidebar="dark">

    <!-- <body data-layout="horizontal" data-topbar="dark"> -->

        <!-- Begin page -->
        <div id="layout-wrapper">

            
            <header id="page-topbar">
                <div class="navbar-header">
                    <div class="d-flex">
                        <!-- LOGO -->
                        <div class="navbar-brand-box">
                            <a href="index.html" class="logo logo-dark">
                                <span class="logo-sm">
                                    <img src="{{url('assets')}}/images/logo.png" alt="" height="50">
                                </span>
                                <span class="logo-lg">
                                    <img src="{{url('assets')}}/images/logo-dark.png" alt="" height="40">
                                </span>
                            </a>

                            <a href="index.html" class="logo logo-light">
                                <span class="logo-sm">
                                    <img src="{{url('assets')}}/images/logo-light.png" alt="" height="50">
                                </span>
                                <span class="logo-lg">
                                    <img src="{{url('assets')}}/images/logo-light.png" alt="" height="40">
                                </span>
                            </a>
                        </div>

                        <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect" id="vertical-menu-btn">
                            <i class="fa fa-fw fa-bars"></i>
                        </button>

                        <!-- App Search-->
                   

                    </div>

                    <div class="d-flex">




                        <div class="dropdown d-none d-lg-inline-block ms-1">
                            <button type="button" class="btn header-item noti-icon waves-effect" data-bs-toggle="fullscreen">
                                <i class="bx bx-fullscreen"></i>
                            </button>
                        </div>

                        <div class="dropdown d-inline-block">
                            <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img class="rounded-circle header-profile-user" src="{{url('assets')}}//images/users/avatar-1.jpg"
                                    alt="Header Avatar">
                                <span class="d-none d-xl-inline-block ms-1" key="t-henry">{{Auth::user()->nama}}</span>
                                <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end">
                                <!-- item-->
                                <a class="dropdown-item" href="#"><i class="bx bx-user font-size-16 align-middle me-1"></i> <span key="t-profile">Profile</span></a>
                                <a class="dropdown-item" href="#"><i class="bx bx-lock-open font-size-16 align-middle me-1"></i> <span key="t-lock-screen">Lock screen</span></a>
                                <div class="dropdown-divider"></div>
                                <form action="{{url('auth/logout')}}" method="POST">
                                    @csrf
                                    <button class="dropdown-item text-danger" type="submit"><i class="bx bx-power-off font-size-16 align-middle me-1 text-danger"></i> <span key="t-logout">Logout</span></button>
                                </form>
                            </div>
                        </div>

                        <div class="dropdown d-inline-block">
                            <button type="button" class="btn header-item noti-icon right-bar-toggle waves-effect">
                                <i class="bx bx-cog bx-spin"></i>
                            </button>
                        </div>

                    </div>
                </div>
            </header>

            <!-- ========== Left Sidebar Start ========== -->
            <div class="vertical-menu">

                <div data-simplebar class="h-100">

                    <!--- Sidemenu -->
                    <div id="sidebar-menu">
                        <!-- Left Menu Start -->
                        <ul class="metismenu list-unstyled" id="side-menu">
                            <li class="menu-title" key="t-menu">Menu</li>

                            <li>
                                <a href="{{ url('/')}}" class="waves-effect">
                                    <i class="bx bx-home-circle"></i>
                                    <span key="t-dashboards">Dashboards</span>
                                </a>
                           
                            </li>

                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="bx bx-layout"></i>
                                    <span key="t-layouts">Data Master</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="true">
                                    <li>
                                        <a href="{{url('user')}}"  key="t-vertical">User</a>
                                    </li>
                                    @if (Auth::user()->role == 'admin')
                                    <li>
                                        <a href="{{url('employee')}}"  key="t-vertical">Karyawan</a>
                                    </li>
                                    @endif
                                    <li>
                                        <a href="{{url('akun')}}"  key="t-vertical">Akun</a>
                                    </li>
                                    <li>
                                        <a href="{{url('product')}}"  key="t-vertical">Produk</a>
                                    </li>
                                    <li>
                                        <a href="{{url('transaction')}}"  key="t-vertical">Pemasukan</a>
                                    </li>
                                    <li>
                                        <a href="{{url('expense')}}"  key="t-vertical">Pengeluaran</a>
                                    </li>

                                </ul>
                            </li>
                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="bx bxs-bar-chart-alt-2"></i>
                                    <span key="t-ecommerce">Laporan</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="{{url('jurnal')}}" key="t-vertical">Jurnal Umum</a></li>
                                    <li><a href="{{url('buku-besar')}}" key="t-buku-besar">Buku Besar</a></li>
                                    <li><a href="{{url('arus-kas')}}" key="t-arus-kas">Arus Kas</a></li>
                                    <li><a href="{{url('perubahan-modal')}}" key="t-perubahan-modal">Perubahan Modal</a></li>
                                    <li><a href="{{url('neraca')}}" key="t-neraca">Neraca</a></li>
                                    <li><a href="{{url('laba-rugi')}}" key="t-laba-rugi">Laba Rugi</a></li>
                                  
                                </ul>
                            </li>

                           

                           
                        </ul>
                    </div>
                    <!-- Sidebar -->
                </div>
            </div>
            <!-- Left Sidebar End -->

            

            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">
                       @yield('content')
                    
                    </div>
                    <!-- container-fluid -->
                </div>
                <!-- End Page-content -->

                <!-- Transaction Modal -->
                <div class="modal fade transaction-detailModal" tabindex="-1" role="dialog" aria-labelledby="transaction-detailModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="transaction-detailModalLabel">Order Details</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p class="mb-2">Product id: <span class="text-primary">#SK2540</span></p>
                                <p class="mb-4">Billing Name: <span class="text-primary">Neal Matthews</span></p>

                                <div class="table-responsive">
                                    <table class="table align-middle table-nowrap">
                                        <thead>
                                            <tr>
                                                <th scope="col">Product</th>
                                                <th scope="col">Product Name</th>
                                                <th scope="col">Price</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th scope="row">
                                                    <div>
                                                        <img src="{{url('assets')}}//images/product/img-7.png" alt="" class="avatar-sm">
                                                    </div>
                                                </th>
                                                <td>
                                                    <div>
                                                        <h5 class="text-truncate font-size-14">Wireless Headphone (Black)</h5>
                                                        <p class="text-muted mb-0">$ 225 x 1</p>
                                                    </div>
                                                </td>
                                                <td>$ 255</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">
                                                    <div>
                                                        <img src="{{url('assets')}}//images/product/img-4.png" alt="" class="avatar-sm">
                                                    </div>
                                                </th>
                                                <td>
                                                    <div>
                                                        <h5 class="text-truncate font-size-14">Phone patterned cases</h5>
                                                        <p class="text-muted mb-0">$ 145 x 1</p>
                                                    </div>
                                                </td>
                                                <td>$ 145</td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">
                                                    <h6 class="m-0 text-right">Sub Total:</h6>
                                                </td>
                                                <td>
                                                    $ 400
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">
                                                    <h6 class="m-0 text-right">Shipping:</h6>
                                                </td>
                                                <td>
                                                    Free
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">
                                                    <h6 class="m-0 text-right">Total:</h6>
                                                </td>
                                                <td>
                                                    $ 400
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end modal -->


                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6">
                                <script>document.write(new Date().getFullYear())</script> © Skote.
                            </div>
                            <div class="col-sm-6">
                                <div class="text-sm-end d-none d-sm-block">
                                    Design & Develop by Themesbrand
                                </div>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
            <!-- end main content-->

        </div>
        <!-- END layout-wrapper -->

        <!-- Right Sidebar -->
        <div class="right-bar">
            <div data-simplebar class="h-100">
                <div class="rightbar-title d-flex align-items-center px-3 py-4">
            
                    <h5 class="m-0 me-2">Settings</h5>

                    <a href="javascript:void(0);" class="right-bar-toggle ms-auto">
                        <i class="mdi mdi-close noti-icon"></i>
                    </a>
                </div>

                <!-- Settings -->
                <hr class="mt-0" />
                <h6 class="text-center mb-0">Choose Layouts</h6>

                <div class="p-4">
                    <div class="mb-2">
                        <img src="{{url('assets')}}//images/layouts/layout-1.jpg" class="img-thumbnail" alt="layout images">
                    </div>

                    <div class="form-check form-switch mb-3">
                        <input class="form-check-input theme-choice" type="checkbox" id="light-mode-switch" checked>
                        <label class="form-check-label" for="light-mode-switch">Light Mode</label>
                    </div>
    
                    <div class="mb-2">
                        <img src="{{url('assets')}}//images/layouts/layout-2.jpg" class="img-thumbnail" alt="layout images">
                    </div>
                    <div class="form-check form-switch mb-3">
                        <input class="form-check-input theme-choice" type="checkbox" id="dark-mode-switch">
                        <label class="form-check-label" for="dark-mode-switch">Dark Mode</label>
                    </div>
    
                    <div class="mb-2">
                        <img src="{{url('assets')}}//images/layouts/layout-3.jpg" class="img-thumbnail" alt="layout images">
                    </div>
                    <div class="form-check form-switch mb-3">
                        <input class="form-check-input theme-choice" type="checkbox" id="rtl-mode-switch">
                        <label class="form-check-label" for="rtl-mode-switch">RTL Mode</label>
                    </div>

                    <div class="mb-2">
                        <img src="{{url('assets')}}//images/layouts/layout-4.jpg" class="img-thumbnail" alt="layout images">
                    </div>
                    <div class="form-check form-switch mb-5">
                        <input class="form-check-input theme-choice" type="checkbox" id="dark-rtl-mode-switch">
                        <label class="form-check-label" for="dark-rtl-mode-switch">Dark RTL Mode</label>
                    </div>

            
                </div>

            </div> <!-- end slimscroll-menu-->
        </div>
        <!-- /Right-bar -->

        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>

        <!-- JAVASCRIPT -->
        <script src="{{url('assets')}}//libs/jquery/jquery.min.js"></script>
        <script src="{{url('assets')}}//libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="{{url('assets')}}//libs/metismenu/metisMenu.min.js"></script>
        <script src="{{url('assets')}}//libs/simplebar/simplebar.min.js"></script>
        <script src="{{url('assets')}}//libs/node-waves/waves.min.js"></script>

        <script src="{{ url('assets') }}/extra-libs/toastr/dist/build/toastr.min.js"></script>
        <script src="{{ url('assets') }}/extra-libs/toastr/toastr-init.js"></script>

        <!-- dashboard init -->
        {{-- <script src="{{url('assets')}}//js/pages/dashboard.init.js"></script> --}}
        <script>

        @if ($errors->any()) 
            @foreach($errors->all() as $error)
            toastr.error("{{ $error }}", "Error", {
                "progressBar": true
            });    
            @endforeach
        @endif
        
        @if (Session::has('success'))
            toastr.success("{{ Session::get('success') }}", "Success", {
                "progressBar": true
            });
        @endif
        @if (Session::has('error'))
        toastr.error("{{ Session::get('error') }}", "Error", {
                "progressBar": true
            });
          
        @endif
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        function confirmDelete(e, modalSubmit, callback) {
            var isSubmit = modalSubmit === undefined ? true : false;
            // console.log(isSubmit);
            var self = e;
            var deleteMessage = self.getAttribute('data-confirm') ? self.getAttribute('data-confirm') : 'Delete data\ ?';
            Swal.fire({
                icon: 'question',
                title: 'Apakah Anda Yakin?',
                text: deleteMessage,
                showCancelButton: true,
                confirmButtonText: 'Ya, yakin!',
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    self.submit();
                } else if (result.isDenied) {
                    callback(true);
                }
            });
        }


        function onGoing(title) {
            Swal.fire({
                title: "Feature Belum Tersedia!",
                html: "Mohon tunggu update feature <b>"+title+"</b> selanjutnya yaa!",
                icon: "error"
                });
        }
            </script>
        @yield('js')
        <!-- App js -->
        {{-- <script src="{{url('assets')}}//js/app.js"></script> --}}


    </body>

</html>