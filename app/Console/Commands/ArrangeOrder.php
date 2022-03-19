<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Student;
use App\Models\User;
use App\Events\SendMail;

class ArrangeOrder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ArrangeOrder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to arrange students order by school';

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
     * @return int
     */
    public function handle()
    {
        $records = Student::pluck('school_id')->unique()->toArray();
        $ids     = array_values($records);
        foreach ($ids as $id) {
            $count   = 1;
            $records = Student::where('school_id', $id)->select('id', 'order')->get();
            foreach ($records as $key => $record) {
                $record->update(['order' => $count]);
                $count++;
            }
        }
        $admin = User::find(1);
        event(new SendMail($admin->id));
        return $this->info('Action Done Successfully');
    }
}
