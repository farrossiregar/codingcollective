@section('title', __('Accident Report'))
@section('parentPageTitle', 'Home')
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="tab-content">      
                <div class="header row">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-plus"></i> Input Accident Report</h5>
                </div>

                <div class="body pt-0">
                    <div class="form-group">
                        <form wire:submit.prevent="save">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-12 form-group">
                                            <label>Site ID</label>
                                            <input type="text" class="form-control" wire:model="site_id"/>
                                            @error('site_id')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>
                                        <div class="col-md-12 form-group">
                                            <label>Employee ID</label>
                                            <select onclick="" class="form-control" wire:model="employee_id">
                                                <option value=""> --- Field Team --- </option>
                                                <!-- foreach(check_access_data('po-tracking-nonms.field-team-list') as $user) -->
                                                @foreach(\App\Models\Employee::orderBy('id', 'asc')->get() as $user)
                                                <option value="{{$user->id}}">{{$user->name}}</option>
                                                @endforeach
                                            </select>
                                            @error('employee_id')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>
                                        <div class="col-md-12 form-group">
                                            <label>Tanggal Kejadian</label>
                                            <input type="date" class="form-control" wire:model="date"/>
                                            @error('date')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>
                                        <div class="col-md-12 form-group">
                                            <label>Klasifikasi Insiden</label>
                                            <select class="form-control" wire:model="klasifikasi_insiden">
                                                <option value=""> -- Klasifikasi Insiden --</option>
                                                <option value="Cedera / Injury">Cedera / Injury</option>
                                                <option value="Kerusakan Property">Kerusakan Property</option>
                                                <option value="Lingkungan">Lingkungan</option>
                                                <option value="Near Miss">Near Miss</option>
                                            </select>
                                            @error('klasifikasi_insiden')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>
                                        <div class="col-md-12 form-group" x-data="">
                                            <label>Jenis Insiden</label>
                                            <select class="form-control" wire:model="jenis_insiden" >
                                                <option value=""> -- Jenis Insiden --</option>
                                                <option value="Menabrak / Ditabrak sesuatu">Menabrak / Ditabrak sesuatu</option>
                                                <option value="Jatuh / Kejatuhan">Jatuh / Kejatuhan</option>
                                                <option value="Jatuh pada permukaan yang sama (terpeleset, terguling)">Jatuh pada permukaan yang sama (terpeleset, terguling)</option>
                                                <option value="Kontak dengan permukaan kerja (benda kasar/tajam, tersayat)">Kontak dengan permukaan kerja (benda kasar/tajam, tersayat)</option>
                                                <option value="Terjepit didalam, terkait pada, terjepit diantara, atau tergencet">Terjepit didalam, terkait pada, terjepit diantara, atau tergencet</option>
                                                <option value="Terkena suhu yang ekstrim (Heatstroke, Frostbite, Luka bakar, dll)">Terkena suhu yang ekstrim (Heatstroke, Frostbite, Luka bakar, dll)</option>
                                                <option value="Kontak dengan listrik/ radiasi/ bahankimia/ racun/ kebisingan">Kontak dengan listrik/ radiasi/ bahankimia/ racun/ kebisingan</option>
                                                <option value="Masuknya benda asing ke tubuh/mata/kulit (debu,logam)">Masuknya benda asing ke tubuh/mata/kulit (debu,logam)</option>
                                                <option value="Terpapar tekanan berlebih (stress)/ gerakan berlebih">Terpapar tekanan berlebih (stress)/ gerakan berlebih</option>
                                                <option value="Terjepit didalam, terkait pada, terjepit diantara, atau tergencet">Terjepit didalam, terkait pada, terjepit diantara, atau tergencet</option>
                                                <option value="Gerakan berulang-ulang (ergonomi)">Gerakan berulang-ulang (ergonomi)</option>
                                                <option value="Disengat oleh / digigit oleh sesuatu">Disengat oleh / digigit oleh sesuatu</option>
                                                <option value="Faktor biologis (Bakteri, Virus, Mikroba, Jamur)">Faktor biologis (Bakteri, Virus, Mikroba, Jamur)</option>
                                                <option value="Jenis Insiden lain yang tidak disebutkan diatas:  *Free Text*">Jenis Insiden lain yang tidak disebutkan diatas:  *Free Text*</option>
                                            </select>
                                            <div x-show="$wire.show_jenis_insiden2" class="mt-2">
                                                <input type="text" class="form-control" placeholder="Jenis Insiden lain yang tidak disebutkan diatas:  *Free Text*" wire:model="jenis_insiden2">
                                            </div>
                                        </div>
                                            @error('jenis_insiden')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        <div id="div_rincian" class="col-md-12 form-group">
                                            <label>Rincian Kejadian</label>
                                            <textarea class="form-control" id="rincian" wire:model="rincian"></textarea>
                                            @error('rincian')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>
                                        <div class="col-md-12 form-group">
                                            <label>Nik dan Nama</label>
                                            <input type="text" class="form-control" wire:model="nikdannama" >
                                            @error('nikdannama')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-12 form-group">
                                            <!-- <label>Insiden Photo</label> -->
                                            <div class="row">
                                                <?php
                                                    for($i=1; $i<=8; $i++){

                                                ?>
                                                <div class="col-md-6 form-group">
                                                    <label>Foto insiden <?php echo $i; ?></label>
                                                    <input type="file" class="form-control" name="photo<?php echo $i; ?>" wire:model="photo<?php echo $i; ?>" />
                                                    @error('photo'.$i)
                                                    <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                                    @enderror
                                                </div>
                                                <?php
                                                    }
                                                ?>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 form-group">
                                    <hr />
                                    <a href="{{route('accident-report.index')}}" class="mr-2"><i class="fa fa-arrow-left"></i> {{ __('Back') }}</a>
                                    <button type="submit" class="btn btn-info close-modal"><i class="fa fa-edit"></i> Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>