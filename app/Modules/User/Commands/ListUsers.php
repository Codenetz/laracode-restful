<?php

namespace App\Modules\User\Commands;

use Illuminate\Console\Command;
use App\Modules\User\Models\User;

class ListUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:list';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'View all users';

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
        $headers = ['ID', 'Name', 'Email', 'Date Added', 'Date Modified'];
        $users = User::all(['id', 'name', 'email', 'date_added', 'date_modified'])->toArray();
        $this->table($headers, $users);
    }
}
