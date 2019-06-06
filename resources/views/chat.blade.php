<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Chat</title>
    <link rel="stylesheet" href="{{ url('css/app.css') }}">
    <style>
        .list-group{
            height: 200px;
            overflow-y: auto;
        }
        textarea {
            resize: none;
          }
    </style>
</head>
<body>
    
  <div class="container">
      <div class="row" id="app">
          <div class="col-md-4 mt-5 offset-md-4 offset-sm-1 col-sm-10">
                <h6 class="text-center txt-dark">Username : {{$username }}</h6>
            <li class="list-group-item active">Chat Room
                <span class="badge badge-pill badge-success">@{{numberusers}}</span>
            </li>
                <ul class="list-group" v-chat-scroll>
                    <messege
                    v-for="value,index in chat.messege"
                     :color=chat.color[index]
                     :user= chat.user[index]
                     :time= chat.time[index]
                     :key=value.index>
                     @{{ value }}
                    </messege>
                </ul>
                <div class="badge p-3 m-1 rounded float-left badge-primary">@{{typing}}</div>
                <textarea 
                @keyup.enter="send" 
                v-model="messege" type="text" 
                placeholder="Type a messege..." 
                class="form-control mt-2" cols="10" rows="2"></textarea>
        </div>
      </div>
  </div>
    <script src="{{ url('js/app.js') }}"></script>
</body>
</html>