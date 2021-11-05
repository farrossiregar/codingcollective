@section('title', __('PO Tracking MS - Preview'))
@section('parentPageTitle', 'Home')
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="row">
                <div class="col-md-12">
                    <br>
                </div>
                <div class="col-md-12">
                    <div class="header row">
                        <!-- <div class="col-md-2">
                            <input type="date" class="form-control" wire:model="date" />
                        </div> -->

                        <div class="col-md-1">
                            <input type="text" class="form-control" wire:model="nama_dop" placeholder="Nama DOP" />
                        </div>
                        
                        <div class="col-md-1">
                            <input type="text" class="form-control" wire:model="project" placeholder="Project" />
                        </div>

                        <div class="col-md-1">
                            <input type="text" class="form-control" wire:model="region" placeholder="Region" />
                        </div>
                        

                        <!-- <div class="col-md-1">                
                            <select class="form-control" wire:model="year">
                                <option value=""> --- Year --- </option>
                                @foreach(\App\Models\EmployeeNoc::select('year')->groupBy('year')->get() as $item) 
                                <option>{{$item->year}}</option>
                                @endforeach 
                            </select>
                        </div> -->
        
                        <!-- <div class="col-md-2">
                            <a wire:click="save({{ $selected_id }})" href="" title="Add" class="btn btn-primary"><i class="fa fa-download"></i> {{__('Export Duty roster')}}</a>
                        </div> -->
                        <!-- <div class="col-md-2" wire:ignore>
                            <select class="form-control" style="width:100%;" wire:model="month">
                                <option value=""> --- Month --- </option>
                                @foreach(\App\Models\EmployeeNoc::select('month')->groupBy('month')->orderBy('month','ASC')->get() as $item)
                                <option value="{{$item->month}}">{{date('F', mktime(0, 0, 0, $item->month, 10))}}</option>
                                @endforeach
                            </select>
                        </div> -->
                    </div>
                </div>
                
                
                <div class="col-md-12">
                    <div class="body pt-0">
                        <div class="table-responsive">
                            <table class="table table-striped m-b-0 c_list">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <!-- <th>Remarks</th> -->
                                        <th>Nama DOP</th>
                                        <th>Project</th>
                                        <th>Region</th>

                                        
                                    </tr>
                                </thead>
                                <tbody>
                                   
                                </tbody>
                            </table>
                        </div>

                        <br>
                        <div class="row">
                            <div class="col-md-3">
                                <a href="{{route('po-tracking-ms.index')}}"><i class="fa fa-arrow-left"></i> {{ __('Back') }}</a>
                            </div>
                        </div>
                        <br>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-dutyroster-importdutyroster" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <livewire:duty-roster-dophomebase.importdutyroster />
        </div>
    </div>
</div>



@section('page-script')


    Livewire.on('modalimportnoc',(data)=>{
        $("#modal-dutyroster-importdutyroster").modal('show');
    });


@endsection