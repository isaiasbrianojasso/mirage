<?php

namespace App\Services;

use App\Models\Product;
use App\Models\SearchWord;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SearchIndexerService
{
    /**
     * Define weights for different product fields.
     * These weights mirror the logic found in PrestaShop search indexing.
     */
    protected $weights = [
        'name' => 10,
        'sku' => 10,
        'short_description' => 5,
        'meta_title' => 5,
        'meta_description' => 3,
        'long_description' => 1,
        'specifications' => 1,
    ];

    /**
     * Index a single product.
     */
    public function indexProduct(Product $product)
    {
        $words = [];

        // 1. Extract text and apply weights
        $this->extractWords($product->name, $this->weights['name'], $words);
        $this->extractWords($product->sku, $this->weights['sku'], $words);
        $this->extractWords($product->short_description, $this->weights['short_description'], $words);
        $this->extractWords($product->meta_title, $this->weights['meta_title'], $words);
        $this->extractWords($product->meta_description, $this->weights['meta_description'], $words);
        $this->extractWords($product->long_description, $this->weights['long_description'], $words);
        
        // Extract specifications if it's an array
        if (is_array($product->specifications)) {
            foreach ($product->specifications as $spec) {
                $this->extractWords($spec, $this->weights['specifications'], $words);
            }
        }

        // Extract from variants (give them the same weight as the main product name/sku)
        foreach ($product->variants as $variant) {
            $this->extractWords($variant->name, $this->weights['name'], $words);
            $this->extractWords($variant->sku, $this->weights['sku'], $words);
        }

        // 2. Clear old index for this product
        DB::table('search_index')->where('product_id', $product->id)->delete();

        if (empty($words)) {
            return;
        }

        // 3. Process new words and insert to index
        $inserts = [];
        foreach ($words as $word => $weight) {
            // Find or create the search word
            $searchWord = SearchWord::firstOrCreate(['word' => $word]);
            
            $inserts[] = [
                'product_id' => $product->id,
                'search_word_id' => $searchWord->id,
                'weight' => $weight,
            ];
        }

        // Insert new relations in bulk
        DB::table('search_index')->insert($inserts);
    }

    /**
     * Helper to clean text, split into words, and accumulate weights.
     */
    protected function extractWords($text, $weight, &$wordsArray)
    {
        if (empty($text)) {
            return;
        }

        // Remove HTML tags
        $text = strip_tags($text);
        
        // Lowercase, remove accents (using Str::ascii)
        $text = Str::lower(Str::ascii($text));
        
        // Replace non-alphanumeric characters with spaces
        $text = preg_replace('/[^a-z0-9]/', ' ', $text);
        
        // Split by spaces
        $tokens = explode(' ', $text);

        foreach ($tokens as $token) {
            $token = trim($token);
            // Ignore words that are too short
            if (strlen($token) < 3) {
                continue;
            }

            // Accumulate weight if word appears multiple times or in multiple fields
            if (!isset($wordsArray[$token])) {
                $wordsArray[$token] = 0;
            }
            $wordsArray[$token] += $weight;
        }
    }
}
