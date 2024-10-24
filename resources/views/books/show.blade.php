@extends('layouts.app')

@section('content')

@php
    $userRating = $book->userRating(Auth::id());
    $bookId = $book->id;
@endphp

<div class="columns">
    <div class="column is-one-quarter">
        <div class="block">
        <img src={{$book->image_url}} />
        </div>
        <div class="block">
            @for ($i = 1; $i <= $userRating; $i++)
                <a href="javascript:void(0)" onClick="rateBook({{$bookId}}, {{$i}})" class="has-text-warning">
                    <span class="icon has-text-warning"><i class="fas  fa-star"></i></span>
                </a>
            @endfor
            @for ($i = $userRating; $i < 5; $i++)
                <a href="javascript:void(0)" onClick="rateBook({{$bookId}}, {{$i + 1}})" class="has-text-grey">
                    <span class="icon"><i class="fas  fa-star"></i></span>
                </a>
            @endfor
        </div>
    </div>
    <div class="column">
        <h1 class="title">{{$book->title}}</h1>
        <p class="subtitle">{{$book->author->name}}</p>
        <p>{{$book->description}}</p>
    </div>
</div>

@endsection

<script>
    function rateBook(bookId, ratingValue) {
        axios.post(`/books/${bookId}/rating/${ratingValue}`, {
            rating: ratingValue
        }, {
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}' // CSRF token for security
            }
        })
        .then(function (response) {
            window.location.reload();
        })
        .catch(function (error) {
            console.error('Error:', error);
            alert('An error occurred while submitting your rating.');
        });
    }
</script>
