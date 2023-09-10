@extends('layout')
@section('content')

<div class="wrapper fadeInDown">
    
    <div id="formContent">
    <h2> Register User</h2>
        <form>
            <input type="text" id="name" class="fadeIn second" name="name" placeholder="Name">
            <input type="text" id="email" class="fadeIn second" name="email" placeholder="Email">
            <input type="password" id="password" class="fadeIn third" name="password" placeholder="Password">
            <input type="password" id="confirm_password" class="fadeIn third" name="confirm_password" placeholder="Confirm password">

            @include('partials._status')
            <input type="button" id="btn_register" class="fadeIn fourth" value="Register">
            <a href="{{ url('/') }}">Go To Login</a>

        </form>

    </div>
</div>,
@endsection