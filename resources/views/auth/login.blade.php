@extends('layout')
@section('content')


<div class="wrapper fadeInDown">
  <div id="formContent">

    <!-- Login Form -->
    <form>
      <input type="text" id="email" class="fadeIn second" name="email" placeholder="email">
      <input type="password" id="password" class="fadeIn third" name="password" placeholder="password">
      
      @include('partials._status')
      <input type="button" id="btn_login" class="fadeIn fourth" value="Log In">
      <a href="{{ url('/register') }}">Register</a>
      
    </form>

  </div>
</div>
@endsection