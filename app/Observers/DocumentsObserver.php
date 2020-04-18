<?php

namespace App\Observers;

use App\Models\Document;

class DocumentsObserver
{
    /**
     * Handle the document "updated" event.
     *
     * @param  \App\Models\Document  $document
     * @return void
     */
    public function updating(Document $document)
    {
        $payload = json_decode(json_encode($document->payload), true);

        $document->setAttribute('payload', array_filter_recursive($payload, function ($value) {
            return $value !== null;
        }));
    }
}
