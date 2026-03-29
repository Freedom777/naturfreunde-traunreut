<?php

namespace App\Http\Controllers;

use App\Models\TeamMember;
use Illuminate\View\View;

class TeamController extends Controller
{
    public function index(): View
    {
        $groups = TeamMember::active()
            ->orderBy('sort_order')
            ->get()
            ->groupBy('group');

        return view('pages.team', compact('groups'));
    }
}
