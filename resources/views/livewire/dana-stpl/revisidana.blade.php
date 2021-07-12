<form wire:submit.prevent="save">
    @csrf
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-edit"></i> Revisi Dana STPL</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true close-btn">×</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="form-group">
            <div class="row">
                <div class="col-md-12">
                    <label>Project</label>
                    <select wire:click="$emit('getprojectedit')" class="form-control" name="projectedit" id="projectedit" >
                        <option value=""> -- Project --</option>
                        <?php
                            $data = \App\Models\Project::select('projects.*', 'region_code as region_name', 'employees.name as sm_name', 'employees.id as smid')
                                    ->join('epl.region as region', 'region.id', 'projects.region_id')
                                    ->leftjoin('pmt.employees as employees', 'employees.id', 'projects.project_manager_id')
                                    ->get();
                        ?>
                        @foreach($data as $item)
                        <option  value="<?php echo $item->id.' | '.$item->sm_name.' | '.$item->smid.' | '.$item->region_name; ?> ">{{ $item->name }} - {{ $item->region_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-12">
                    <input type="hidden" class="form-control projectcodeedit" name="projectcodeedit" wire:model="projectcodeedit" />
                </div>
                <div class="col-md-12">
                    <input type="text" class="form-control" name="currentproject" id="currentproject" wire:model="project_name" readonly/>
                </div>
                <div class="col-md-12">
                    <label>Region</label>
                    <input type="text" class="form-control" name="regionedit" id="regionedit" wire:model="region_code" readonly/>
                </div>
                <div class="col-md-12">
                    <label>Project Manager</label>
                    <input type="text" class="form-control" name="smedit" id="smedit" wire:model="sm" readonly/>
                </div>
                <div class="col-md-12">
                    <label>Project Name</label>
                    <select onclick="" class="form-control" name="project_name_edit" id="project_name_edit" wire:model="project_id">
                        <option value=""> -- Project Name --</option>
                        <option  value="1">CMI</option>
                        <option  value="2">H3I</option>
                        <option  value="3">ISAT</option>
                        <option  value="4">STP</option>
                        <option  value="5">XL</option>
                        
                    </select>
                </div>
                <div class="col-md-12">
                    <label>Value</label>
                    <input type="text" class="form-control" name="danastpledit" wire:model="danastpl" />
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-info close-modal"><i class="fa fa-edit"></i> Submit</button>
    </div>
    <!-- <div wire:loading>
        <div class="page-loader-wrapper" style="display:block">
            <div class="loader" style="display:block">
                <div class="lds-ring"><div></div><div></div><div></div><div></div></div>
                <p>Please wait...</p>
            </div>
        </div>
    </div> -->
</form>


@section('page-script')

   
@endsection

<script>
    // Livewire.on('modalinputpono',(data)=>{
    //     $("modal-datastpl-inputdana").modal('show');
    // });
    // function sm_id(){
    //     var project = $('#project').val();
    //     project = project.split(" | ");
    //     // $('#project_code').val(project[0]);
    //     // $('#project_code').attr("placeholder", project[0]);
    //     $('#sm').val(project[1]);
    //     // $('#smid').val(project[2]);
    //     $('#region').val(project[3]);
    //     // console.log(project);
    // }

    // Livewire.on('test',(data)=>{
    //     alert(data);
    // });

</script>