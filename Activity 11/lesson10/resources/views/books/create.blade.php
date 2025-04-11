@extends('master')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="col-md-8">
        <div class="card shadow-lg border-0 rounded-4">
            <div class="card-body p-5">
                <h3 class="text-center mb-4 text-primary"><i class="bi bi-journal-plus"></i> Add New Book</h3>

                <form action="{{ route('books.store') }}" method="POST">
                    @csrf

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="title" name="title" placeholder="Book Title" required>
                        <label for="title"><i class="bi bi-book"></i> Title</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="author" name="author" placeholder="Author" required>
                        <label for="author"><i class="bi bi-person"></i> Author</label>
                    </div>

                    <div class="form-floating mb-4">
                        <input type="date" class="form-control" id="published_date" name="published_date" placeholder="Published Date" required>
                        <label for="published_date"><i class="bi bi-calendar-date"></i> Published Date</label>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="bi bi-save2-fill"></i> Save Book
                        </button>
                        <a href="{{ route('books.index') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-arrow-left"></i> Back to List
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
