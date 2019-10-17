@extends('layouts/app')
@section('content')
<!-- @php
  error_reporting(0);
@endphp -->
  <div class="container">
    <div class="row">
      <div class="col-8">
        <div class="card mb-5">
          <div class="card-header bg-success">
              Contact Message List
          </div>
          <div class="card-body">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>SL.NO</th>
                  <th>First Name</th>
                  <th>Last Name</th>
                  <th>Subject</th>
                  <th>Message</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @forelse($contactmessages as $contactmessage)
                <tr class={{($contactmessage->read_status == 1)?"bg-info":""}}>
                  <td>{{$loop->index +1}}</td>
                  <td>{{$contactmessage->first_name}}</td>
                  <td>{{$contactmessage->last_name}}</td>
                  <td>{{$contactmessage->subject}}</td>
                  <td>{{$contactmessage->message}}</td>
                  <td>
                    <a class="btn btn-success" href="{{url('message/view')}}/{{$contactmessage->id}}">Change</a>
                  </td>
                </tr>
                @empty
                <tr>
                  <td  class="text-center text-danger" colspan="7">No data availabale</td>
                </tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
