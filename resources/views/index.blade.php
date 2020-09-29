<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="{{asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
      href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
      rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{asset('css/sb-admin-2.min.css') }}" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="{{asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
    <style>
      .pull-right {
        float: right;
      }

    </style>

  </head>

  <body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

      <!-- Sidebar -->
      <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('index')}}">
          <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
          </div>
          <div class="sidebar-brand-text mx-3">Buku Tamu</div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item active">
          <a class="nav-link" href="{{route('index')}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="{{route('create')}}">
            <i class="fas fa-fw fa-pen"></i>
            <span>Input Tamu</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
          <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

      </ul>
      <!-- End of Sidebar -->

      <!-- Content Wrapper -->
      <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

          <!-- Topbar -->
          <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

            <!-- Sidebar Toggle (Topbar) -->
            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
              <i class="fa fa-bars"></i>
            </button>

            <!-- Topbar Search -->
            <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
              <div class="input-group">
                <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                  aria-label="Search" aria-describedby="basic-addon2">
                <div class="input-group-append">
                  <button class="btn btn-primary" type="button">
                    <i class="fas fa-search fa-sm"></i>
                  </button>
                </div>
              </div>
            </form>

            <!-- Topbar Navbar -->
            <ul class="navbar-nav ml-auto">

              {{-- <div class="topbar-divider d-none d-sm-block"></div> --}}

              <!-- Nav Item - User Information -->
              <li class="nav-item dropdown no-arrow">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                  aria-expanded="false">
                  <span class="mr-2 d-none d-lg-inline text-gray-600 small">Admin</span>
                  <img class="img-profile rounded-circle" src="https://source.unsplash.com/QAB-WJcbgJk/60x60">
                </a>
              </li>

            </ul>

          </nav>
          <!-- End of Topbar -->

          <!-- Begin Page Content -->
          <div class="container-fluid">
            <!-- Page Heading -->
            @if(session()->has('message'))
            <div class="alert alert-success">
              {{ session()->get('message') }}
            </div>
            @endif
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
              <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                  Daftar Tamu
                </h6>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <div class="row">
                    <div class="col-md-3">
                      <select class="form-control" name="filter_year" id="filter_year">
                        <option value="ALL">Tahun</option>
                        @foreach ($years as $year)
                        <option value="{{$year}}">{{$year}}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="col-md-3">
                      <select class="form-control" name="filter_month" id="filter_month">
                        <option value="ALL">Bulan</option>
                        @foreach ($months as $month)
                        <option value="{{$month}}">{{$month}}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="col-md-3">
                      <select class="form-control" name="filter_day" id="filter_day">
                        <option value="ALL">Hari</option>
                        @foreach ($days as $day)
                        <option value="{{$day}}">{{$day}}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="col-md-3">
                      <div id="buttonexport" class="btn-group pull-right" style="margin-top:2px;">
                      </div>
                    </div>
                  </div>
                  <table class="table table-bordered table-hover" id="data-table" cellspacing="0">
                    <thead>
                      <tr role="row" class="heading">
                        <th>NO</th>
                        <th>Nomor Identitas</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>Nomor HP</th>
                        <th>Tujuan Kunjungan</th>
                        <th>Action</th>
                        <th style="display: none;">Tanggal</th>
                      </tr>
                    </thead>
                    <tbody>

                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <footer class="sticky-footer bg-white">
          <div class="container my-auto">
            <div class="copyright text-center my-auto">
              <span>Copyright &copy; Your Website 2020</span>
            </div>
          </div>
        </footer>
        <!-- End of Footer -->

      </div>
      <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
    </a>

    <!-- Bootstrap core JavaScript-->
    <script src="{{asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    {{-- <script src="{{asset('vendor/datatables/jquery.dataTables.min.js') }}"></script> --}}
    {{-- <script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script> --}}

    <!-- Custom scripts for all pages-->
    <script src="{{asset('js/sb-admin-2.min.js') }}"></script>
    {{-- <script src="{{asset('js/demo/datatables-demo.js') }}"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.4/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>

    <script>
      $(function() {
              const buttonCommon = {
                  exportOptions: {
                      format: {
                          body: function ( data, row, column, node ) {
                              if (row === 7) {
                                  return "'" + data.replace(/<\/?[^>]+>/gi, ''); 
                              } else if (row === 9 && row === 12 && row === 13 && row === 14 && row === 15 && row === 16 && row === 17 && row === 18 && row === 19 && row === 20) {
                                  let result = data.split('.').join('');
                                  result = result.split('IDR ').join('');
                                  result = result.split(',').join('.');
                                  return result; 
                              } else if( row === 22){
                                  return data.replace(/(&nbsp;|<([^>]+)>)/ig, "");
                              } else if( row === 23){
                                  return data.replace(/(&nbsp;|<([^>]+)>)/ig, "");
                              }
                              return data;
                          }
                      }
                  }
              };
              const datatable = $('#data-table').DataTable({
                  processing: true,
                  serverSide: true,
                  ajax: {
                    url: "{{route('indexData')}}",
                    dataType: 'json',
                    },
                  dom: 'Bfrtip',
                  sScrollX: "100%",
                  sScrollXInner: "100%",
                  bScrollCollapse: true,
                  order:[[0,"DESC"]],
                  buttons: [
                      $.extend( true, {}, buttonCommon, {
                          extend: 'csvHtml5',
                          text: 'Export to CSV',
                          exportOptions: {
                          columns: [ 0, 1, 2, 3, 4, 10]
                          },
                      } ),
                      $.extend( true, {}, buttonCommon, {
                          extend: 'excelHtml5',
                          text: 'Export to Excel',
                          exportOptions: {
                          columns: [ 0, 1, 2, 3, 4, 10]
                          },
                      } ),
                  ],
                  columnDefs: [
                      {
                          targets: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10],
                          className: "text-center",
                          // width : '160px',
                      },
                  ],
                  lengthMenu: [
                      //   [10, 25, 50, 100, "All"],
                      [10, 25, 50, 100, 500, 1000],
                      [10, 25, 50, 100, 500, 1000],
                  ],
                  columns: [
                      { data: 'id' },
                      { data: 'NIK' },
                      { data: 'name'  },
                      { data: 'address' },
                      { data: 'nomorhp' },
                      { data: 'needs' },
                      { data: 'action', orderable: false, searchable: false },
                      { data: 'day', visible:false },
                      { data: 'month', visible:false },
                      { data: 'year', visible:false },
                      { data: 'date', visible:false },
                  ]
              });
              datatable.buttons().container().appendTo($('#buttonexport'));
              $('#filter_year').on('change', function () {
                if(this.value === 'ALL'){
                  datatable.columns(9).search( '' ).draw();
                }else{
                  datatable.columns(9).search( this.value ).draw();
                }
              });
              $('#filter_month').on('change', function () {
                  if(this.value === 'ALL'){
                    datatable.columns(8).search( '' ).draw();
                  }else{
                    datatable.columns(8).search( this.value ).draw();
                  }
              });
              $('#filter_day').on('change', function () {
                  if(this.value === 'ALL'){
                    datatable.columns(7).search( '' ).draw();
                  }else{
                    datatable.columns(7).search( this.value ).draw();
                  }
              });
      });
    </script>

  </body>

</html>