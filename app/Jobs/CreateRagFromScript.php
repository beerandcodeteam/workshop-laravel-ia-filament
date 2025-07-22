<?php

namespace App\Jobs;

use App\Models\Script;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CreateRagFromScript implements ShouldQueue
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
            'session_id' => $this->script->id . '--' . now(),
            'tweaks' => [
                'File-' . config('langflow.rag_file_id') => [
                    'path' => [
                        $langflow_file_path,
                    ],
                ],
                "DataFrameOperations-" . config('langflow.rag_data_frame_id') => [
                    "new_column_value" => (string) $this->script->id,
                ],
            ],
        ];

        $response = Http::langFlow()
            ->timeout(0)
            ->asJson()
            ->post(
                'run/' . config('langflow.rag_flow_id') . '?stream=false',
                $payload
            );
    }
}
