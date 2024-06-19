<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Conversation;
use Illuminate\Support\Facades\File;

class ImportConversations extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:conversations';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import conversations from JSON file';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $filePath = public_path('json/conversationData.json');

        if (!File::exists($filePath)) {
            $this->error('JSON file not found: ' . $filePath);
            return 1;
        }

        $json = File::get($filePath);
        $data = json_decode($json, true);

        foreach ($data as $item) {
            Conversation::create([
                'time' => $item['time'] ?? null,
                'message' => $item['message'] ?? null,
                'response' => $item['response'] ?? null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $this->info('Conversations imported successfully.');

        return 0;
    }
}
