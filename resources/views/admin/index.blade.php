@extends('layouts.app')

@section('content')
Hi!
{{ Auth::user()->name }}
You're an admin!
@endsection
