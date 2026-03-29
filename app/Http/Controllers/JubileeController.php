<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\View\View;

class JubileeController extends Controller
{
    public function index(): View
    {
        $jubilees = Member::active()
            ->jubilees()
            ->orderBy('year_joined')
            ->get()
            ->groupBy('years') // группируем по кол-ву лет
            ->sortKeysDesc();  // от большего к меньшему

        return view('pages.jubilee', compact('jubilees'));
    }
}
