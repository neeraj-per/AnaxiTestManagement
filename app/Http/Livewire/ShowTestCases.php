<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ShowTestCases extends Component
{
    public function render()
    {
        $test_case = DB::table('test_cases')->where('id', $id)->first();
        return view('showtestcases');
    }
}
