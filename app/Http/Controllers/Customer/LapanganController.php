<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Lapangan;
use App\Models\Notification;

class LapanganController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    // auth()->loginUsingId(1);
    // auth()->loginUsingId(5);
    // auth()->logout();
    $lapangans = Lapangan::orderByDesc('created_at')->filter(request('keyword'))->paginate(10);

    $counter = ($lapangans->perPage() * $lapangans->currentPage()) - $lapangans->perPage() + 1;

    $notificationCount = Notification::notificationCount();

    return view('customer.lapangan', [
      'lapangans' => $lapangans,
      'counter' => $counter,
      'notificationCount' => $notificationCount
    ]);
  }
}
