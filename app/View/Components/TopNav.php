<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Support\Facades\DB;

class TopNav extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct() {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $userId = session()->get('userId');
        $userId = $userId ?? -1;
        $userinfoTable = DB::table('userinfo')
            ->where('USERID', '=', $userId)
            ->select(['Name'])
            ->first();
        $empName = $userinfoTable->Name ?? '';
        return view('components.top-nav', ['empName' => $empName]);
    }
}
