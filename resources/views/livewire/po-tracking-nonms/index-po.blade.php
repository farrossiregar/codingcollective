<div>
    <div class="header row px-0">
        <div class="col-md-2">
            <input type="text" class="form-control" wire:model="keyword" placeholder="Keyword" />
        </div>
        <div class="col-md-2">
            <input type="date" class="form-control" wire:model="date" />
        </div>
        <div class="col-md-8">
            <span wire:loading>
                <i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i>
                <span class="sr-only">{{ __('Loading...') }}</span>
            </span>
        </div>
    </div>
    <div class="body pt-0 px-0">    
        <div class="table-responsive" style="min-height:200px;">
            <table class="table table-striped m-b-0 c_list table-nowrap-th">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Status</th>
                        <th>PO No</th>    
                        <th>Date PO Release (sc)</th>    
                        <th>Date PO Release (sys)</th>
                        <th>Contract Number</th>
                        <th>Contract Date</th>
                        <th>BAST Number</th>
                        <th>BAST Date</th>
                        <th>GR Number</th>
                        <th>GR Date</th>
                        <th>Works</th>
                        <th>Project</th>
                        <th class="text-right">Amount</th>
                        <th class="text-right">Extra Budget</th>
                        <th></th>
                    </tr>
                </head>
                <tbody>
                    @if($data->count()==0)
                        <tr><td colspan="5" class="text-center"><i>Empty</i></td></tr>
                    @endif
                    @foreach($data as $k => $item)
                        <tr>
                            <td>{{$k+1}}</td>
                            <td>
                                @if($item->status==0)
                                    <span class="badge badge-info" title="Waiting BAST Regional">BAST - Regional</span>
                                @elseif($item->status==1)
                                    <span class="badge badge-info" title="Waiting Approval BAST Regional">BAST - E2E</span>
                                @elseif($item->status==3)
                                    <span class="badge badge-warning" title="Revisi BAST">Revisi</span>
                                @elseif($item->status==4)
                                    <span class="badge badge-info" title="Finance Upload Acceptance and Invoice">Finance</span>
                                @endif
                                @if($item->status==5)
                                    <span class="badge badge-success badge-active"><i class="fa fa-check-circle"></i> Done</span>
                                @endif
                            </td>
                            <td><a href="{{route('po-tracking-nonms.po-detail',['id'=>$item->id])}}">{{$item->po_number}}</a></td>
                            <td>{{date('d-M-Y',strtotime($item->date_po_sc))}}</td>
                            <td>{{date('d-M-Y',strtotime($item->date_po_sys))}}</td>
                            <td>{{$item->contract}}</td>
                            <td>{{date('d-M-Y',strtotime($item->date_contract))}}</td>
                            <td>{{$item->bast_number}}</td>
                            <td>{{$item->bast_date}}</td>
                            <td>{{$item->gr_number}}</td>
                            <td>{{$item->gr_date}}</td>
                            <td>{{$item->works}}</td>
                            <td>{{$item->project}}</td>
                            <td class="text-right">{{format_idr($item->payment_amount)}}</td>
                            <td class="text-right">
                                @if($item->status==5)
                                    @if($item->status_extra_budget=="")
                                        <li><a href="javascript:void(0)" data-toggle="modal" data-target="#modal_extra_budget" wire:click="$emit('set-data',{{$item->id}})" class="badge badge-info badge-active"><i class="fa fa-plus"></i> Extra Budget</a></li>
                                    @endif
                                    @if($item->status_extra_budget==1 and $is_finance)
                                        <li><a href="javascript:void(0)" class="badge badge-info badge-active" wire:click="$emit('set-data',{{$item->id}})" data-target="#modal_process_extra_budget" data-toggle="modal"><i class="fa fa-check-circle"></i> Process Extra Budget</a></li>
                                    @endif
                                    @if($item->status_extra_budget==2)
                                        {{format_idr($item->extra_budget)}}
                                    @endif
                                @endif
                            </td>
                            <td class="header">
                                <ul class="header-dropdown">
                                    <li class="dropdown">
                                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"></a>
                                        <ul class="dropdown-menu dropdown-menu-right">
                                            <li><a href="{{route('po-tracking-nonms.po-detail',['id'=>$item->id])}}"><i class="fa fa-search"></i> Detail</a></li>
                                            @if($is_service_manager and $item->status==0)
                                                <li><a href="{{route('po-tracking-nonms.po-create-bast',['id'=>$item->id])}}"><i class="fa fa-plus"></i>  Create BAST</a></li>
                                            @endif
                                            @if($is_e2e and $item->status==1)
                                                <li><a href="{{route('po-tracking-nonms.po-detail',['id'=>$item->id])}}"><i class="fa fa-edit"></i> Review BAST</a></li>
                                            @endif
                                            @if($is_finance and $item->status==4)
                                                <li><a href="javascript:;" wire:click="$emit('modalimportaccdoc',{{$item->id}})"  data-toggle="modal" data-target="#modal-potrackingnonms-importaccdoc" title="Upload" ><i class="fa fa-upload"></i> {{__(' Acceptance & Invoice')}}</a></li>
                                            @endif
                                        </ul>
                                    </li>
                                </ul>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
