<!DOCTYPE html>
<html>

<head>
    <title>Image Upload</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body class="bg-light">

    <div class="container py-5">
        <h2 class="text-center mb-4">Image Upload</h2>

        <div class="row mb-5">
            <div class="col-md-6 mb-4">
                <div class="card shadow-sm p-4">
                    <h4 class="mb-3">Single Image Upload</h4>
                    <form action="{{ route('photos.store.single') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <input type="file" class="form-control" name="image" required>
                        </div>
                        <button class="btn btn-success w-100" type="submit">Upload</button>
                    </form>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="card shadow-sm p-4">
                    <h4 class="mb-3">Multiple Images Upload</h4>
                    <form action="{{ route('photos.store.multiple') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <input type="file" class="form-control" name="images[]" multiple required>
                        </div>
                        <button class="btn btn-success w-100" type="submit">Upload</button>
                    </form>
                </div>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success text-center">
                {{ session('success') }}
            </div>
        @endif

        <h4 class="text-center mb-4">Uploaded Images</h4>
        <div class="row">
            @foreach($photos as $photo)
                <div class="col-6 col-md-3 mb-4">
                    <div class="card shadow-sm">
                        <img src="{{ asset('images/' . $photo->image) }}" class="card-img-top" alt="Photo"
                            style="height: 200px; object-fit: cover;">
                        <div class="card-body text-center">
                            <form action="{{ route('photos.destroy', $photo->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="d-flex justify-content-center mt-4">
            {{ $photos->links() }}
        </div>
    </div>

</body>

</html>