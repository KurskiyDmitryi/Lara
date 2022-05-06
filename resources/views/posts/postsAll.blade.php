@extends('layout.app')
@section('title','Posts All')

@section('content')
    <div>
        <label for="search">Search</label>
        <input type="text" name="search" class="search">
        <button class="btn btn-primary" id="button">Search</button>
    </div>
    <ul id="list_of_posts">

        @foreach($posts as $post)

           <a href="{{route('post_view_one',$post['id'])}}"><li><h2>{{$post['title']}}<button class="btn btn-primary">More</button></h2></li></a>

        @endforeach

    </ul>
    <script>
        $(document).ready(function (){
        $('.search').on('keyup',function (){
            let data = $('.search').val()
            $.ajax({
                method: "POST",
                url: "{{route('search')}}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    data: data,
                },
                dataType: "html",
                success: function (response){
                    $("#list_of_posts").html('');
                    $("#list_of_posts").append(response);
                },
            });

        })
        })

    </script>
@endsection
