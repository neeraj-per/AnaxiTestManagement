<?php

namespace App\Http\Livewire\Admins;

use App\Models\test_cases;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Settings extends Component
{

    use WithFileUploads;
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $title;
    public $description;
    public $btn_text="Save";
    public $steps;
    public $actual_result;
    public $expected_result;
    public $edit_test_case_id;

    public function add_general_settings()
    {
            $this->validate([
                'title' => 'required',
                'description' => 'required',
                'steps' => 'required',
                'actual_result' => 'required',
                'expected_result' => 'required',
                ]);
                // if (!$this->c_favicon) {
                //     $this->validate([
                //         'favicon' => 'required|image'
                //     ]);
                //   $favicon = $this->storeImage($this->favicon);

                // }
                // if (!$this->c_icon_logo) {
                //     $this->validate([
                //         'icon_logo' => 'required|image'
                //     ]);
                //   $icon_logo = $this->storeImage($this->icon_logo);

                // }
                // if (!$this->c_logo) {
                //     $this->validate([
                //         'logo' => 'required|image'
                //     ]);
                //   $logo = $this->storeImage($this->logo);
                // }

            test_cases::create([
                'title'          => $this->title,
                'description' => $this->description,
                'steps'   =>  $this->steps,
                'actual_result'        => $this->actual_result,
                'expected_result' => $this->expected_result,
            ]);

            $this->title="";
            $this->description="";
            $this->steps="";
            $this->actual_result="";
            $this->expected_result="";
           
            session()->flash('message', 'Test case added successfully.');

    }

    public function storeImage($image)
    {
        if (!$image) {
            return null;
        }
        $imag   = ImageManagerStatic::make($image)->encode('png');
        $name  = Str::random() . '.png';
        Storage::disk('public')->put($name, $imag);
        return $name;
    }


     public function edit($id)
    {
        $test_case = DB::table('test_cases')->where('id', $id)->first();
        $this->edit_test_case_id = $id;

        $this->title = $test_case->title;
        $this->description = $test_case->description;
        $this->steps = $test_case->steps;
        $this->actual_result = $test_case->actual_result;
        $this->expected_result = $test_case->expected_result;
        $this->btn_text="Update Test";

    }

    public function update($id)
    {
        $this->validate([
                'title' => 'required||min:6|max:50',
                'business_email' => 'required|business_email',
                'favicon' => 'required|min:6',
                'address' => 'required',
                'business_phone' => 'required',
                'address' => 'required',
                'description' => 'required',
                'working_horse' => 'required',
            ]);

        $setting = general_settings::findOrFail($id);
        $setting->title = $this->title;
        $setting->business_email = $this->business_email;
        $setting->favicon = bcrypt($this->favicon);
        $setting->address = $this->address;
        $setting->business_phone = $this->business_phone;
        $setting->address = $this->address;
        $setting->working_horse = $this->working_horse;
        $setting->description = $this->description;

        if ($this->logo) {
            $this->validate([
                'logo' => 'required|image|max:3072',
            ]);
            Storage::disk('public')->delete($setting->logo_path);
            // $setting->logo_path = $this->storeImage();

        }

        $setting->save();

        $this->title="";
        $this->business_email="";
        $this->favicon="";
        $this->favicon="";
        $this->address="";
        $this->business_phone="";
        $this->address="";
        $this->description="";
        $this->address="";
        $this->working_horse="";
        $this->logo="";
        $this->edit_logo="";

        session()->flash('message', 'setting Updated Successfully.');


}

public function delete($id)
{
    $test_case = DB::table('test_cases')->delete($id);
    session()->flash('message', 'Test Case Deleted Successfully.');
}


    public function render()
    {
        return view('livewire.admins.settings',[
            'test_cases'=>DB::table('test_cases')->latest()->paginate(10),
        ])->layout('admins.layouts.app');
    }

    public function show_preview($id) 
    {
        return redirect()->to('/test_case/{$id}');

    }
}
