@section('title', $data->name)
@section('parentPageTitle', 'Employee')
<div class="row clearfix">
    <div class="col-md-12">
        <div class="card">
            <ul class="nav nav-tabs-new2">
                <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#general">{{ __('General Info') }}</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#android">{{ __('Android') }}</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane" id="android">
                    @livewire('employee.android',['data'=>$data->id])
                </div>
                <div class="tab-pane show active" id="general">
                    <div class="body">
                        <div class="row">
                            <div class="col-md-4">
                                <h6>Foto</h6>
                                <div class="media photo">
                                    <div class="media-left m-r-15">
                                        @if(!empty($foto))
                                        <img src="{{ $foto->temporaryUrl() }}" class="user-photo media-object" alt="Pasphoto" style="width:100%;">
                                        @else 
                                            @if(!empty($data->foto))
                                                <img src="{{ asset('storage/foto/'.$data->user_id.'/'.$data->foto) }}" class="user-photo media-object" alt="Pasphoto" style="width:100%;">
                                            @endif
                                        @endif
                                    </div>
                                    <div class="media-body">
                                        <p>Upload your Foto</p>
                                        <button type="button" class="btn btn-default-dark" id="btn-upload-photo"><i class="fa fa-upload"></i> Upload Photo</button>
                                        <input type="file" id="filePhoto" class="sr-only" wire:model="foto">
                                        @error('pas_foto')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <h6>Foto KTP</h6>
                                <div class="media photo">
                                    <div class="media-left m-r-15">
                                        @if(!empty($foto_ktp))
                                        <img src="{{ $foto_ktp->temporaryUrl() }}" class="user-photo media-object" alt="Foto KTP" style="width:100%;">
                                        @else
                                            @if(!empty($data->foto_ktp))
                                                <img src="{{ asset('storage/foto/'.$data->user_id.'/'.$data->foto_ktp) }}" class="user-photo media-object" alt="Pasphoto" style="width:100%;">
                                            @endif
                                        @endif
                                    </div>
                                    <div class="media-body">
                                        <p>Upload your Foto KTP.</p>
                                        <button type="button" class="btn btn-default-dark" id="btn-upload-foto_ktp"><i class="fa fa-upload"></i> Upload Photo</button>
                                        <input type="file" id="foto_ktp" class="sr-only" wire:model="foto_ktp">
                                        @error('foto_ktp')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <form id="basic-form" method="post" wire:submit.prevent="save">
                            <hr />
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label>Code / Alias</label>
                                            <input type="text" class="form-control" wire:model="employee_code" placeholder="{{ __('Code / Alias') }}" >
                                            @error('employee_code')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Name</label>
                                            <input type="text" class="form-control" wire:model="name" placeholder="{{ __('Name') }}" >
                                            @error('name')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label>NIK</label>
                                            <input type="text" class="form-control"  wire:model="nik" placeholder="{{ __('NIK') }}" >
                                            @error('nik')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>KTP</label>
                                            <input type="text" class="form-control"  wire:model="ktp" placeholder="{{ __('KTP') }}" >
                                            @error('ktp')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label>Email</label>
                                            <input type="email" class="form-control"  wire:model="email" placeholder="{{ __('Email') }}" />
                                            @error('email')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Telepon</label>
                                            <input type="text" class="form-control"  wire:model="telepon" placeholder="{{ __('Telepon') }}" />
                                            @error('telepon')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label>Postcode</label>
                                            <input type="text" class="form-control"  wire:model="postcode" placeholder="{{ __('Postcode') }}" />
                                            @error('postcode')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Address KTP</label>
                                        <textarea class="form-control" wire:model="address" placeholder="{{ __('Address') }}""></textarea>
                                        @error('address')
                                        <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Domisili</label>
                                        <textarea class="form-control" wire:model="domisili" placeholder="{{ __('Domisili') }}""></textarea>
                                        @error('domisili')
                                        <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Department</label>
                                        <select class="form-control" wire:model="department_sub_id">
                                            <option value="">{{__('--- Department --- ')}} </option>
                                            @foreach(\App\Models\Department::orderBy('name','ASC')->get() as $item)
                                            <optgroup label="{{$item->name}}">
                                                @foreach(\App\Models\DepartmentSub::where('department_id',$item->id)->get() as $sub)
                                                <option value="{{$sub->id}}">{{$sub->name}}</option>
                                                @endforeach
                                            </optgroup>
                                            @endforeach
                                        </select>
                                        @error('department_sub_id')
                                        <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <input type="text" class="form-control" placeholder="Place of Birth" wire:model="place_of_birth" >
                                            @error('place_of_birth')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            <input type="date" class="form-control" placeholder="Date of Birth" wire:model="date_of_birth" >
                                            @error('date_of_birth')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <select class="form-control" wire:model="marital_status">
                                                <option value=""> --- Marital Status --- </option>
                                                @foreach(config('vars.marital_status') as $k => $i)
                                                <option value="{{$k}}">{{$i}}</option>
                                                @endforeach
                                            </select>
                                            @error('marital_status')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            <select class="form-control" wire:model="blood_type">
                                                <option value=""> --- Blood Type --- </option>
                                                @foreach(config('vars.blood_type') as $k => $i)
                                                <option>{{$i}}</option>
                                                @endforeach
                                            </select>
                                            @error('blood_type')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <select class="form-control" wire:model="employee_status">
                                                <option value=""> --- Employee Status --- </option>
                                                @foreach(config('vars.employee_status') as $k => $i)
                                                <option value="{{$k}}">{{$i}}</option>
                                                @endforeach
                                            </select>
                                            @error('employee_status')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            <select class="form-control" wire:model="religion">
                                                <option value=""> --- Religion --- </option>
                                                @foreach(config('vars.religion') as $i)
                                                <option>{{$i}}</option>
                                                @endforeach
                                            </select>
                                            @error('religion')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <select class="form-control" wire:model="user_access_id">
                                                <option value="">{{__('--- Position --- ')}} </option>
                                                @foreach(\App\Models\UserAccess::orderBy('name','ASC')->get() as $item)
                                                <option value="{{$item->id}}">{{$item->name}}</option>
                                                @endforeach
                                            </select>
                                            @error('user_access_id')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            <select class="form-control" wire:model="region_id">
                                                <option value="">{{__('--- Region --- ')}} </option>
                                                @foreach(\App\Models\Region::orderBy('region','ASC')->get() as $item)
                                                <option value="{{$item->id}}">{{$item->region}}</option>
                                                @endforeach
                                            </select>
                                            @error('user_access_id')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <input type="password" class="form-control"  wire:model="password" placeholder="Password">
                                            @error('password')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            <input type="password" class="form-control"  wire:model="confirm" placeholder="Confirm">
                                            @error('confirm')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <select class="form-control" wire:model="company_id">
                                                <option value=""> --- Company --- </option>
                                                @foreach(\App\Models\Company::get() as $company)
                                                <option value="{{$company->id}}">{{$company->name}}</option>   
                                                @endforeach
                                            </select>
                                            @error('company_id')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            <select class="form-control" wire:model="lokasi_kantor">
                                                <option value=""> --- Lokasi Kantor --- </option>
                                                <option>Kantor Pusat (Duren Tiga,Jakarta)</option>
                                                <option>Kantor Cabang / Homebase</option>
                                            </select>
                                            @error('company_id')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="fancy-checkbox">
                                            <input type="checkbox" value="1" wire:model="is_use_android">
                                            <span>Active Android</span>
                                        </label>
                                    </div>
                                    <div class="form-group">
                                        <label class="fancy-checkbox">
                                            <input type="checkbox" value="1" wire:model="is_noc">
                                            <span>NOC Database</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <a href="javascript:;" onclick="history.back()"><i class="fa fa-arrow-left"></i> {{ __('Back') }}</a>
                            <button type="submit" class="btn btn-primary ml-3"><i class="fa fa-save"></i> {{ __('Save') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@section('page-script')
$('#btn-upload-photo').on('click', function() {
    $(this).siblings('#filePhoto').trigger('click');
});
$('#btn-upload-foto_ktp').on('click', function() {
    $(this).siblings('#foto_ktp').trigger('click');
});
@endsection