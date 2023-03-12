@extends('layouts.dashboard')
@section('title', $course->title)
@section('style')
    <link rel="stylesheet" href="{{asset('css/chatbox.css')}}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
@endsection
@section('content')
    @include('teacher.class.modal')
    @include('teacher.class.assignmentmodal')
    <div class="container p-3">
        <div class="jumbotron">
            <h2>{{$course->title}} - Section {{$section}}</h2>
            @if(count($students) <= 0 && count($posts) <= 0)
                <form action="{{route('dashboard.class.section.remove', ['id' => $course->id])}}" method="post">
                    @csrf
                    @method('put')
                    <input type="hidden" name="section" value="{{$section}}">
                    <button class="btn btn-danger mr-2 float-right" onclick="return confirm('Are you sure?')">Remove Section</button>
                </form>
            @endif
            <button class="btn btn-primary mr-2 float-right" data-toggle="modal" data-target="#newAssignment">New Assignment</button>
            <button class="btn btn-primary mr-2 float-right" data-toggle="modal" data-target="#newPost">New Post</button>
            <a href="{{route('dashboard.class.open', ['id' => $course->id])}}" class="btn btn-primary mr-2 float-right">Back</a>
            <h6>Course Code: {{$course->code}}</h6>
            <p>{{$course->description}}</p>
        </div>
        <div class="row">
            <div class="col-md-6">
                <h4 class="mb-3">Posts</h4>
                @foreach($posts as $post)
                    <div class="card post mt-3">
                        <div class="card-body">
                            <p class="card-text">{{$post->text}}</p>
                            <p class="card-text">
                                <small class="text-muted">Posted on {{$post->created_at->format("d M, Y h:i A")}}</small>
                            </p>
                            <a href="{{route('dashboard.post.open', ['id' => $post->id])}}" class="mt-3">View Details</a>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="col-md-6">
                <h4 class="mb-3">Assignments</h4>
                <div class="card post mt-3">
                    <div class="card-body">
                        <p class="card-text">Assignment</p>
                        <p class="card-text">
                            <small class="text-muted">Posted on</small>
                        </p>
                        <a href="{{route('dashboard.post.open', ['id' => $post->id])}}" class="mt-3">View Details</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div style="position: fixed; right: 20px;bottom: 20px; width: 400px;height: 500px;">
        <button class="btn btn-block btn-primary" style="position: absolute; bottom: 10px;" id="chat-btn">Chat</button>
        <div class="card card-bordered d-none" style="box-shadow: 0 0 4px 2px gray" id="chat-box">
            <div class="card-header">
                <h4 class="card-title">Group Chat <strong>({{$course->title}})</strong></h4>
                <button type="button" class="close btn-lg" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="ps-container ps-theme-default ps-active-y" id="chat-content" style="overflow-y: scroll !important; height:370px !important;">
                <div class="ps-scrollbar-x-rail" style="left: 0px; bottom: 0px;"><div class="ps-scrollbar-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps-scrollbar-y-rail" style="top: 0px; height: 0px; right: 2px;"><div class="ps-scrollbar-y" tabindex="0" style="top: 0px; height: 2px;"></div></div></div>
            <div class="publisher bt-1 border-light">
                <img class="avatar avatar-xs" src="https://img.icons8.com/color/36/000000/administrator-male.png" alt="...">
                <input class="publisher-input" id="chat-input" type="text" placeholder="Write something">
                <button class="publisher-btn text-info" id="send-btn" data-abc="true"><i class="fa fa-paper-plane"></i></button>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="https://server.sajjadamin.com:1000/socket.io/socket.io.min.js"></script>
    <script>

        $('#image').on('change', function (e){
            const files = $(this).prop('files');
            if(files.length > 0){
                const file = files[0];
                const fileReader = new FileReader();
                fileReader.addEventListener('load', function (e){
                    $('#imageDisplay').attr('src', e.target.result);
                });
                fileReader.readAsDataURL(file);
            }else{
                $('#imageDisplay').attr('src', '');
            }
        });

        const socket = io('https://server.sajjadamin.com:1000');
        socket.on('connect', function () {
            socket.emit('socket_client_config', {
                event_name: 'classroom',
                event_token: 'zYdR4FSWR5bLHgRPckkK90uXUkmUJznL'
            });
        });
        let getMessage = (offset, cb) => {
            let url = `{{route('chat.get', ['offset' => 'offset', 'course_id' => $course->id])}}`
            axios.get(url.replace('offset', offset))
                .then(function (response) {
                    cb(null, response.data);
                })
                .catch(function (error) {
                    cb(error, null);
                });
        }
        $(document).ready(function () {
            // load messages
            let limit = 100;
            let offset = 0;

            $('#chat-btn').click(function () {
                localStorage.setItem('chat', 'open');
                $('#chat-box').toggleClass('d-none');
                $('#chat-btn').toggleClass('d-none');
                $('.ps-container').scrollTop($('.ps-container').prop("scrollHeight"));
                $('#chat-input').focus();
            });
            $('#chat-box .close').click(function () {
                localStorage.setItem('chat', 'close');
                $('#chat-box').toggleClass('d-none');
                $('#chat-btn').toggleClass('d-none');
            });
            if(localStorage.getItem('chat') === 'open'){
                $('#chat-box').toggleClass('d-none');
                $('#chat-btn').toggleClass('d-none');
                $('.ps-container').scrollTop($('.ps-container').prop("scrollHeight"));
                $('#chat-input').focus();
            }
            $('#chat-input').keypress(function (e) {
                if (e.which === 13) {
                    $('#send-btn').click();
                    $('#chat-input').val('');
                }
            });
            $('#send-btn').click(function(){
                axios.post('{{route('chat.send')}}', {
                    name: '{{Auth::user()->name}}',
                    message: $('#chat-input').val(),
                    course_id: {{$course->id}},
                    user_id: {{Auth::user()->id}},
                    section: '{{$section}}'
                }).then(function (response) {
                    console.log(response);
                }).catch(function (error) {
                    console.log(error);
                });
                socket.emit('classroom', {
                    message: $('#chat-input').val(),
                    course_id: {{$course->id}},
                    student_id: {{Auth::user()->id}},
                    section: '{{$section}}',
                    student_name: '{{Auth::user()->name}}'
                });
            });
            let lastSender = '';
            socket.on('classroom', function(data){
                if(data.course_id === {{$course->id}} && data.section === '{{$section}}'){
                    let messageContent = '';
                    if(data.student_id === {{Auth::user()->id}}){
                        messageContent = '<div class="media media-chat media-chat-reverse">';
                    }else{
                        messageContent = '<div class="media media-chat"><span>'+data.student_name+':</span>';
                    }
                    messageContent += '<div class="media-body"><p>'+data.message+'</p></div></div>';
                    if(lastSender === data.student_id){
                        $('.media-body:last').append('<p>'+data.message+'</p>');
                    }else{
                        $('#chat-content').append(messageContent);
                    }
                    $('.ps-container').scrollTop($('.ps-container').prop("scrollHeight"));
                    lastSender = data.student_id;
                }
            });

            getMessage(offset, (err, data) => {
                if (err) {
                    console.log(err);
                } else {
                    let messageContent = '';
                    data.forEach(d=>{
                        if(d.course_id === {{$course->id}}){
                            if(d.user_id === {{Auth::user()->id}}){
                                messageContent = '<div class="media media-chat media-chat-reverse">';
                            }else {
                                messageContent = '<div class="media media-chat"><span>'+d.name+':</span>';
                            }
                            messageContent += '<div class="media-body"><p>'+d.message+'</p></div></div>';
                            if(lastSender === d.user_id){
                                $('.media-body:last').append('<p>'+d.message+'</p>');
                            }else{
                                $('#chat-content').append(messageContent);
                            }
                            $('.ps-container').scrollTop($('.ps-container').prop("scrollHeight"));
                            lastSender = d.user_id;
                        }
                    });
                }
            });
        });
    </script>
@endsection
