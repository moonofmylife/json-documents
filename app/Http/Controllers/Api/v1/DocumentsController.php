<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\Document;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateDocumentRequest;
use App\Http\Resources\{ DocumentResource, DocumentCollection };
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class DocumentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return \App\Http\Resources\DocumentCollection
     */
    public function index(Request $request)
    {
        return new DocumentCollection(
            Document::onlyPublished()
                ->latest('updated_at')
                ->paginate($request->get('perPage', 20))
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \App\Http\Resources\DocumentResource
     */
    public function store()
    {
        return new DocumentResource(Document::create());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Document  $document
     * @return \App\Http\Resources\DocumentResource
     */
    public function show(Document $document)
    {
        return new DocumentResource($document);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\UpdateDocumentRequest $request
     * @param \App\Models\Document $document
     * @return \App\Http\Resources\DocumentResource
     */
    public function update(UpdateDocumentRequest $request, Document $document)
    {
        if ($document->isPublished()) {
            return response()->json([
                'error' => 'The document has already been published and cannot be changed',
            ], Response::HTTP_BAD_REQUEST);
        }

        $document->update(
            collect(Arr::dot($request->json('document')))->mapWithKeys(function ($value, $key) {
                return [str_replace('.', '->', $key) => $value];
            })->toArray()
        );

        return new DocumentResource($document);
    }

    /**
     * Publish the document.
     *
     * @param \App\Models\Document $document
     * @return \App\Http\Resources\DocumentResource
     */
    public function publish(Document $document)
    {
        return new DocumentResource($document->publish());
    }
}
