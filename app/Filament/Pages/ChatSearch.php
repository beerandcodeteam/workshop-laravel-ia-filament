<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use League\CommonMark\CommonMarkConverter;
use Livewire\Attributes\On;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class ChatSearch extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $title = "Busca";

    protected static string $view = 'filament.pages.chat-search';

    public string $newMessage = '';
    public array $messages = [];
    public $is_streaming = false;
    public bool $isStreaming = false;

    public string $session = "";

    public function mount()
    {

        $this->session = now();
        // Inicializar mensagens se necessário
        if (!is_array($this->messages)) {
            $this->messages = [];
        }
    }

    public function sendMessage()
    {
        if (empty(trim($this->newMessage))) {
            return;
        }

        // Adicionar mensagem do usuário
        $this->messages[] = [
            'text' => $this->newMessage,
            'sender' => 'user'
        ];

        // Adicionar placeholder para resposta do bot
        $this->messages[] = [
            'text' => '',
            'sender' => 'bot',
        ];

        $this->is_streaming = true;
        $this->dispatch('streamResponse', $this->newMessage);

        $this->newMessage = '';
    }

    #[On('streamResponse')]
    public function streamResponse(string $message)
    {
        $converter = new CommonMarkConverter();
        $response  = Http::langFlow()
            ->withOptions([
                'stream' => true,
            ])
            ->post("run/" . config('langflow.rag_agent_id') . "?stream=true", [
                "session_id" => $this->session,
                "input_value" => $message,
            ]);


        $body = $response->toPsrResponse()->getBody();

        $buffer = '';
        while (!$body->eof()) {
            $chunk = $body->read(1024); // lê 1KB do stream
            $buffer .= $chunk;

            // Quebra por linhas (pois SSE envia uma linha por evento)
            while (($pos = strpos($buffer, "\n")) !== false) {
                $line = trim(substr($buffer, 0, $pos));
                $buffer = substr($buffer, $pos + 1);

                // Ignora linhas vazias ou "ping"
                if (empty($line) || str_starts_with($line, ':')) {
                    continue;
                }

                // Cada linha deve ser um JSON
                try {
                    $data = json_decode($line, true);

                    if (isset($data['event']) && $data['event'] === 'add_message') {
                        if ($data['data']['text'] && $data['data']['text'] !== $message) {
                            $this->stream('iaresponse', $data['data']['text'], true);
                            $this->messages[count($this->messages) - 1]['text'] = $data['data']['text'];
                        }
                    }

                } catch (\Throwable $e) {
                    Log::error("Erro parse JSON do stream: " . $e->getMessage());
                }
            }
        }

        $this->is_streaming = false;
    }

    public function getTitle(): string|Htmlable
    {
        return '';
    }
}
