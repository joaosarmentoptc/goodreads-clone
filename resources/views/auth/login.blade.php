@extends('layouts.app')

@section('content')

<div class="container is-max-tablet">

    <form class="box" method="POST" action={{ route('auth.login.post') }}>
        <div class="block">
            <h1 class="title">LOGIN</h1>
        </div>
        @csrf
        <div class="field">
            <p class="control has-icons-left">
            <input name="email" class="input" type="email" placeholder="Email">
            <span class="icon is-small is-left">
                <i class="fas fa-envelope"></i>
            </span>
            </p>
        </div>
        <div class="field">
            <p class="control has-icons-left">
            <input name="password" class="input" type="password" placeholder="Password">
            <span class="icon is-small is-left">
                <i class="fas fa-lock"></i>
            </span>
            </p>
        </div>
        <div class="field">
            <p class="control">
            <button type="submit" class="button is-success">
                Login
            </button>
            </p>
        </div>
    </form>

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="notification is-danger">
                <button class="delete"></button>
                {{$error}}
            </div>
        @endforeach
    @endif

</div>
@endsection
