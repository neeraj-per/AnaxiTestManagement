<?php

namespace App\Http\Livewire\Admins;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class SingleTest extends Component
{
    public function mount($id)
    {
        return view('livewire.admins.single-test');
        // [
        //     'test_case'=> DB::table('test_cases')->where('id', $id)->first()
        // ]);
    }
}
