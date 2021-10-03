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


    
    <div class="col-md-2">
        <!-- <a href="#" data-toggle="modal" data-target="#modal-contractregistrationflow-input" title="Add" class="btn btn-primary"><i class="fa fa-plus"></i> {{__('Input New Opportunity')}}</a> -->
    </div>
    
    
    
    
    <div class="col-md-12">
        <br><br>
        <div class="table-responsive">
            <table class="table table-striped m-b-0 c_list">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Customer</th> 
                        <th>Project Name</th> 
                        <th>Region</th> 
                        <th>Quantity</th> 
                        <th>Price Unit</th> 
                        <th>Estimated Revenue</th> 
                        <th>Duration</th> 
                        <th>Brief Description of Project</th> 
                        <th>Date</th> 
                        <th>Status</th> 
                        <th>Customer Type</th> 
                        <th>Created By</th> 
                        <th>Date Created</th> 
                        <th>Action</th> 
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $key => $item)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $item->customer }}</td>
                        <td>{{ $item->project_name }}</td>
                        <td>{{ $item->region }}</td>
                        <td>{{ $item->qty }}</td>
                        <td>Rp,{{ format_idr($item->price_or_unit) }}</td>
                        <td>Rp,{{ format_idr($item->estimate_revenue) }}</td>
                        <td>{{ $item->duration }}</td>
                        <td>{{ $item->brief_description }}</td>
                        <td>{{ date_format(date_create($item->date), 'd M Y') }}</td>
                        <td>
                            @if($item->status == '1')
                                <label class="badge badge-success" data-toggle="tooltip" title="Won">Won</label>
                            @endif

                            @if($item->status == '0')
                                <label class="badge badge-danger" data-toggle="tooltip" title="Failed">Failed</label>
                            @endif

                            @if($item->status == '' || $item->status == 'null')
                                <label class="badge badge-warning" data-toggle="tooltip" title="On going">On going</label>
                            @endif
                        </td> 
                        
                        
                        <td>{{ $item->customer_type }}</td>
                        <td>{{ $item->sales_name }}</td>
                        <td>{{ date_format(date_create($item->created_at), 'd M Y') }}</td>
                        <td>
                            
                            @if(check_access('duty-roster.approve'))
                                @if($item->status == '')
                                    <a href="javascript:;" wire:click="$emit('modalwonbo','{{ $item->id }}')" class="btn btn-success"><i class="fa fa-check"></i> Won</a>
                                    <a href="javascript:;" wire:click="$emit('modalfailedbo','{{ $item->id }}')" class="btn btn-danger"><i class="fa fa-close"></i> Failed</a>
                                @endif

                            @endif

                            @if(check_access('duty-roster.import'))
                                @if($item->status == '0')
                                    <!-- <a href="#" wire:click="$emit('modalrevisidutyroster','{{ $item->id }}')" data-toggle="modal" data-target="#modal-dutyroster-revisidutyroster" title="Add" class="btn btn-warning"><i class="fa fa-plus"></i> {{__('Revisi Duty roster')}}</a> -->
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