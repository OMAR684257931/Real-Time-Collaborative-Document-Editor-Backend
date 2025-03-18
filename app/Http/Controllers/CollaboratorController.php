<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Http\Requests\RemoveCollaboratorRequest;
use App\Services\CollaboratorService;
use Illuminate\Http\Request;

class CollaboratorController extends Controller
{
    protected $collaboratorService;

    public function __construct(CollaboratorService $collaboratorService)
    {
        $this->collaboratorService = $collaboratorService;
    }

    public function add($document)
    {
        return response()->json($this->collaboratorService->addCollaborator($document));
    }

    public function remove(RemoveCollaboratorRequest $request,$document)
    {
        return response()->json($this->collaboratorService->removeCollaborator($document));
    }

    public function active($document)
    {
        return response()->json($this->collaboratorService->getActiveCollaborators($document));
    }
}
