<?php
namespace App\Http\Controllers;

use App\Http\Requests\StoreDocumentRequest;
use App\Http\Requests\UpdateDocumentRequest;
use App\Models\Document;
use App\Services\DocumentService;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    protected $documentService;

    public function __construct(DocumentService $documentService)
    {
        $this->documentService = $documentService;
    }

    public function index()
    {
        return response()->json($this->documentService->getAllDocuments());
    }

    public function store(StoreDocumentRequest $request)
    {
        return response()->json($this->documentService->createDocument($request->validated()));
    }

    public function get($documentId)
    {
        $document = $this->documentService->getDocument($documentId);
        if (!$document) {
            return response()->json(['error' => 'Document not found'], 404);
        }
        return response()->json($document);
    }

    public function update(UpdateDocumentRequest $request, $document)
    {
        return response()->json($this->documentService->updateDocument($document, $request->validated()));
    }

    public function history($document)
    {
        return response()->json($this->documentService->getDocumentHistory($document));
    }
}
