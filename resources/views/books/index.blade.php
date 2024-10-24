@extends('layouts.app')

@section('content')

@php
    // Get the user's wishlist once before the loop
    $wishlist = Auth::check() ? Auth::user()->wishlist()->pluck('book_id')->toArray() : [];
@endphp

<div class="columns is-multiline">
    @foreach ($books as $book)
        <div class="column is-3">
            <div class="card">
                <div class="card-image">
                  <figure class="image is-4by3">
                    <img
                      src={{$book->image_url}}
                    />
                  </figure>
                </div>
                <div class="card-content">
                  <div class="media">
                    <div class="media-content">
                      <p class="title is-4">{{ Str::limit($book->title, 15) }}</p>
                      <p class="subtitle is-6">{{ $book->author->name }}</p>
                    </div>
                  </div>

                  <div class="content">
                    {{ Str::limit($book->description, 30) }}
                    <p class="subtitle is-6">@ {{ $book->author->name }}</p>
                    <br />
                     <!-- star rating -->
                    @for ($i = 1; $i <= $book->avgRating(); $i++)
                        <span class="icon has-text-warning"><i class="fas  fa-star"></i></span>
                    @endfor
                    @for ($i = $book->avgRating(); $i < 5; $i++)
                        <span class="icon"><i class="fas  fa-star"></i></span>
                    @endfor

                    <br />
                    <div class="content is-flex is-justify-content-space-between is-align-items-center">
                      <div><a href={{ route('books.show', $book->id) }}>View Details</a></div>
                      @if ( !in_array($book->id, $wishlist) )
                      <form action={{ route('wishlist.store', $book->id) }} method="POST">
                        @csrf
                        <button type="submit" class="button is-link is-small">+ Reading List</button>
                    </form>
                      @else
                        <form action={{ route('wishlist.delete', $book->id) }} method="POST">
                            @csrf
                            @method("DELETE")
                            <button type="submit" class="button is-danger is-small">- Reading List</button>
                        </form>
                      @endif
                    </div>
                  </div>
                </div>
              </div>
        </div>
    @endforeach
</div>

@endsection
