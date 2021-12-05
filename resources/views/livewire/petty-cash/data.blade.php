<div class="row">
    <div class="col-md-2">
        <input type="date" class="form-control" wire:model="date" />
    </div>

<!--     
    <div class="col-md-1">                
        <select class="form-control" wire:model="year">
            <option value=""> --- Year --- </option>
            @foreach(\App\Models\EmployeeNoc::select('year')->groupBy('year')->get() as $item) 
            <option>{{$item->year}}</option>
            @endforeach 
        </select>
    </div> -->


    @if(check_access('duty-roster.import'))
    <!-- <div class="col-md-2">
        <a href="#" data-toggle="modal" data-target="#modal-dutyroster-importdutyroster" title="Add" class="btn btn-primary"><i class="fa fa-plus"></i> {{__('Input Petty Cash')}}</a>
    </div> -->
    
    @endif


    <div class="col-md-3" style="float: right;">
        <a href="javascript:;" wire:click="$emit('modaladdpettycash')" class="btn btn-info"><i class="fa fa-plus"></i> Add Petty Cash </a>
    </div>
    
    
    <div class="col-md-12">
        <br><br>
        <div class="table-responsive">
            <table class="table table-striped  table-bordered  m-b-0 c_list">
                <thead>
                    <tr>
                        <th rowspan="2" class="align-middle">No</th>
                        <th colspan="9" class="text-center align-middle">Request Petty Cash</th>
                        <th colspan="3" class="text-center align-middle">Upload Softcopy of Receipt</th> 
                    </tr>
                    <tr>
                        
                        <th class="text-center align-middle">Status</th> 
                        <th class="text-center align-middle">Date Create</th>
                        <th class="text-center align-middle">Company Name</th> 
                        <th class="text-center align-middle">Project</th> 
                        <th class="text-center align-middle">Region</th> 
                        <th class="text-center align-middle">Amount</th> 
                        <th class="text-center align-middle">Keterangan</th> 
                        <th class="text-center align-middle">Petty Cash Note</th> 
                        <th class="text-center align-middle">Petty Cash Review</th> 
                        <th class="text-center align-middle">Upload Receipt</th> 
                        <th class="text-center align-middle">Receipt Note</th> 
                        <th class="text-center align-middle">Receipt Review</th> 
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $key => $item)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>
                            

                            @if($item->status == '1')
                                @if($item->status_receipt == '1')
                                    <label class="badge badge-success" data-toggle="tooltip" title="Close">Close</label>
                                @endif

                                @if($item->status_receipt == '0')
                                    <label class="badge badge-danger" data-toggle="tooltip" title="Receipt Decline">Receipt Decline</label>
                                @endif

                                @if($item->status_receipt == '')
                                    <label class="badge badge-warning" data-toggle="tooltip" title="Receipt on Review">Receipt on Review</label>
                                @endif
                                
                            @endif

                            @if($item->status == '0')
                                <label class="badge badge-danger" data-toggle="tooltip" title="Decline">Petty Cash Decline</label>
                            @endif

                            @if($item->status == '' || $item->status == 'null')
                                <label class="badge badge-warning" data-toggle="tooltip" title="Petty Cash on Review">Petty Cash on Review</label>
                            @endif
                        </td> 
                        <td>{{ date_format(date_create($item->created_at), 'd M Y') }}</td>
                        <td>
                            @if($item->company_id == '1')
                                HUP
                            @else
                                PMT
                            @endif
                        </td>
                        <td>{{ get_project_company($item->project, $item->company_id) }}</td>
                        <td>{{$item->region}}</td>
                        <td>Rp, {{ format_idr($item->amount) }}</td>
                        <td>{{$item->keterangan}}</td>
                        <td>{{$item->note}}</td>
                        <td class="text-center align-middle">
                            <!-- <a href="{{route('duty-roster.preview',['id'=>$item->id]) }}" title="Add" class="btn btn-primary"><i class="fa fa-eye"></i> {{__('Preview')}}</a> -->
                            @if(check_access('duty-roster.approve'))
                                @if($item->status == '')
                                    <!-- <a href="javascript:;" wire:click="$emit('modalapprovedutyroster','{{ $item->id }}')" class="btn btn-success"><i class="fa fa-check"></i> Approve</a>
                                    <a href="javascript:;" wire:click="$emit('modaldeclinedutyroster','{{ $item->id }}')" class="btn btn-danger"><i class="fa fa-close"></i> Decline</a> -->
                                    <a href="javascript:;" wire:click="$emit('modalapprovepettycash','{{ $item->id }}')"><i class="fa fa-check fa-2x" style="color: #22af46;"></i></a>
                                    <a href="javascript:;" wire:click="$emit('modaldeclinepettycash','{{ $item->id }}')"><i class="fa fa-close fa-2x" style="color: #de4848;"></i></a>
                                @endif

                            @endif

                            @if(check_access('duty-roster.import'))
                                @if($item->status == '0')
                                <a href="javascript:;" wire:click="$emit('modalrevisidutyroster','{{ $item->id }}')"><i class="fa fa-edit fa-2x" style="color: #f3ad06;"></i></a>
                                    <!-- <a href="#" wire:click="$emit('modalrevisidutyroster','{{ $item->id }}')" data-toggle="modal" data-target="#modal-dutyroster-revisidutyroster" title="Add" class="btn btn-warning"><i class="fa fa-edit"></i> {{__('Revisi')}}</a> -->
                                @endif
                            @endif
                        </td>
                        <td class="text-center align-middle">
                            
                            <a href="javascript:;" wire:click="$emit('modalimportpettycash','{{ $item->id }}')"><i class="fa fa-plus fa-2x"></i></a>

                        </td>
                        
                        <td>{{$item->note_receipt}}</td>
                        

                        <td class="text-center align-middle">
                            <!-- <a href="{{route('duty-roster.preview',['id'=>$item->id]) }}" title="Add" class="btn btn-primary"><i class="fa fa-eye"></i> {{__('Preview')}}</a> -->
                            @if(check_access('duty-roster.approve'))
                                @if($item->status == '1' && $item->status_receipt != '1')
                                    <a href="javascript:;" wire:click="$emit('modalapprovereceipt','{{ $item->id }}')"><i class="fa fa-check fa-2x" style="color: #22af46;"></i></a>
                                    <a href="javascript:;" wire:click="$emit('modaldeclinereceipt','{{ $item->id }}')"><i class="fa fa-close fa-2x" style="color: #de4848;"></i></a>
                                    <!-- <a href="javascript:;" wire:click="$emit('modalapprovedutyroster','{{ $item->id }}')" class="btn btn-success"><i class="fa fa-check"></i> Approve</a>
                                    <a href="javascript:;" wire:click="$emit('modaldeclinedutyroster','{{ $item->id }}')" class="btn btn-danger"><i class="fa fa-close"></i> Decline</a> -->
                                @endif

                            @endif

                        </td>
                        
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>