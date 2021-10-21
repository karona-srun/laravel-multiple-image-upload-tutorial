{{-- <html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel Multiple Image Upload</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
</head>

<body>
    <div class="container lst mb-3">
        <h3>
        <a href="{{ route('posts.create') }}">Create</a>
        </h3>
    </div>
    <div class="container">
    <div class="card p-3">
        @foreach ($posts as $post)
            <a href="{{ route('posts.show',$post->id) }}"><h4>{{ $post->title }}</h4></a> 
        @endforeach
    </div>
</div>
    <script type="text/javascript">
    </script>
</body>
</html> --}}

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Laravel Multiple Images Upload Tutorial Example From Scratch - jQuery Ajax</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css"
        crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.min.css"
        crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.6/css/fileinput.min.css" media="all"
        rel="stylesheet" type="text/css" />

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.6/js/plugins/piexif.min.js"
        type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.6/js/plugins/sortable.min.js"
        type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.6/js/fileinput.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.6/js/locales/LANG.js"></script>
    <style type="text/css">
        .main-section {
            margin: 0 auto;
            padding: 30px;
            margin-top: 200px;
            background-color: #666;
            box-shadow: 0px 0px 20px #f8f8f8;
        }

        .fileinput-remove,
        .fileinput-upload {
            display: none;
        }

        .file-drop-zone {
            min-height: 100% !important;
        }

    </style>
</head>

<body>
    <div class="container">
        <h1>Upload Multiple Images using jQuery, Ajax and Laravel</h1><br>
        {!! csrf_field() !!}
        <div class="file-loading">
            <input id="input-705" name="kartik-input-705[]" type="file" accept="image/*" multiple>
        </div>

    </div>
    <script type="text/javascript">
        $(document).ready(function() {
            $("#input-705").fileinput({
                theme: 'fa',
                allowedFileExtensions: ['jpg', 'jpeg', 'png', 'gif'],
                uploadUrl: "{{ url('/upload') }}",
                uploadExtraData: function() {
                    return {
                        _token: $("input[name='_token']").val(),
                    }
                },
                deleteUrl: "{{ url('/file-delete') }}",
                maxFileSize: 2000,
                maxFilesNum: 10,  
                maxFileCount: 5,
                overwriteInitial: false,
                initialPreviewAsData: true 
            });
        });
    </script>
</body>

</html>
