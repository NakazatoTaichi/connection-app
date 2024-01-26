@extends('layouts.subLayout')

@section('title', 'チャット画面')

@section('main')
<div class="container" style="padding: 20px;">
    <div class="sender py-3 row" style="font-size: 1.5rem;">
        <div class="col-2">
            <a style="text-decoration:none;" href="{{ route('friend.index') }}">
                戻る
            </a>
        </div>
        <div class="col-8 text-center">
            <b>{{ $user->name }}</b>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="overflow-scroll" style="height: 500px;">
                <div id="scroll-inner">
                    <div id="chat-area">
                        @foreach ($messages as $message)
                            @if ($message->user_id === auth()->user()->id)
                                <div class="message-container d-flex justify-content-end text-end">
                                    <div class="timestamp align-self-end" style="margin-right: 5px;">
                                        {{ $message->created_at->format('G:i') }}
                                    </div>
                                    <div class="sent-message">{{ $message->message }}</div>
                                </div>
                            @else
                                <div class="message-container d-flex justify-content-start text-start">
                                    <div class="align-self-start">
                                        <img src="{{ asset('storage/icons/' . $user->icon )}}" alt="icon" class="img-fluid rounded-circle" style="width: 50px; height: 50px; margin-right: 5px;">
                                    </div>
                                    <div class="received-message">{{ $message->message }}</div>
                                    <div class="timestamp align-self-end" style="margin-left: 5px;">
                                        {{ $message->created_at->format('G:i') }}
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="fixed-bottom-input">
        <form id="chat-form" method="POST" action="{{ route('chat.send', $user) }}">
            @csrf
            <div class="input-group">
                <input type="text" name="message" class="form-control" placeholder="メッセージを入力" aria-label="メッセージを入力" aria-describedby="button-send" style="min-height: 50px;">
                <button class="btn btn-primary" type="submit" id="button-send">送信</button>
            </div>
        </form>
    </div>
</div>
    <style>
        .main {
            background-color: #d5f0d4;
        }
        .message-container {
            margin-bottom: 15px;
        }
        .received-message {
            background-color: #f0f0f0;
            border-radius: 10px;
            padding: 10px;
            width: fit-content;
            max-width: 50%;
            word-wrap: break-word;
            margin-left: 0;
            font-size: 24px;
        }
        .sent-message {
            background-color: #3490dc;
            border-radius: 10px;
            padding: 10px;
            color: #fff;
            width: fit-content;
            max-width: 50%;
            word-wrap: break-word;
            font-size: 24px;
            text-align: left;
        }
        .timestamp {
            color: #777;
        }
        .fixed-bottom-input {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 40px;
            margin-bottom: 20px;
            background-color: #fff;
            border-top: 1px solid #ddd;
        }
    </style>
    <script>
        let target = document.getElementById('scroll-inner');
        target.scrollIntoView(false);
    </script>
    <script src="https://cdn.jsdelivr.net/momentjs/2.29.1/moment.min.js"></script>
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <script>
        Pusher.logToConsole = true;

        var pusher = new Pusher('bf5e6c5cbc26da5c80b0', {
            cluster: 'ap3'
        });

        var channel = pusher.subscribe('my-channel');
        channel.bind('my-event', function(data) {
            var newMessageContainer = document.createElement('div');
            var messageClass = data.user_id === {{ auth()->user()->id }} ? 'd-flex justify-content-end text-end' : 'd-flex justify-content-start text-start';
            newMessageContainer.className = 'message-container ' + messageClass;

            var timestampDiv = document.createElement('div');
            timestampDiv.className = 'timestamp align-self-end';
            var timestamp = new Date(data.chat.created_at);
            var formattedTimestamp = timestamp.toLocaleTimeString('ja-JP', { hour: 'numeric', minute: 'numeric' });
            timestampDiv.innerHTML = formattedTimestamp;

            var messageDiv = document.createElement('div');
            messageDiv.className = data.user_id === {{ auth()->user()->id }} ? 'sent-message' : 'received-message';
            messageDiv.innerHTML = data.chat.message;

            if (data.user_id !== {{ auth()->user()->id }}) {
                var iconDiv = document.createElement('div');
                var iconImg = document.createElement('img');
                iconImg.src = '/storage/icons/' + data.user.icon;
                iconImg.alt = "icon";
                iconImg.className = "img-fluid rounded-circle";
                iconImg.style = "width: 50px; height: 50px; margin-right: 5px;";
                iconDiv.appendChild(iconImg);
                newMessageContainer.appendChild(iconDiv);
            }

            newMessageContainer.appendChild(messageDiv);
            newMessageContainer.appendChild(timestampDiv);

            document.getElementById('chat-area').appendChild(newMessageContainer);

            let target = document.getElementById('scroll-inner');
            target.scrollIntoView(false);
        });
    </script>
@endsection
