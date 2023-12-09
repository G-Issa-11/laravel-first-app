<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Blog App</title>
</head>
<body>

    @auth
    <p>Congrats you are logged in</p>
    <form action="/logout" method="POST">
        @csrf
        <button>Logout!</button>
    </form>

    <form action="/make-post" method="POST">
        @csrf
        <input name="title" type="text" placeholder="Title..">
        <input name="content" type="textarea" placeholder="What's on your mind?...">
        <button>Post</button>
    </form>

    <div>
        @foreach ($posts as $post)
            <div style="background-color: #ccc; padding: 10px; margin: 10px">
            <h1>{{$post['title']}} by {{$post->user->name}}</h1>
            {{$post['content']}}
            <p><a href="/edit-post/{{$post->id}}">Edit</a></p>
            <form action="/delete-post/{{$post->id}}" method="POST">
                @csrf
                @method('DELETE')
                <button>Delete</button>
            </form>
            </div>
        @endforeach
    </div>

    @else
    <form action="/register" method="POST">
        @csrf
        <input name="name" type="text" placeholder="name">
        <input name="email" type="text" placeholder="email">
        <input name="password" type="password" placeholder="password">
        <button>register</button>
    </form>
    <form action="/login" method="POST">
        @csrf
        <input name="loginname" type="text" placeholder="name">
        <input name="loginpassword" type="password" placeholder="password">
        <button>login</button>
    </form>
    @endauth
    

    
</body>
</html>