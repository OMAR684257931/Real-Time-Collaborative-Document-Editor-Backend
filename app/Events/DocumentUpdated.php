<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;
use App\Models\Document;

class DocumentUpdated implements ShouldBroadcast
{
    use InteractsWithSockets, SerializesModels;

    public $document;

    public function __construct(Document $document)
    {
        $this->document = $document;
    }

    public function broadcastOn()
    {
        return new PrivateChannel('document.' . $this->document->id);
    }

    public function broadcastWith()
    {
        return [
            'id' => $this->document->id,
            'content' => $this->document->content,
        ];
    }
}
