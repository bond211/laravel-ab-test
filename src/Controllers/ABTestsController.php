<?php

namespace Bond211\ABTest\Controllers;

use Bond211\ABTest\Facades\ABTestStats;
use Illuminate\Routing\Controller;

class ABTestsController extends Controller
{
    public function index()
    {
        $stats = ABTestStats::getAllTestsStats();

        return view('ab-tests::index', compact('stats'));
    }
}
