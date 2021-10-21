<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel Multiple Image Upload</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <style type="text/css">
        input[type=file] {
            display: inline;
        }

        #image_preview {
            border: 1px solid black;
            padding: 10px;
        }

        #image_preview img {
            width: 200px;
            padding: 5px;
        }

    </style>
</head>

<body>
    <div class="container lst">
        <h3 class="well mt-3">Multiple File Upload | Laravel 
            <a href="{{ route('posts.index') }}" class="text-small">Back to List</a>
        </h3>
        <form method="post" enctype="multipart/form-data" id="myform" action="{{ url('upload-attachment') }}" >
            {{ csrf_field() }}
            <input type="hidden" name="post_id" value="{{ $post->id }}">
            <div class="form-floating mb-3">
                <input type="text" name="title" value="{{ $post->title }}" class="form-control" id="floatingInput"
                    placeholder="Title">
                <label for="floatingInput">Title</label>
            </div>

            <div class="form-floating">
                <textarea name="body" class="form-control" placeholder="Write a body here" id="floatingTextarea2"
                    style="height: 100px">{{ $post->body }}</textarea>
                <label for="floatingTextarea2">Body</label>
            </div>
            <input type="file" id="uploadFile" class="btn btn-defualt" name="uploadFile[]" multiple accept="image/*" onchange="this.form.submit()"/>
        </form>
        <br />
        <div id="image_preview">
            <div class="row">
            @foreach($post->attachments as $att)
            <div class="col-md-2" id="{{ $att->id }}">
                <button type="button" data-id="{{ $att->id }}" class="btn btn-sm btn-danger deleteAttachment">Delete</button>
                <img src="{{ $att->path }}" alt="" srcset="">
            </div>
            @endforeach
        </div>
    </div>
    </div>
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $("#uploadFile").change(function(e) {
            e.preventDefault();
            $('#image_preview').html("");
            var total_file = document.getElementById("uploadFile").files.length;
            for (var i = 0; i < total_file; i++) {
                $('#image_preview').append("<img src='" + URL.createObjectURL(event.target.files[i]) + "'>");
            }
            this.form.submit();
        });

        $('.deleteAttachment').click(function(e){
            var id = $(this).data("id");
            var token = $("meta[name='csrf-token']").attr("content");
            $.ajax(
            {
                url: "/delete-attachment/"+id,
                type: 'DELETE',
                data: {
                    "id": id,
                    "_token": token,
                },
                success: function (){
                    e.preventDefault();
                    $('#'+id).remove();
                }
            });
        })
    </script>
</body>

</html>
