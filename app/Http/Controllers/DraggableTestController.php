<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class DraggableTestController extends Controller
{
    public function index() {
        return Inertia::render('DraggableTest/Index');
    }

    public function index2() {
        return Inertia::render('DraggableTest/Index2');
    }
}
