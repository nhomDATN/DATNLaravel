@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Color</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="home">Home</a></li>
                            <li class="breadcrumb-item active">Color</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                @if(request()->has('view_deleted'))
                                    <a href="{{ route('mau.index') }}" class="btn btn-info" style="margin-left:20px;margin-top: -0.3rem;">View All Color</a>
                                    <a href="{{ route('mau.restore.all',0) }}" class="btn btn-success" style="margin-left:20px;margin-top: -0.3rem;">Restore All</a>
                                @else
                                    <a href="{{ route('mau.index', ['view_deleted' => 'DeletedRecords']) }}" class="btn btn-primary">View Delete Records</a>
                                @endif
                                <div style="float: right;margin-left:20px;margin-top: -0.3rem;width: 100px;">
                                    <a href='{{ route('mau.create') }}'>
                                        <button type="button" class="btn btn-block btn-default btn-sm">Add</button>
                                    </a>
                                </div>
                                <div class="card-tools">
                                    <div class="input-group input-group-sm" style="width: 150px;">
                                        <input type="text" name="table_search" class="form-control float-right" id="search" name="search"
                                            placeholder="Search by Name">

                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-default">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0" style="height: 480px;">
                                <table class="table table-head-fixed text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Created At</th>
                                            <th>Updated At</th>
                                            @if(request()->has('view_deleted'))
                                            <th>Delete At</th>
                                            <th>Restore</th>
                                            @else                                           
                                            <th>Edit</th>
                                            <th>Delete</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(count($lstmau) > 0)
                                        @foreach ($lstmau as $mau)
                                            <tr>
                                                <td>{{ $mau->id }}</td>
                                                <td>{{ $mau->ten_mau }}</td>
                                                <td>{{ $mau->created_at }}</td>
                                                <td>{{ $mau->updated_at }}</td>

                                                @if(request()->has('view_deleted'))
                                                <td>{{ $mau->deleted_at }}</td>
                                                <td>
                                                    <a href="{{ route('mau.restore', $mau->id) }}" >
                                                        <button type="button"
                                                            class="btn btn-default btn-sm checkbox-toggle"><i
                                                                class="fas fa-redo"></i>
                                                        </button>
                                                    </a>
                                                </td>
                                                @else
                                                <td style=";width: 20px;">
                                                    <a href="{{ route('mau.edit', ['mau' => $mau]) }}">
                                                        <button type="button"
                                                            class="btn btn-default btn-sm checkbox-toggle"><i
                                                                class="fas fa-edit"></i>
                                                        </button>
                                                    </a>
                                                </td>
                                                <td style="width: 20px;">
                                                    <form method="post"
                                                        action="{{ route('mau.destroy', ['mau' => $mau]) }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="btn btn-default btn-sm checkbox-toggle"><i
                                                                class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            @endif
                                            </tr>
                                        @endforeach
                                        @else
                                        <tr>
                                            <td colspan="100" class="text-center" style="font-style: italic;font-weight: bold;color: #4f5962;">No Color Found</td>
                                        </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
    </div>

    <script type="text/javascript">
        $flag = <?php echo "'I" . request()->has('view_deleted') . "I'"; ?>;
            if ($flag == "II") {
                $flag = 1;
            } else {
                $flag = 0;
            }
            $('#search').on('keyup',function(){
                $value = $(this).val();
                if ($flag == 0) {
                    $.ajax({
                        type: 'get',
                        url: '{{ URL::to('searchMauXoa') }}',
                        data: {
                            'search': $value
                        },
        
                        success: function(data) {
                            $('tbody').html(data);
                        }
                    });
                }
                else {
                    $.ajax({
                    type: 'get',
                    url: '{{ URL::to('searchMau') }}',
                    data: {
                        'search': $value
                    },
                    success:function(data){
                        $('tbody').html(data);
                    }
                });
                }
                
            })
            $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
        </script>
    @endsection
