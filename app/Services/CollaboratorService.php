<?php

namespace App\Services;

use App\Models\Document;
use Illuminate\Support\Facades\Auth;

class CollaboratorService
{
    public function addCollaborator($documentId)
    {
        $doc = Document::where('id', $documentId)->firstOrFail();
        $doc->collaborators()->syncWithoutDetaching([Auth::id()]);

        return ['message' => 'Collaborator added'];
    }

    public function removeCollaborator($documentId)
    {
        $document = Document::findOrFail($documentId);
        $document->collaborators()->detach(Auth::id());

        return ['message' => 'Collaborator removed'];
    }

    public function getActiveCollaborators($documentId)
    {
        $document = Document::findOrFail($documentId);
        return $document->collaborators()->pluck('email'); // ✅ Return active users
    }
}
