<?php
namespace App\Services;

use App\Models\Document;
use Illuminate\Support\Facades\Auth;

class DocumentService
{
    public function getAllDocuments()
    {
        return Document::all();
    }

    public function createDocument(array $data)
    {
        return Auth::user()->documents()->create($data);
    }

    public function getDocument($documentId)
    {
        $document = Document::find($documentId);
        if (!$document) {
            return null;
        }

        return [
            'id' => $document->id,
            'title' => $document->title,
            'content' => $document->content,
            'collaborators' => $document->collaborators()->pluck('email'),
        ];
    }

    public function updateDocument($document, array $data)
    {
        $doc=Document::find($document);

            $doc->versions()->create(['content' => $doc->content ?? ""]);


        $doc->update([
            'title' => $data['title'] ?? $doc->title,
            'content' => $data['content'] ?? $doc->content,
        ]);

        return [
            'id' => $doc->id,
            'title' => $doc->title,
            'content' => $doc->content,
            'collaborators' => $doc->collaborators()->pluck('email'),
        ];
    }

    public function getDocumentHistory($document)
    {
        return  Document::find($document)->versions;
    }
}
