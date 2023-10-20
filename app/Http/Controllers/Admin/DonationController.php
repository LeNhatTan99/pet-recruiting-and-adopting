<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Donation;
use Illuminate\Http\Request;

class DonationController extends Controller
{
        /**
    * view index list donation
    * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|View
    */
    public function index(Request $request) {
        $datas = Donation::query();
        $datas->join('users', 'donations.user_id', '=', 'users.id')
            ->select('donations.*','users.username', 'users.first_name', 
                'users.last_name', 'users.email', 'users.phone_number', 
                'users.address')
            ->orderBy('created_at', 'desc');
        $datas = $datas->paginate(15);
        return view('admins.donation.index', compact('datas'));
    }

}
