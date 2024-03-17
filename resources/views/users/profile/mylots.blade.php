@extends('users.user_layouts.app')

@section('page_title', 'Hillside Memorial Garden | My Lots')

@section('content')


    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
        <div class="container">
  
            <div class="row justify-content-center">
                <div class="col-md-4">
                    @include('users.profile.sidebar.sidebar')
                </div>
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            {{ __('Dashboard') }}
                            {{-- <a href="" style="float:right;"><i class="fas fa-pencil-alt"></i> Write a review</a> --}}
                        </div>
        
                        <div class="card-body">
                            <h4>My All Lots</h4>
                            <div>
                                <table class="table">
                                  <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Date Purchased</th>
                                        <th scope="col">Lot No.</th>
                                        <th scope="col">Lot Type</th>
                                        <th scope="col">Lot Class</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    @php
                                      $counter = 1
                                    @endphp
                                    @foreach ($userlot as $row)
                                        <tr>
                                          <td>{{ $counter }}</td>
                                          <td>{{ $row->created_at }}</td>
                                          <td>{{ $row->lot->lot_no }}</td>
                                          <td>{{ $row->lot->lotType->lot_type_name }}</td>
                                          <td>{{ $row->lot->lotClass->lot_class_name }}</td>
                                          <td>
                                                @if ($row->status == 'Pending')
                                                    <span class="badge text-bg-warning p-2">Pending</span>
                                                @elseif ($row->status == 'Fully Paid')
                                                    <span class="badge text-bg-success p-2">Fully Paid</span>
                                                @elseif ($row->status == 'Partial')
                                                    <span class="badge text-bg-primary p-2">Partial</span>
                                                @elseif ($row->status == 'Cancelled')
                                                    <span class="badge text-bg-danger p-2">Cancelled</span>
                                                @elseif ($row->status == 'Rejected')
                                                    <span class="badge text-bg-danger p-2">Rejected</span>
                                                @elseif ($row->status == 'Waived')
                                                    <span class="badge text-bg-dark p-2">Waived</span>
                                                @endif
                                          </td>
                                          <td><a href="{{ route('my.lot.view', $row->id) }}">view</a></td>
                                        </tr>
                                        @php
                                          $counter++
                                        @endphp
                                    @endforeach
                                  </tbody>
                                </table>
                            </div>
                         </div>
                    </div>
                </div>
            </div>
  
        </div>
    </section><!-- End Contact Section -->

@endsection