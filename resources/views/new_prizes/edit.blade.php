@extends('layout.admin')
@section('title','Update Prize')
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
                            <!-- Default select start -->
                            <div class="card">
                                <div class="card-header">
                                    <h5>Update Prize</h5>
                                </div>
                                <div class="card-block">
                                    <div class="row">
                                        <form class="row g-3 needs-validation ajaxForm" novalidate action="{{route('prizes.update',$edit->id)}}" method="post">
                                            <div class="col-md-6">
                                                <label for="title" class="form-label">Title</label>
                                                <input type="text" class="form-control" name="title" value="{{$edit->title}}" required>
                                                <div class="titleErr err"></div>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="probability" class="form-label">Probability</label>
                                                <input type="text" class="form-control" value="{{$edit->probability}}" name="probability" required placeholder="0-100">
                                                <div class="probabilityErr err"></div>
                                            </div>
                                            <div class="col-12">
                                                <button class="btn btn-primary" type="submit">Update</button>
                                            </div>
                                        </form>
                                    </div>

                                </div>
                            </div>
                            <!-- Default select end -->

                        </div>
                    </div>
                    <!-- Page-body end -->
                </div>
            </div>
        </div>
    </div>
@endsection