@extends('layouts.header')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="row">
          <div class="col-4 col-md-4 col-lg-4">
            <form method='post' action='new-inventory' onsubmit='show();'  enctype="multipart/form-data">
                {{ csrf_field() }}
                @if(session()->has('status'))
                    <div class="alert alert-success alert-dismissable">
                        {{-- <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button> --}}
                        {{session()->get('status')}}
                    </div>
                @endif
                @include('error')
                <div class="card">
                    <div class="card-header">
                    <h4>Pending for Generate </h4>
                    </div>
                    <div class="card-body">
                      <table class="table table-hover" style="width:100%;">
                        <thead>
                          <tr>
                            <th>Name</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            @php
                                $dataList  = collect($items)->unique('emp_code');
                                // dd($dataList);
                            @endphp
                            @foreach($dataList as $item)
                            <tr>
                                <td> 
                                    {{$item->name}}
                                </td>
                                <td><a href="#" class="btn btn-primary" onclick='generateEmployee({{$item}})' title='generate to pdf' data-toggle="modal" data-target="#generatedata"><i class='fas fa-file-export'></i> Generate</a></td>
                              </tr>
                            @endforeach
                        </tbody>
                      </table>
                    </div>
                </div>
               
            </form>
        </div>
            <div class="col-8 col-md-8 col-lg-8">
                <div class="card">
                    <div class="card-header">
                      <h4>Transactions</h4>
                    </div>
                    <div class="card-body">
                      <div class="table-responsive">
                        <table class="table table-hover" id="transaction-table" style="width:100%;">
                          <thead>
                            <tr>
                              <th>Trans Code</th>
                              <th>Name</th>
                              <th>Department</th>
                              <th>Position</th>
                              <th>Date Generated</th>
                              <th>Status</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($transactions as $trans)
                            <tr>
                              <td>TR-{{str_pad($trans->id, 4, '0', STR_PAD_LEFT)}}</td>
                              <td>{{$trans->name}}</td>
                              <td>{{$trans->department}}</td>
                              <td>{{$trans->position}}</td>
                              <td>{{date('M d, Y',strtotime($trans->created_at))}}</td>
                              <td>{{$trans->status}}</td>
                              <td>
                                @if($trans->status == "For Upload")
                                <a href='{{ url('/returnItem/'.$trans->id) }}' target='_blank' title="Print" class="btn btn-icon btn-warning fas fa-print" > </a>
                                <button onclick='uploadPDF({{$trans->id}})' data-toggle="modal" data-target="#uploadPDF" title="Upload" class="btn btn-icon btn-primary fas fa-upload" > </button>
                                @else
                                <a href='{{ url($trans->pdf) }}' target='_blank' title="Signed Contract" class="btn btn-icon btn-warning fas fa-print" > </a>
                                @endif
                              </td>
                            </tr>
                          @endforeach
                          </tbody>
                        </table>
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@include('generateReturnItems')
@include('upload_pdf_return')
@endsection

