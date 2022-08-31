<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Laravel 9 CRUD Tutorial</title>

    {{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" > --}}
    <!-- CSS only -->
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.plyr.io/3.7.2/plyr.css" />
</head>
<body>

<div class="container mt-2">

<div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Laravel 9 Post CRUD Tutorial</h2>
            </div>
            <div class="pull-right mb-2">
                <a class="btn btn-success" href="{{ route('posts.create') }}"> Create New Post</a>
            </div>
        </div>
    </div>
   
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
   
    <table class="table table-bordered">
        <tr>
            <th>S.No</th>
            <th>Image</th>
            <th>video</th>
            <th>Title</th>
            <th>Description</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($posts as $post)
        <tr>
            <td>{{ $post->id }}</td>
            <td><img src="{{ Storage::url($post->image) }}" height="75" width="75" alt="" /></td>
            <td>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $post->id }}">
                View Video player
                </button>

            </td>
            <td>{{ $post->title }}</td>
            <td>{{ $post->description }}</td>
            <td>
                <form action="{{ route('posts.destroy',$post->id) }}" method="POST">
    
                    <a class="btn btn-primary" href="{{ route('posts.edit', $post->id) }}">Edit</a>
   
                    @csrf
                    @method('DELETE')
      
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>

                    <!-- Modal -->
                <div class="modal fade" id="exampleModal{{ $post->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <h2>{{ $post->title }}</h2>
                            {{-- <video width="320" height="240" controls>
                                <source src="{{ Storage::url($post->video) }}" type="video/mp4">
                                Your browser does not support the video tag.
                            </video> --}}



                            <video class="js-player" id="player" playsinline controls width="320" height="240">
                                <source src="{{ Storage::url($post->video) }}" type="video/mp4" />
                            </video>



                        </div>
                        {{-- <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                        </div> --}}
                        </div>
                    </div>
                </div>

        @endforeach
    </table>
  
    {!! $posts->links() !!}


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
<script src="https://cdn.plyr.io/3.7.2/plyr.polyfilled.js"></script>

<script>
    // const player = new Plyr(document.getElementById('player'));
    const players = Array.from(document.querySelectorAll('.js-player')).map((p) => new Plyr(p));
</script>

</body>
</html>