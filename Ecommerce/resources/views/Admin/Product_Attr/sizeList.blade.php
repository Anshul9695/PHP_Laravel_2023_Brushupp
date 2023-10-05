@extends('Admin.layouts.layout')
@section('title','Size List')
@section('content')

<div class="card">
    <div class="card-header">
        <h3 class="card-title">All Size List Table </h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body p-0">
        <table class="table table-striped" id="category_table">
            <thead>
                <tr>
                    <th style="width: 10px">ID</th>
                    <th>Size Name</th>
                    <th>Sku</th>
                    <th>created_at</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {
      
    });
</script>
@endsection