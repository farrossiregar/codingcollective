<div class="row">


    <div class="col-md-2">
        <input type="text" class="form-control" placeholder="Keyword" wire:model="keyword" />
    </div>
    
    <!-- if(check_access('accident-report.input')) -->
    <div class="col-md-2">
        
        <a href="javascript:;" wire:click="$emit('modaladdcommitmentletter')" class="btn btn-info"><i class="fa fa-plus"></i> Add Commitment Letter </a>
    </div>
    <!-- endif -->

    <div class="col-md-12">
        <br><br>
        <div class="table-responsive">
            <table class="table table-striped m-b-0 c_list">
                <thead>
                    <tr>
                        <th>No</th> 
                        <th>Company Name</th> 
                        <th>Project</th> 
                        <th>Region</th> 
                        <th>Region / Area</th> 
                        <th>KTP ID</th> 
                        <th>NIK PMT</th> 
                        <th>Leader</th> 
                        <th>Employee Name</th> 
                        <th>BCG</th> 
                        <th>Cyber Security</th> 
                        <th>Date Create</th> 
                        <th>Status</th> 
                        <th>Action</th> 

                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $key => $item)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $item->company_name }}</td>
                        <td>{{ $item->project }}</td>
                        <td>{{ $item->region }}</td>
                        <td>{{ $item->region_area }}</td>
                        <td>{{ $item->ktp_id }}</td>
                        <td>{{ $item->nik_pmt }}</td>
                        <td>{{ $item->leader }}</td>
                        <td>{{ $item->employee_name }}</td>
                        <td>

                            @if($item->bcg == '' || $item->bcg == NULL )
                                <a href="javascript:;" wire:click="$emit('modalimportbcg','{{ $item->id }}')"><i class="fa fa-upload fa-2x"></i></a>
                            @else
                                <a href="<?php echo asset('storage/Commitment_Letter/BCG/'.$item->bcg); ?>"><i class="fa fa-download fa-2x" style="color: #28a745;"></i></a>
                            @endif
                        </td>
                        <td>
                            
                            @if($item->cyber_security == '' || $item->cyber_security == NULL )
                                <a href="javascript:;" wire:click="$emit('modalimportcybersecurity','{{ $item->id }}')"><i class="fa fa-upload fa-2x"></i></a>
                            @else
                                <a href="<?php echo asset('storage/Commitment_Letter/Cyber_Security/'.$item->cyber_security); ?>"><i class="fa fa-download fa-2x" style="color: #28a745;"></i></a>
                            @endif
                        </td>
                        <td>{{ date_format(date_create($item->created_at), 'd M Y') }}</td>
                        <td>
                            @if($item->bcg != '' && $item->cyber_security != '')
                                <label class="badge badge-success" data-toggle="tooltip" title="Signed">Signed</label>
                            @else
                                <label class="badge badge-warning" data-toggle="tooltip" title="Unsigned">Unsigned</label>
                            @endif

                            @if($item->status == '1')
                                <label class="badge badge-success" data-toggle="tooltip" title="Done">Done</label>
                            @endif

                            @if($item->status == '0')
                                <label class="badge badge-danger" data-toggle="tooltip" title="Decline">Decline</label>
                            @endif
                        </td>
                        <td>
                            <!-- if(check_access('accident-report.input')) -->
                            <a href="javascript:;" wire:click="$emit('modalapprovecommitmentletter','{{ $item->id }}')" title="Add" class="btn btn-success"><i class="fa fa-check"></i> Approve</a>
                            <a href="javascript:;" wire:click="$emit('modaldeclinecommitmentletter','{{ $item->id }}')" title="Add" class="btn btn-danger"><i class="fa fa-close"></i> Decline</a>
                            <!-- endif -->
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>