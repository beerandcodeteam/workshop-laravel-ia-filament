<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Facades\Http;

class ChatSearch extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $title = "Busca";

    protected static string $view = 'filament.pages.chat-search';

    public string $newMessage = '';
    public array $messages;

    public function sendMessage()
    {
        $this->messages[] = [
            'text' => $this->newMessage,
            'sender' => 'user'
        ];

        $result = Http::langFlow()
            ->post('run/1c5fd154-5eda-429d-b372-317ff94c486e?stream=false',[
                'tweaks' => [
                    'ChatInput-RRdx2' => [
                        "input_value" => $this->newMessage
                    ]
                ]
            ]);

        dd($result->json());


    }

    public function getTitle(): string|Htmlable
    {
        return '';
    }


}
