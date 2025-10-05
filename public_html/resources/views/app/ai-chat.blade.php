@extends(config('app.layout'))
@section('content')

    <div class="row">
        <div class="col-md-4">
            <div class="card overflow-auto overflow-x-hidden mb-4 mb-lg-0">
                <div class=" p-2 card-body-messages">
                    <div class="d-flex mb-4 pb-1 p-1">
                        <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                            <p class="fw-bold">{{__('Chat History')}}</p>
                            <div class="user-progress">
                                <a href="{{ route('app.ai-chat') }}" class=" text-end btn w-60 btn-rounded btn-dark mb-3"><i
                                            class="bi bi-plus-lg"></i> {{__('New Chat')}}</a>
                            </div>
                        </div>
                    </div>

                    <ul class="p-0 m-0">
                        @foreach($recent_chat_sessions as $recent_chat_session)

                            <a href="{{ route('app.ai-chat', ['session_id' => $recent_chat_session->uuid]) }}" class="">
                                <div class="d-flex mb-4 pb-1 p-1">
                                    <div class="avatar flex-shrink-0 me-3">
                                        <div class="app-avatar-text bg-primary-gradient text-white d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; border-radius: 50%;">
                                            <i class="bi bi-chat-dots" style="font-size: 16px;"></i>
                                        </div>
                                    </div>
                                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                        <div class="me-2">
                                            <h6 class="mb-0"> {{$recent_chat_session->title}}</h6>
                                            <small class="text-muted"> {{$recent_chat_session->created_at->diffForHumans()}}</small>
                                        </div>
                                        <div class="user-progress">
                                            <small class="fw-semibold"><a
                                                        class="text-end ms-4 btn btn-link text-dark px-3 mb-0"
                                                        data-delete-item="true"
                                                        href="{{ route('app.delete-item', ['item' => 'chat-session', 'uuid' => $recent_chat_session->uuid]) }}"><i
                                                            class="bi bi-trash3-fill"></i></a></small>
                                        </div>
                                    </div>
                                </div>
                            </a>

                        @endforeach

                    </ul>

                </div>
            </div>
        </div>
        <div class="col-md-8 mb-4">
            <div class="overflow-x-hidden  overflow-hidden">
                <div class="card">
                    <div class="card-header border-bottom bg-white mb-4 ">
                        <div class="row">
                            <div class="col-md-10">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0 me-3">
                                        <div class="avatar">
                                            <img src="{{ asset('assets/images/xikobot.png') }}" alt="Xikobot" class="rounded-circle" style="width: 40px; height: 40px; object-fit: cover;">
                                        </div>
                                    </div>
                                    <div class="ms-3">
                                        <h6 class="mb-0 d-block  fw-bolder text-dark">Xikobot</h6>
                                        <small class="text-muted">{{$today}}</small>


                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="card-body overflow-auto card-body-messages overflow-x-hidden" id="messages">

                        @if(count($chats) > 0)

                            @foreach($chats as $chat)

                                @if($chat->type == 'user')
                                    <div class="row justify-content-end mb-4">
                                        <div class="col-auto">
                                            <div class="card bg-primary-gradient">
                                                <div class="card-body  py-2 px-3">
                                                    <p class="mb-0 text-start text-white ">
                                                        {!! app_clean_html_content($chat->message) !!}
                                                    </p>
                                                    <div class="d-flex  text-start text-sm opacity-6">
                                                        <small class="text-white">
                                                            {{$chat->created_at->diffForHumans()}}
                                                        </small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @else

                                    <div class="row justify-content-start mb-4">
                                        <div class="col-auto">
                                            <div class="card bg-white">
                                                <div class="card-body  py-2 px-3">


                                                    <p class="mb-0 text-start text-dark ">
                                                        {!! app_clean_html_content($chat->message) !!}
                                                    </p>


                                                    <div class="d-flex  text-start text-sm opacity-6">
                                                        <small class="text-dark">
                                                            {{$chat->created_at->diffForHumans()}}
                                                        </small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                @endif

                            @endforeach

                        @else

                            <div id="no_messages_div" class="row justify-content-center mb-4">
                                <div class="col-auto text-center">

                                    <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" fill="currentColor"
                                         class="bi bi-chat-dots-fill mt-4" viewBox="0 0 16 16">
                                        <path d="M16 8c0 3.866-3.582 7-8 7a9.06 9.06 0 0 1-2.347-.306c-.584.296-1.925.864-4.181 1.234-.2.032-.352-.176-.273-.362.354-.836.674-1.95.77-2.966C.744 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7zM5 8a1 1 0 1 0-2 0 1 1 0 0 0 2 0zm4 0a1 1 0 1 0-2 0 1 1 0 0 0 2 0zm3 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/>
                                    </svg>

                                    <p class="mt-4">  {{__('Opps! No messages')}}</p>
                                    <a href="{{ route('app.ai-chat') }}" class="btn w-60 btn-primary">{{__('Start New Chat')}}</a>

                                </div>
                            </div>

                        @endif

                    </div>
                    <div class="card-footer d-block mt-4">
                        <form class="align-items-center" id="form_chat_input">
                            <div class="d-flex">
                                <div class="input-group">
                                    <input type="text" autofocus id="message" name="message" class="form-control"
                                           placeholder="Como é que posso te ajudar?" aria-label="Message example input">
                                </div>
                                <button id="send_message" class="btn btn-dark mb-0 ms-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                                         class="bi bi-play" viewBox="0 0 16 16">
                                        <path d="M10.804 8 5 4.633v6.734L10.804 8zm.792-.696a.802.802 0 0 1 0 1.392l-6.363 3.692C4.713 12.69 4 12.345 4 11.692V4.308c0-.653.713-.998 1.233-.696l6.363 3.692z"/>
                                    </svg>
                                </button>
                            </div>
                            <input type="hidden" id="chat_session_id" name="session_id"
                                   value="{{$active_chat_session->uuid ?? ''}}">
                        </form>
                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection

