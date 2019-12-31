<?php

namespace App\Modules\Shop\Commands;

use App\Modules\Shop\Models\Product;
use Illuminate\Console\Command;

class ListProducts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'shop:product:list';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'View all products from shop';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $headers = ['ID', 'Name', 'slug', 'Date Added', 'Date Modified'];
        $products = Product::all(['id', 'name', 'slug', 'date_added', 'date_modified'])->toArray();
        $this->table($headers, $products);
    }
}
