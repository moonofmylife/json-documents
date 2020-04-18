<?php

namespace App\Providers;

use App\Models\Document;
use App\Observers\DocumentsObserver;
use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Resources\Json\{ JsonResource, ResourceCollection };

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        JsonResource::withoutWrapping();
        ResourceCollection::withoutWrapping();

        Document::observe(DocumentsObserver::class);
    }
}
