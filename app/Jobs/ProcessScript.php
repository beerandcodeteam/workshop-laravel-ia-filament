<?php

namespace App\Jobs;

use App\Models\Script;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProcessScript implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(protected Script $script)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $file = Storage::disk('public')->get($this->script->file_path);
        $result = Http::langFlow()
            ->attach(
                'file',
                $file,
                explode('/', $this->script->file_path)[1]
            )
            ->post('files/upload/' . config('langflow.rag_flow_id'))
            ->json();

        $langflow_file_path = $result['file_path'];

        Log::info("Arquivo criado: {$langflow_file_path}");

        $payload = [
            'session_id' => Str::uuid(),
            'tweaks' => [
                'File-c58Jg' => [
                    'path' => [
                        $langflow_file_path,
                    ],
                ],
                "DataFrameOperations-Jj9i1" => [
                    "new_column_value" => (string)$this->script->id,
                ],
                "Prompt Template-7xDbq" => [
                    "script_id" => (string)$this->script->id,
                ]
            ],
        ];

        $response = Http::langFlow()
            ->timeout(0)
            ->asJson()
            ->post(
                'run/f82fcc21-baa6-403c-8717-8771033bed23?stream=false',
                $payload
            );

        Log::info("RESULTAADO DO ENVIO");
        Log::info($response->json());
    }
}
