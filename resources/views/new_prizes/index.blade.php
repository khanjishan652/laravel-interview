@extends('layout.admin')
@section('title','Prizes')
@section('content')
<div class="pcoded-content">

    <div class="pcoded-inner-content">
        <!-- Main-body start -->
        <div class="main-body">
            <div class="page-wrapper">
                <!-- Page-body start -->
                <div class="page-body">
                    <div class="row">
                        <div class="col-sm-12">
                        <div class="card borderless-card">
                                <div class="card-block warning-breadcrumb">
                                    <div class="breadcrumb-header">
                                        <span>Sum of all prizes Probability must be 100% currently its {{$probability}}% You have to add {{100-$probability}}% to the prize</span>
                                    </div>
                                    
                                </div>
                            </div>
                            <!-- Default ordering table start -->
                            <div class="card">
                                <div class="card-header">
                                    <h5>Prizes </h5><a href="{{route('prizes.create')}}" class="btn btn-success btn-round waves-effect waves-light btn-sm">Add Prize</a>
                                </div>
                                <div class="card-block">
                                    <div class="dt-responsive table-responsive">
                                        <table id="prizeTable" class="table table-striped table-bordered nowrap">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Title</th>
                                                    <th>Probability</th>
                                                    <th>Awarded</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- Default ordering table end -->
                        </div>
                    </div>
                </div>
                <!-- Page-body end -->
            </div>
        </div>
    </div>
</div>

@endsection()
@push('after-scripts')
<script>
    $(function () {

      var table = $('#prizeTable').DataTable({
          processing: true,
          serverSide: true,
          ajax: "{{ route('prizes.index') }}",
          columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
            {data: 'title', name: 'title', orderable: true, searchable: true},
            {data: 'probability', name: 'probability', orderable: true, searchable: true},
            {data: 'awarded', name: 'awarded', orderable: false, searchable: false},
            {data: 'action', name: 'action', orderable: false, searchable: false},
          ],
        createdRow: function (row, data) {
           $(row).attr('data-id', data.id);
           $(row).attr('data-model','prize');
        }
      });

    });
</script>
@endpush