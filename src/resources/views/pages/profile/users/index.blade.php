@extends('layouts.profile')

@section('title', 'All Users')
@section('breadcrumbs', 'users')

@section('content')

    @include('partials.profile.navbar')

    @include('partials.profile.sidebar.main')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

    @include('partials.profile.content-header')

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-lg-12 margin-tb">
                        <div class="pull-right">
                            <a class="btn btn-dark" href="{{ route('users.create') }}">{{ __('Create New User') }}</a>
                        </div>
                    </div>
                </div>
                @include('partials.profile.session')
                <!-- Main row -->
                <div class="table-responsive">
                    <table id="users" class="table data-table hover cell-border compact stripe">
                       
                    </table>
                </div>
                <!-- /.row (main row) -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
        
    </div>
    <!-- /.content-wrapper -->

    <script>
        var data = <?php echo json_encode($users); ?>;
        
        $(document).ready(function() {
            $('#users').DataTable({
                data: data,
                // pageLength: 5,
                columns: [
                    { data: 'name', width: '15%' },
                    { data: 'email', width: '15%' },
                    { data: 'account', width: '15%' },
                    { data: 'roles.0.name', width: '15%' },
                    { data: 'status', width: '10%' },
                    { data: 'id', width: '30%' },
                ],
                deferRender: true,
                processing: true,
                orderCellsTop: true,
                columnDefs: [ { title: 'Name', targets: 0 },
                            { title: 'Email', targets: 1 },
                            { title: 'Account', targets: 2 },
                            { title: 'Roles', targets: 3 },
                            { title: 'Status', targets: 4 },
                            { title: 'Action', targets: 5,
                                "render": function ( data, type, row, meta ) {
                                    return '<a href="/users/'+data+'" class="btn btn-info btn-sm mr-2">Show</a>' + '<a href="/users/'+data+'/edit" class="btn btn-success btn-sm mr-2">Edit</a>' + '<button class="delete btn btn-danger btn-sm mr-2" data-id="'+data+'">Delete</button>';
                                }
                            },
                            ],
                language: {
                    "search": "Filter records:"
                }
            });

            $('tr').addClass('align-middle');

            $(".delete").click(function(){
                    var token = $("meta[name='csrf-token']").attr("content");
                    var id = $(this).data("id");
                    // console.log(token);
                    // console.log(id);
                $.ajax({
                    url: 'users/'+id,
                    type: 'post',
                    data: {
                        id: id,
                        _token: token,
                        _method: 'delete'
                    },
                    success: function (){
                        console.log("it Works");
                    }
                });
            });
        });

        $('.alert-block').delay(2000).fadeOut();
        console.log(data);
    </script>
    

{{--    @include('partials.profile.sidebar.control') --}}

@endsection
