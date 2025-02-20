@extends('frontend.layouts.master')
@section('title', 'Delete Account')
@push('css')
    <style>
        
    .card {
      background-color: #ffffff;
      border-radius: 8px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      padding: 20px;
      text-align: center;
    }

    h1 {
      color: #333333;
    }

    .button {
      display: inline-block;
      padding: 10px 20px;
      margin: 10px;
      font-size: 16px;
      text-align: center;
      text-decoration: none;
      outline: none;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }

    .button-yes {
      background-color: #e74c3c;
      color: #ffffff;
    }
    /* #e74c3c */
    .button-no {
      background-color:  #4caf50;
      color: #ffffff;
    }
    </style>
@endpush
@section('content')
    
        <div class="container">
            <div class="card">
  <h1>Do you want to delete your account?</h1>
  <button class="button button-no">No</button>


 

  <form action="{{ route('account.delete') }}" method="POST">
    @csrf
    
    <button type="submit" class="button-yes">Delete Account</button>
</form>
</div>
          
        </div>
    
@endsection



