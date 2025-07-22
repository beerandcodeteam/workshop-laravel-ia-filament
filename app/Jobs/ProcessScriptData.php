<?php

namespace App\Jobs;

use App\Models\Script;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProcessScriptData implements ShouldQueue
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
            ->post('files/upload/' . config('langflow.script_processor_id'))
            ->json();

        $langflow_file_path = $result['file_path'];

        Log::info("Arquivo criado: {$langflow_file_path}");

        $payload = [
            'session_id' => $this->script->id . '--' . now(),
            'tweaks' => [
                'File-' . config('langflow.script_processor_file_id') => [
                    'path' => [
                        $langflow_file_path,
                    ],
                ],
                "Prompt Template-" . config('langflow.script_processor_template_id') => [
                    "script_id" => (string)$this->script->id,
                ]
            ],
        ];

        $response = Http::langFlow()
            ->timeout(0)
            ->asJson()
            ->post(
                'run/' . config('langflow.script_processor_id') . '?stream=false',
                $payload
            );
    }
}
