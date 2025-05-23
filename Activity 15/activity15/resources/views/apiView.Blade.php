<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Joke API</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-body text-center p-5">
                        <h1 class="card-title h3 mb-4">{{ $joke['setup'] }}</h1>
                        
                        @if($joke['delivery'] != null)
                        <button id="reveal" class="btn btn-primary mb-3">Reveal</button>
                        <div id="delivery" class="alert alert-success" style="display: none;"></div>
                        @endif
                        
                        <div class="mt-4">
                            <a href="{{route('index')}}" class="btn btn-secondary">Get Another Joke</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function(){
            $("#reveal").click(function(){
                $("#delivery").html("{{ $joke['delivery'] }}").slideDown();
                $(this).hide();
            });
        });
    </script>
</body>
</html>