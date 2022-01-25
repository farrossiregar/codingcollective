<form wire:submit.prevent="save">
    @csrf
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-upload"></i> Upload Tranfer Receipt</h5>
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
    
    <!-- if(count(\App\Models\PettyCashUploader::where('id_petty_cash', $this->selected_id)->get()) > 0) -->
    <hr>
    <div class="modal-header">
        <h5 class="modal-title"><i class="fa fa-download"></i> Download Transfer Receipt</h5>
    </div>
    <div class="modal-body">
        <div class="row">
            @foreach(\App\Models\ClaimingProcess::where('ticket_id', $this->selected_id)->get() as $item)
           
            <div class="col-md-10">
                <a href="<?php echo asset('storage/ClaimingProcess/'.$item->transfer_receipt); ?>" target="_blank"><i class="fa fa-download"></i>Transfer Receipt</a>
            </div>
            <!-- <div class="col-md-2">
                
                <a href="#" wire:click="delete({{ $item->id }})" title="Delete" ><i style="color: #dc3545;" class="fa fa-trash fa-2x"></i> </a>
            </div> -->
            <br>
            @endforeach
        </div>
    </div>
    <!-- endif -->

    
    <div wire:loading>
        <div class="page-loader-wrapper" style="display:block">
            <div class="loader" style="display:block">
                <div class="lds-ring"><div></div><div></div><div></div><div></div></div>
                <p>Please wait...</p>
            </div>
        </div>
    </div>
</form>