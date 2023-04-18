<div class="wrapper">
    <div id="body" class="active">
        <div class="content">
            <div class="container">
                <div class="page-title">
                    <h2 class="p-3 shadow text-info bg-light">Test Case Management</h2>
                </div>
                @if (session()->has('message'))
                <div class="alert alert-success"  >
                    {{ session('message') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                </div>
                @endif
                <div class="box box-primary">
                    <div class="box-body">
                        <div class="text-info" wire:loading>Loading..</div>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade active show" id="general" role="tabpanel"
                                aria-labelledby="general-tab">
                                <form accept-charset="utf-8" class="shadow rounded p-3"
                                    wire:submit.prevent="add_general_settings()" method="post">
                                  

                                    <div class="col-md-8 m-2">
                                        <p class="text-muted">Add a new test case</p>

                                        <div class="form-group">
                                            <label for="site-title" class="form-control-label">Test Title</label>
                                            <input type="text" wire:model.lazy="title" name="site_title"
                                                class="form-control" placeholder="Test title">
                                            @error('title') <span
                                                    class="text-red-500 text-danger text-xs">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="description" class="form-control-label">Test Description</label>
                                            <textarea rows="6" class="form-control" placeholder="Description"
                                                wire:model.lazy="description" name="description"></textarea>
                                            @error('description') <span
                                                    class="text-red-500 text-danger text-xs">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="steps" class="form-control-label">Test Steps</label>
                                            <textarea  rows="10"class="form-control" placeholder="Test Steps"
                                                wire:model.lazy="steps" name="steps"></textarea>
                                            @error('steps') <span
                                                    class="text-red-500 text-danger text-xs">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="actual_result" class="form-control-label">Actual Result</label>
                                            <textarea rows="3" class="form-control" placeholder="Actual Result"
                                                wire:model.lazy="actual_result" name="actual_result"></textarea>
                                            @error('actual_result') <span
                                                    class="text-red-500 text-danger text-xs">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="expected_result" class="form-control-label">Expected Result</label>
                                            <textarea rows="3" class="form-control" placeholder="Expected Result"
                                                wire:model.lazy="expected_result" name="expected_result"></textarea>
                                            @error('expected_result') <span
                                                    class="text-red-500 text-danger text-xs">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        {{-- <div class="form-group" x-data="{ isUploading: false, progress: 0 }"
                                            x-on:livewire-upload-start="isUploading = true"
                                            x-on:livewire-upload-finish="isUploading = false"
                                            x-on:livewire-upload-error="isUploading = false"
                                            x-on:livewire-upload-progress="progress = $event.detail.progress">
                                            <label class="form-control-label">Site Logo</label>
                                            <div class="custom-file">
                                                <input type="file" wire:model.lazy="logo" name="site_logo"
                                                    class="custom-file-input">
                                                <label class="custom-file-label">Choose File</label>
                                            </div>
                                            @error('logo') <span
                                                    class="text-red-500 text-danger text-xs">{{ $message }}</span>
                                            @enderror
                                            <br>
                                            <div wire:loading wire:target="logo">{{ __('Uploading...') }}</div><br>
                                            <br>
                                            <div x-show="isUploading" style="width: 100%">
                                                <progress class="my-1 progress-bar" role="progressbar" max="100"
                                                    x-bind:value="progress"></progress>
                                            </div>
                                            @if ($logo)
                                                {{ __('Preview: ') }}<br>
                                                <img width="20%" height="20%" src="{{ $logo->temporaryUrl() }}">
                                            @endif

                                            @if ($c_logo)
                                                {{ __('Current Logo Preview: ') }}<br>
                                                <img width="20%" height="20%"
                                                    src="{{ env('APP_URL') . 'storage/' . $c_logo }}">
                                            @endif
                                        </div>
                                        <div class="form-group" x-data="{ isUploading: false, progress: 0 }"
                                            x-on:livewire-upload-start="isUploading = true"
                                            x-on:livewire-upload-finish="isUploading = false"
                                            x-on:livewire-upload-error="isUploading = false"
                                            x-on:livewire-upload-progress="progress = $event.detail.progress">
                                            <label class="form-control-label">Favicon</label>
                                            <div class="custom-file">
                                                <input type="file" name="site_favicon" wire:model.lazy="favicon"
                                                    class="custom-file-input">
                                                <label class="custom-file-label">Choose File</label>
                                            </div>
                                            @error('favicon') <span
                                                    class="text-red-500 text-danger text-xs">{{ $message }}</span>
                                            @enderror
                                            <br>
                                            <div wire:loading wire:target="favicon">{{ __('Uploading...') }}</div>
                                            <br>
                                            <div x-show="isUploading" style="width: 100%">
                                                <progress class="my-1 progress-bar" role="progressbar" max="100"
                                                    x-bind:value="progress"></progress>
                                            </div>
                                            @if ($favicon)
                                                {{ __('Preview: ') }}<br>
                                                <img width="20%" height="20%" src="{{ $favicon->temporaryUrl() }}">
                                            @endif
                                            @if ($c_favicon)
                                                {{ __('Current Favicon Preview: ') }}<br>
                                                <img width="20%" height="20%"
                                                    src="{{ env('APP_URL') . 'storage/' . $c_favicon }}">
                                            @endif
                                        </div>

                                        <div class="form-group" x-data="{ isUploading: false, progress: 0 }"
                                            x-on:livewire-upload-start="isUploading = true"
                                            x-on:livewire-upload-finish="isUploading = false"
                                            x-on:livewire-upload-error="isUploading = false"
                                            x-on:livewire-upload-progress="progress = $event.detail.progress">
                                            <label class="form-control-label">Icon Logo</label>
                                            <div class="custom-file">
                                                <input type="file" wire:model.lazy="icon_logo" name="icon_logo"
                                                    class="custom-file-input">
                                                <label class="custom-file-label">Choose File</label>
                                            </div>
                                            @error('icon_logo') <span
                                                    class="text-red-500 text-danger text-xs">{{ $message }}</span>
                                            @enderror
                                            <br>
                                            <div wire:loading wire:target="icon_logo">{{ __('Uploading...') }}</div>
                                            <br>
                                            <br>
                                            <div x-show="isUploading" style="width: 100%">
                                                <progress class="my-1 progress-bar" role="progressbar" max="100"
                                                    x-bind:value="progress"></progress>
                                            </div>
                                            @if ($icon_logo)
                                                {{ __('Preview: ') }}<br>
                                                <img width="20%" height="20%" src="{{ $icon_logo->temporaryUrl() }}">
                                            @endif

                                            @if ($c_icon_logo)
                                                {{ __('Current Logo Preview: ') }}<br>
                                                <img width="20%" height="20%"
                                                    src="{{ env('APP_URL') . 'storage/' . $c_icon_logo }}">
                                            @endif
                                        </div>

                                        <div class="form-group">
                                            <label for="email" class="form-control-label">Business Email</label>
                                            <input type="text" placeholder="example@test.com"
                                                wire:model.lazy="business_email" name="email" class="form-control"">
                                            @error('business_email') <span class=" text-red-500 text-danger
                                                text-xs">{{ $message }}</span> @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="business_phone" class="form-control-label">Business
                                                Phone</label>
                                            <input type="text" placeholder="+92..........."
                                                wire:model.lazy="business_phone" name="business_phone"
                                                class="form-control">
                                            @error('business_phone') <span
                                                    class="text-red-500 text-danger text-xs">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="address" class="form-control-label">Business Address</label>
                                            <input type="text" placeholder="Address" wire:model.lazy="address"
                                                name="address" class="form-control">
                                            @error('address') <span
                                                    class="text-red-500 text-danger text-xs">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="working_horse" class="form-control-label">Working Horse</label>
                                            <input type="text" placeholder="Working Horse"
                                                wire:model.lazy="working_horse" name="working_horse"
                                                class="form-control">
                                            <small class="text-small text-info">i.e: 7:00am - 8:00pm</small>
                                            @error('working_horse') <span
                                                    class="text-red-500 text-danger text-xs">{{ $message }}</span>
                                            @enderror
                                        </div> --}}
                                        <div class="form-group text-right">
                                            <button class="btn btn-success" type="submit"><i class="fas fa-check"></i>
                                                {{ $btn_text }}</button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                        </div>
                      
                        <div class="text-capitalize bg-dark p-2 shadow mb-3 text-center text-lg text-light rounded" >{{ _("All Test Cases") }}</div>
                    <table width="100%" class="table table-hover" id="">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Steps</th>
                                <th>Actual Result</th>
                                <th>Expected Result</th>
                                <th>Preview</th>

                                @if(Auth::user()->role == "super admin")
                                <th>Actions</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($test_cases as $testcase)
                                <tr>
                                    <td>{{ $testcase->id }}</td>
                                    <td>{{ $testcase->title }}</td>
                                    <td>{{ $testcase->description }}</td>
                                    <td>{{ $testcase->steps }}</td>
                                    <td>{{ $testcase->actual_result }}</td>
                                    <td>{{ $testcase->expected_result }}</td>
                                    <td class="text-left">
                                        <button wire:click="show_preview({{ $testcase->id }})" class="btn btn-outline-info btn-rounded"><i class="fas fa-eye"></i></button>
                                    </td>
                                    @if(Auth::user()->role == "super admin")
                                    <td class="text-left">
                                        <button wire:click="edit({{ $testcase->id }})" class="btn btn-outline-info btn-rounded"><i class="fas fa-pen"></i></button>
                                        <button wire:click="delete({{ $testcase->id }})" onclick="return confirm('{{ __('Are You Sure ?')  }}')" class="btn btn-outline-danger btn-rounded"><i class="fas fa-trash"></i></button>
                                    </td>
                                    @endif
                                </tr>
                            @empty
                            <td class="text-warning">{{ __('Null') }}</td>
                            <td class="text-warning">{{ __('Null') }}</td>
                            <td class="text-warning">{{ __('Null') }}</td>
                            <td class="text-warning">{{ __('Null') }}</td>
                            <td class="text-warning">{{ __('Null') }}</td>
                            <td class="text-warning">{{ __('Null') }}</td>
                            <td class="text-warning">{{ __('Null') }}</td>
                            <td class="text-warning">{{ __('Null') }}</td>
                        </tr>
                            @endforelse
                                                </tbody>
                    </table>
                    {{ $test_cases->links() }}
                    </div>
                </div>
