<x-filament-panels::page>
    <div class="flex flex-col h-[calc(100vh-130px)] bg-gray-50 dark:bg-[#09090b]">
        <!-- Header -->
        <!-- Chat Messages -->
        <div id="chat-container" class="flex-1 overflow-y-auto p-6 space-y-4">
            @foreach ($messages as $message)
                <div class="flex {{ $message['sender'] === 'user' ? 'justify-end' : 'justify-start' }}">
                    <div class="max-w-lg px-4 py-3 rounded-2xl shadow
                    {{ $message['sender'] === 'user'
                        ? 'bg-primary-600 text-white'
                        : 'bg-gray-200 text-gray-900 dark:bg-gray-700 dark:text-gray-100' }}"
                         @if($loop->last) wire:stream="iaresponse" @endif
                    >
                        {!! $message['text'] !!}

                        @if($loop->last && $is_streaming)
                            <div class="flex space-x-1">
                                <span class="inline-block w-2 h-2 bg-current rounded-full animate-dot-1"></span>
                                <span class="inline-block w-2 h-2 bg-current rounded-full animate-dot-2"></span>
                                <span class="inline-block w-2 h-2 bg-current rounded-full animate-dot-3"></span>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Input Box -->
        <div class="p-4 border-t rounded-2xl bg-white dark:bg-gray-800 dark:border-gray-700 flex items-center gap-2">
            <input
                type="text"
                wire:model="newMessage"
                wire:keydown.enter="sendMessage"
                placeholder="Busque por um filme que voce lembra só uma parte mas nao sabe o nome"
                class="flex-1 border-gray-300 dark:border-gray-600 rounded-xl px-4 py-3 text-sm placeholder-gray-400 dark:placeholder-gray-500 focus:border-primary-500 focus:ring-primary-500 focus:outline-none focus:ring-1 dark:bg-gray-700 dark:text-gray-100"
            >
            <button
                wire:click="sendMessage"
                class="inline-flex items-center justify-center rounded-xl bg-primary-600 px-4 py-3 text-sm font-medium text-white shadow-sm hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500"
            >
                <span wire:loading.remove wire:target="sendMessage">
                    Enviar
                </span>
                <span wire:loading wire:target="sendMessage" class="flex items-center gap-1">
                    <svg class="w-4 h-4 animate-spin text-white" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor"
                              d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z">
                        </path>
                    </svg>
                </span>
            </button>
        </div>

    </div>
</x-filament-panels::page>
