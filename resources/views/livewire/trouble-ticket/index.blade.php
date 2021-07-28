@section('title', __('Trouble Ticket'))
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="header row">
                <div class="col-md-2">
                    <input type="text" class="form-control" wire:model="keyword" placeholder="Searching..." />
                </div>
                {{-- @if(check_access('trouble-ticket.insert')) --}}
                <div class="col-md-1">
                    <a href="javascript:void(0)" data-toggle="modal" data-target="#modal_insert_trouble_ticket" class="btn btn-primary"><i class="fa fa-plus"></i> {{__('Trouble Ticket')}}</a>
                </div>
                {{-- @endif --}}
            </div>
            <div class="body">
                <div class="table-responsive">
                    <table class="table table-striped m-b-0 c_list">
                        <thead>
                            <tr>
                                <th>No</th>                               
                                <th>Ticket Number</th>          
                                <th>Employee</th>          
                                <th>Subject</th>          
                                <th>Description</th>          
                                <th>Status</th>          
                                <th>Website</th> 
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $k => $item)
                            <tr>
                                <td style="width: 50px;">{{$k+1}}</td>
                                <td>{{$item->telepon}}</td>
                                <td>{{$item->address}}</td>
                                <td>{{$item->code}}</td>
                                <td>{{$item->website}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <br />
                {{$data->links()}}
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" wire:ignore.self id="modal_insert_trouble_ticket" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form>
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-plus"></i> Trouble Ticket</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true close-btn">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Trouble Ticket Number </label>
                            <input type="text" class="form-control" wire:model="trouble_ticket_number" disabled />
                        </div>
                        <div class="form-group">
                            <label>Employee </label>
                            <select class="form-control" wire:model="employee_id">
                                <option value=""> --- Select --- </option>
                                @foreach($employee as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                            </select>                            
                        </div>
                        <div class="form-group" x-data="">
                            <label>Category </label>
                            <select class="form-control" wire:model="trouble_ticket_category_id">
                                <option value=""> --- Select --- </option>
                                @foreach($category as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                                <option value="others">Others ( Free Text )</option>
                            </select>
                            <div x-show="$wire.show_category_others" class="mt-2">
                                <input type="text" class="form-control" wire:model="trouble_ticket_category_others" placeholder="Free Text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea class="form-control" wire:model="description" style="height: 80px;"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Attachment (pdf,docs,image)</label>
                            <input type="file" class="form-control" wire:model="file" multiple />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal">No</button>
                        <button type="submit"class="btn btn-danger">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>