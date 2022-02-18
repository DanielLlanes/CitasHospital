<?php

namespace App\Jobs\Staff\Debate;

use App\Models\Staff\Debate;
use App\Models\Staff\Staff;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class DebateMessagesJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $membersData;
    public $debate_id;
    public $sender_id;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($membersData, $debate_id, $sender_id)
    {
        $this->membersData = $membersData;
        $this->debate_id = $debate_id;
        $this->sender_id = $sender_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $debate = Debate::find($this->debate_id);
        foreach ($this->membersData  as $k => $member) {
            $user = Staff::find($member->member_id);
            if ($user->hasAnyRole(['super-administrator', 'administrator']) || $member->member_id == $this->sender_id ) {}
            else{
                $debate->message()->create(["code" => time().uniqid(Str::random(30)), 'staff_id' => $member->member_id, 'type' => "debate"]);
            }    
        }
    }
}
