<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
	public function __invoke(Request $request)
	{
		abort_if($request->user()->cannot("transaction-index"), 403);
		$data["transactions"] = Transaction::latest()->get();
		return view("pages.transaction", compact("data"));
	}
}
