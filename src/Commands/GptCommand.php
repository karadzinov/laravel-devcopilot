<?php
namespace Martink\DevCopilot\Commands;

use Illuminate\Console\Command;
use GuzzleHttp\Client;

class GptCommand extends Command
{
    protected $signature = 'gpt:ask {prompt* : The question or request to ask ChatGPT} {--file= : Optional file path to include in the prompt}';
    protected $description = 'Ask ChatGPT a question from within your Laravel project.';

    public function handle()
    {
        $prompt = implode(' ', $this->argument('prompt'));
        $filePath = base_path($this->option('file'));

        if ($this->option('file') && file_exists($filePath)) {
            $fileContents = file_get_contents($filePath);
            $prompt .= "\n\nHere is the content of the file '{$this->option('file')}':\n" . $fileContents;
        }

        $this->info('Asking ChatGPT: ' . $prompt);

        $client = new Client();
        $response = $client->post('https://api.openai.com/v1/chat/completions', [
            'headers' => [
                'Authorization' => 'Bearer ' . config('devcopilot.api_key'),
                'Content-Type' => 'application/json',
            ],
            'json' => [
                'model' => 'gpt-4',
                'messages' => [
                    ['role' => 'system', 'content' => 'You are a helpful Laravel assistant.'],
                    ['role' => 'user', 'content' => $prompt],
                ],
                'temperature' => 0.7,
            ],
        ]);

        $data = json_decode($response->getBody(), true);
        $answer = $data['choices'][0]['message']['content'] ?? 'No response received.';

        $this->line("\n" . trim($answer));
    }
}
