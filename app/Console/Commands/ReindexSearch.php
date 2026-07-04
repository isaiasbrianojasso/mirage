<?php

namespace App\Console\Commands;

use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('app:reindex-search')]
#[Description('Command description')]
class ReindexSearch extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'search:reindex';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reindexa todo el catálogo de productos para el motor de búsqueda nativo';

    /**
     * Execute the console command.
     */
    public function handle(\App\Services\SearchIndexerService $indexer)
    {
        $this->info('Iniciando reindexación del catálogo...');

        $products = \App\Models\Product::with('variants')->get();
        $bar = $this->output->createProgressBar(count($products));

        foreach ($products as $product) {
            $indexer->indexProduct($product);
            $bar->advance();
        }

        $bar->finish();
        $this->newLine();
        $this->info('¡Reindexación completada con éxito!');
    }
}
