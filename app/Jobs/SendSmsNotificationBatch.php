<?php

namespace App\Jobs;

use App\Models\Resident;
use BlueSea\Semaphore\Facades\Semaphore;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendSmsNotificationBatch implements ShouldQueue
{
	use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

	public $puroks;
	public $message;

	/**
	 * Create a new job instance.
	 *
	 * @return void
	 */
	public function __construct($puroks, $message)
	{
		$this->puroks = $puroks;
		$this->message = $message;
	}

	/**
	 * Execute the job.
	 *
	 * @return void
	 */
	public function handle()
	{
		$numbers = Resident::whereIn('purok_id', $this->puroks)->pluck('phone_number')->toArray();
		Semaphore::send($numbers, $this->message);
	}
}
