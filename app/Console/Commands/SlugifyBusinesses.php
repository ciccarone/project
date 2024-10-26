<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Business;
use Cviebrock\EloquentSluggable\Services\SlugService;

class SlugifyBusinesses extends Command
{
    protected $signature = 'slugify:businesses';
    protected $description = 'Generate slugs for existing businesses';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $businesses = Business::all();

        foreach ($businesses as $business) {
            $slug = SlugService::createSlug(Business::class, 'slug', $business->name);
            $business->slug = $slug;
            $business->save();
            $this->info("Slug generated for business: {$business->name} -> {$slug}");
        }

        $this->info('Slugs generated for all businesses.');
    }
}
