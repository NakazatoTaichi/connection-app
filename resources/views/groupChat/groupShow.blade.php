@extends('layouts.subLayout')

@section('title', 'チャット画面')

@section('main')
<div class="container" style="padding: 20px;">
    <div class="sender py-3 row" style="font-size: 1.5rem;">
        <div class="col-2">
            <a style="text-decoration:none;" href="{{ route('group.index') }}">
                戻る
            </a>
        </div>
        <div class="col-8 text-center">
            <b>{{ $group->group_name }}</b>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="overflow-scroll" style="height: 500px;">
                <div id="scroll-inner">
                    <div id="chat-area">
                        @foreach ($messages as $message)
                            <div class="message-container {{ $message->user_id === auth()->user()->id ? 'text-end' : 'text-start' }}">
                                <div class="{{ $message->user_id === auth()->user()->id ? 'sent-message' : 'received-message' }}">
                                    {{ $message->message }}
                                </div>
                                <div class="timestamp">{{ $message->created_at->format('G:i') }}</div>
                            </div>
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
            margin-bottom: 10px;
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
            margin-left: auto;
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
            newMessageContainer.className = 'message-container ' + (data.user_id === {{ auth()->user()->id }} ? 'text-end' : 'text-start');

            var messageDiv = document.createElement('div');
            messageDiv.className = data.chat.user_id === {{ auth()->user()->id }} ? 'sent-message' : 'received-message';
            messageDiv.innerHTML = data.chat.message;

            var timestampDiv = document.createElement('div');
            timestampDiv.className = 'timestamp';
            var timestamp = new Date(data.chat.created_at);
            var formattedTimestamp = timestamp.toLocaleTimeString('ja-JP', { hour: 'numeric', minute: 'numeric' });

            timestampDiv.innerHTML = formattedTimestamp;

            newMessageContainer.appendChild(messageDiv);
            newMessageContainer.appendChild(timestampDiv);

            document.getElementById('chat-area').appendChild(newMessageContainer);

            let target = document.getElementById('scroll-inner');
            target.scrollIntoView(false);
        });
    </script>
@endsection
