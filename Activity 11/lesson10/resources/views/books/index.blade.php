@extends('master')

@section('content')
<div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-primary">Book Library</h2>
        <a href="{{ route('books.create') }}" class="btn btn-primary"> Add New Book</a>
    </div>

    @if ($books->isEmpty())
        <div class="alert alert-primary text-center text-primary">No books yet. Start building your library!</div>
    @else
        <div class="d-flex flex-column gap-3">
            @foreach ($books as $book)
                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-body d-flex flex-column flex-md-row justify-content-between align-items-md-center">
                        <div class="mb-3 mb-md-0">
                            <h5 class="mb-1 text-primary">{{ $book->title }}</h5>
                            <p class="mb-1 text-muted">by {{ $book->author }}</p>
                            <p class="mb-0"><small><i class="bi bi-calendar"></i> {{ $book->published_date }}</small></p>
                        </div>
                        <div class="d-flex gap-2">
                            <a href="{{ route('books.edit', $book->id) }}" class="btn btn-sm btn-outline-secondary">
                                <i class="bi bi-pencil"></i> Edit
                            </a>
                            <form action="{{ route('books.destroy', $book->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this book?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                    <i class="bi bi-trash"></i> Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
