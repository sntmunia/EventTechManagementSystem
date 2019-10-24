
@extends('layouts.app')

@section('content')


<div class="tp-page-head">
    <!-- page header -->
    <div class="container">
        <div class="row">
            <div class="col-md-offset-2 col-md-8">
                <div class="page-header text-center">
                    <h1>Payment List</h1>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="tp-breadcrumb">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <ol class="breadcrumb">
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Booking List</a></li>
                </ol>
            </div>
        </div>
    </div>
</div>

@if (Session::has('success'))
    <div class="alert alert-success text-center">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
        <p>{{ Session::get('success') }}</p>
    </div>
@endif

<div class="main-container">
    <div class="container tabbed-page st-tabs">
           
        <div class="row tab-page-header">
            <table class="table">
              <thead class="thead-dark">
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Month</th>
                  <th scope="col">Year</th>
                  <th scope="col">Amount</th>
                  <th scope="col">Status</th>
                </tr>
              </thead>
              <tbody>
                @foreach($payments as $payment)
                    <tr>
                      <th scope="row">{{$payment->id}}</th>
                      <td>{{$payment->month}}</td>
                      <td>{{$payment->year}}</td>
                      <td>${{$payment->amount}}</td>
                      <td>{{$payment->status}}</td>
                    </tr>
                @endforeach
              </tbody>
            </table>
        </div>
    </div>
</div>


@endsection

