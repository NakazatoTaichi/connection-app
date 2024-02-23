@extends('layouts.subLayout')

@section('title', 'チャット画面')

@section('main')
<div class="header bg-success bg-gradient" style="z-index: 10;">
    <div class="sender p-4 row" style="font-size: 1.5rem;">
        <div class="col-2">
            <a style="text-decoration:none; color:black;" href="{{ route('friend.index') }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-arrow-left-square" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M15 2a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2zM0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm11.5 5.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z"/>
                </svg>
            </a>
        </div>
        <div class="col-8 text-center">
            <b>{{ $user->name }}</b>
        </div>
    </div>
</div>
<div class="container">
    <div class="card border border-dark" style="padding-top: 84px;">
        <div class="card-body">
            <div class="overflow-scroll" style="height: 68vh">
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
                                        @if ($user->icon)
                                            <img src="{{ asset('storage/icons/' . $user->icon )}}" alt="icon" class="img-fluid rounded-circle" style="width: 50px; height: 50px; margin-right: 15px;">
                                        @else
                                            <div class="icon-placeholder rounded-circle" style="width: 50px; height: 50px; background-color: #CCCCCC; margin-right: 5px;"></div>
                                        @endif
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
    <div class="fixed-bottom-input border border-2 border-dark-subtle rounded-5" style="z-index: 10; background-color: #f0f8ff;">
        <form id="chat-form" method="POST" action="{{ route('chat.send', $user) }}">
            @csrf
            <div class="input-group p-5">
                <input type="text" name="message" class="form-control border border-2 border-dark-subtle" placeholder="メッセージを入力" aria-label="メッセージを入力" aria-describedby="button-send" style="min-height: 50px;">
                <button class="btn btn-primary" type="submit" id="button-send">
                    <svg xmlns="http://www.w3.org/2000/svg" width="35" height="25" fill="currentColor" class="bi bi-send" viewBox="0 0 16 16">
                        <path d="M15.854.146a.5.5 0 0 1 .11.54l-5.819 14.547a.75.75 0 0 1-1.329.124l-3.178-4.995L.643 7.184a.75.75 0 0 1 .124-1.33L15.314.037a.5.5 0 0 1 .54.11ZM6.636 10.07l2.761 4.338L14.13 2.576 6.636 10.07Zm6.787-8.201L1.591 6.602l4.339 2.76 7.494-7.493Z"/>
                    </svg>
                </button>
            </div>
        </form>
    </div>
</div>
    <style>
        .header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
        }

        .card {
            scroll-padding-bottom: 146px;
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
            position: relative;
        }
        .received-message::before {
            content: '';
            width: 0;
            height: 0;
            border: 8px solid  transparent;
            position:absolute;
            top: 15px;
            left: -16px;
            border-right-color: #f0f0f0;
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
            left: 70px;
            right: 70px;
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
                if (data.user.icon) {
                    var iconImg = document.createElement('img');
                    iconImg.src = '/storage/icons/' + data.user.icon;
                    iconImg.alt = "icon";
                    iconImg.className = "img-fluid rounded-circle";
                    iconImg.style = "width: 50px; height: 50px; margin-right: 15px;";
                    iconDiv.appendChild(iconImg);
                } else {
                    iconDiv.className = "icon-placeholder rounded-circle";
                    iconDiv.style = "width: 50px; height: 50px; background-color: #CCCCCC; margin-right: 5px;";
                }
                newMessageContainer.appendChild(iconDiv);
            }

            if (data.user_id !== {{ auth()->user()->id }}) {
                timestampDiv.style = "margin-left: 5px;";
                newMessageContainer.appendChild(messageDiv);
                newMessageContainer.appendChild(timestampDiv);
            } else {
                timestampDiv.style = "margin-right: 5px;";
                newMessageContainer.appendChild(messageDiv);
                newMessageContainer.appendChild(timestampDiv);
            }

            document.getElementById('chat-area').appendChild(newMessageContainer);

            let target = document.getElementById('scroll-inner');
            target.scrollIntoView(false);
        });
    </script>
@endsection
