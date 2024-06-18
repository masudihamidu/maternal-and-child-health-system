<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Conversation;
use Illuminate\Support\Facades\Storage;

class ImportConversations extends Command
{
    protected $signature = 'import:conversations';

    protected $description = 'Import conversations from JSON file';

    public function handle()
    {
        $filePath = public_path('json/conversationData.json');

        if (!file_exists($filePath)) {
            $this->error('JSON file not found: ' . $filePath);
            return 1;
        }

        $json = file_get_contents($filePath);
        $data = json_decode($json, true);

        foreach ($data as $item) {
            Conversation::create([
                'contact' => $item['contact'],
                'channel' => $item['channel'],
                'date' => now()->parse($item['date']),
            ]);
        }

        $this->info('Conversations imported successfully.');

        return 0;
    }
}
