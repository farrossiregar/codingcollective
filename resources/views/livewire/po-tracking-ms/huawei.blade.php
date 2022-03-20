<div>
    <div class="header row px-0">
        <div class="col-md-2">
            <input type="text" class="form-control" wire:model="keyword" placeholder="Keyword" />
        </div>
        <div class="col-md-10">
            <a href="javascript:void(0)" data-toggle="modal" data-target="#modal_upload_huawei" class="btn btn-info"><i class="fa fa-upload"></i> Upload</a>
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
                        <th>PO Line Shipment</th>    
                        <th>Region</th>    
                        <th>Site ID</th>    
                        <th>Site Name</th>    
                        <th>PO Period</th>    
                        <th>Type PO</th>    
                        <th>PO Category</th>    
                        <th>Item Description</th>    
                        <th>UOM</th>    
                        <th>QTY</th>    
                        <th>Unit Price</th>    
                        <th>Total Amount</th>    
                        <th>Status</th>    
                        <th>BOS Approved</th>    
                        <th>GM Approved</th>    
                        <th>GH Approved</th>    
                        <th>Director Approved</th>    
                        <th>Verification</th>    
                        <th>Acceptance</th>    
                        <th>Deduction (%)</th>    
                        <th>EHS Deduction / Other Deduction</th>    
                        <th>RP Deduction</th>    
                        <th>Scar No</th>    
                        
                    </tr>
                </head>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>

    <div class="modal fade" id="modal_upload_huawei" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <form wire:submit.prevent="save">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-upload"></i> Upload Huawei</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true close-btn">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input type="file" class="form-control" name="file" wire:model="file" />
                        @error('file')
                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-info close-modal"><i class="fa fa-upload"></i> Upload</button>
                </div>
                <div wire:loading>
                    <div class="page-loader-wrapper" style="display:block">
                        <div class="loader" style="display:block">
                            <div class="lds-ring"><div></div><div></div><div></div><div></div></div>
                            <p>Please wait...</p>
                        </div>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>

</div>  