@section('scripts')

    <script>
        "use strict"
        window.addEventListener('DOMContentLoaded', () => {


            const form_chat_input = document.getElementById('form_chat_input');
            const message = document.getElementById('message');
            const messages = document.getElementById('messages');
            const no_messages_div = document.getElementById('no_messages_div');

            function escapeHtml(string) {
                let div = document.createElement('div');
                div.textContent = string
                return div.innerHTML;
            }

            messages.scrollTop = messages.scrollHeight;

            form_chat_input.addEventListener('submit', (e) => {
                e.preventDefault();

                if (no_messages_div) {
                    no_messages_div.remove();
                }

                let message_value = message.value;
                message_value = escapeHtml(message_value);

                if (message_value.trim() === '') {
                    return;
                }

                const formData = new FormData(form_chat_input);
                formData.append('message', message.value);
                formData.append('session_id', document.getElementById('chat_session_id').value);

                messages.insertAdjacentHTML(
                    'beforeend',
                    `
                    <div class="row justify-content-end mb-4">
                        <div class="col-auto">
                            <div class="card bg-primary-gradient">
                                <div class="card-body  py-2 px-3">
                                    <p class="mb-0 text-start text-white ">
                                        ${message_value}
                                    </p>
                                    <div class="d-flex  text-start text-sm opacity-6">
                                        <small class="text-white">
                                            ${new Date().toLocaleString()}
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
`
                )

                // Limpar campo e desabilitar controles após enviar
                message.value = '';
                message.disabled = true;
                document.getElementById('send_message').disabled = true;

                // Mostrar indicador de "escrevendo..."
                showTypingIndicator();

                axios.post('{{ route('app.chat') }}', formData)
                    .then((response) => {

                        let replied_message = response.data.message;
                        let replied_at = response.data.created_at;
                        // set the chat session id
                        document.getElementById('chat_session_id').value = response.data.session_id;
                        // convert to local time
                        replied_at = new Date(replied_at).toLocaleString();

                        messages.insertAdjacentHTML(
                            'beforeend',
                            `<div class="row justify-content-start mb-4">
                        <div class="col-auto">
                            <div class="card bg-gray-100">
                                <div class="card-body  py-2 px-3">
                                    <p class="mb-0 text-start text-dark ">
                                        ${replied_message}
                                    </p>
                                    <div class="d-flex  text-start text-sm opacity-6">
                                        <small class="text-dark">
                                            ${replied_at}
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>`
                        );

                        // scroll to the bottom
                        messages.scrollTop = messages.scrollHeight;

                        // Esconder indicador de "escrevendo..."
                        hideTypingIndicator();

                        // Reabilitar controles após receber resposta
                        message.disabled = false;
                        document.getElementById('send_message').disabled = false;
                        message.focus();

                    })
                    .catch((error) => {
                        console.log(error);
                        
                        // Esconder indicador de "escrevendo..." em caso de erro
                        hideTypingIndicator();
                        
                        // Reabilitar controles mesmo em caso de erro
                        message.disabled = false;
                        document.getElementById('send_message').disabled = false;
                        message.focus();
                    });
            });

        });

        // Função para mostrar indicador de "escrevendo..."
        function showTypingIndicator() {
            const messages = document.getElementById('messages');
            const typingDiv = document.createElement('div');
            typingDiv.id = 'typing-indicator';
            typingDiv.className = 'row justify-content-start mb-4';
            typingDiv.innerHTML = `
                <div class="col-auto">
                    <div class="card bg-gray-100">
                        <div class="card-body py-2 px-3">
                            <div class="d-flex align-items-center">
                                <div class="typing-dots">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </div>
                                <span class="ms-2 text-muted">O Xikobot está a escrever...</span>
                            </div>
                        </div>
                    </div>
                </div>
            `;
            messages.appendChild(typingDiv);
            messages.scrollTop = messages.scrollHeight;
        }

        // Função para esconder indicador de "escrevendo..."
        function hideTypingIndicator() {
            const typingIndicator = document.getElementById('typing-indicator');
            if (typingIndicator) {
                typingIndicator.remove();
            }
        }
    </script>

    <style>
        .typing-dots {
            display: inline-flex;
            align-items: center;
        }
        
        .typing-dots span {
            height: 8px;
            width: 8px;
            background-color: #6c757d;
            border-radius: 50%;
            display: inline-block;
            margin: 0 2px;
            animation: typing 1.4s infinite ease-in-out;
        }
        
        .typing-dots span:nth-child(1) {
            animation-delay: -0.32s;
        }
        
        .typing-dots span:nth-child(2) {
            animation-delay: -0.16s;
        }
        
        @keyframes typing {
            0%, 80%, 100% {
                transform: scale(0);
                opacity: 0.5;
            }
            40% {
                transform: scale(1);
                opacity: 1;
            }
        }
    </style>

@endsection
