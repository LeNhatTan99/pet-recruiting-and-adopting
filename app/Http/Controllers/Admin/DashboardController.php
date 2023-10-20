<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Animal;
use App\Models\Donation;
use App\Models\News;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
        /**
    * view dashboard
    * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|View
    */
    public function index(Request $request) {
        $donateAmount = Donation::sum('amount');
        $userCount = User::get()->count();
        $animalCount = Animal::get()->count();
        $newsCount = News::get()->count();
        return view('admins.dashboard', compact('donateAmount', 'userCount', 'animalCount', 'newsCount'));
    }

}
