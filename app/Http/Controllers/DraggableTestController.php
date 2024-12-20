<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Member;
use App\Models\Group;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DraggableTestController extends Controller
{
    public function index() {
        return Inertia::render('DraggableTest/Index');
    }

    public function index2() {
        return Inertia::render('DraggableTest/Index2');
    }

    public function dropzone1() {
        return Inertia::render('DraggableTest/DropZone1');
    }

    public function multi1() {
        return Inertia::render('DraggableTest/Multi1');
    }

    public function multi2() {
        return Inertia::render('DraggableTest/Multi2');
    }

    public function sortablejs1() {
        return Inertia::render('DraggableTest/Sortablejs1');
    }

    public function mix1() {
        $members = Member::where('user_id', '=', Auth::id())->orderBy('id')->get();
        $groups = Group::where('user_id', '=', Auth::id())->orderBy('id')->get();

        // dd($members);

        return Inertia::render('DraggableTest/Mix1', [
            'members' => $members,
            'groups' => $groups,
        ]);
    }

    public function draggable1() {
        $members = Member::where('user_id', '=', Auth::id())->orderBy('id')->get();
        $groups = Group::where('user_id', '=', Auth::id())->orderBy('id')->get();

        // dd($members);

        return Inertia::render('DraggableTest/Draggable1');
    }

    public function sortable1() {
        $members = Member::where('user_id', '=', Auth::id())->orderBy('id')->get();
        $groups = Group::where('user_id', '=', Auth::id())->orderBy('id')->get();

        // dd($members);

        return Inertia::render('DraggableTest/Sortable1', [
            'members' => $members,
            'groups' => $groups,
        ]);
    }
}
