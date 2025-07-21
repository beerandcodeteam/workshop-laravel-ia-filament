<?php

namespace App\Jobs;

use App\Models\Script;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

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

        $payload = [
            'tweaks' => [
                'File-wzyW1' => [
                    'path' => [
                        $langflow_file_path,
                    ],
                ],
                "DataFrameOperations-6dXM2" => [
                    "new_column_value" => (string)$this->script->id,
                ]
            ],
        ];

        $response = Http::langFlow()
            ->timeout(0)
            ->asJson()
            ->post(
                'run/d53a5330-8c52-4157-a0b9-989ad2bccd2e?stream=false',
                $payload
            );

        throw_if(!$response->successful(), "Erro ao processar arquivo");
    }
}
