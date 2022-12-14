@section('title', __('Accident Report'))
@section('parentPageTitle', 'Home')
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="tab-content">      
                <div class="header row">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-eye"></i> Request Asset</h5>
                </div>

                <div class="body pt-0">
                    <div class="form-group">
                        <form wire:submit.prevent="save">
                            @csrf
                            <div class="row">
                                <div class="col-md-12" >
                                    <div class="row  form-group" style="border: 1px solid lightgrey; border-radius: 5px; padding: 10px 0; width: 100%; margin: auto;">
                                        <br>
                                        

                                        <div class="col-md-6 form-group">
                                            <label>Location</label>
                                            
                                            <select name="" id="" class="form-control"  wire:model="location">
                                                <option value="" selected>-- Location --</option>
                                                <option value="007">Jakarta (HQ)</option>
                                                @foreach(\App\Models\DophomebaseMaster::where('status', '1')->orderBy('id', 'asc')->get() as $item)
                                                    <option value="{{$item->id}}">{{$item->nama_dop}}</option>
                                                @endforeach
                                            </select>

                                            @error('location')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 form-group">
                                            <label>Dimension (H/L/W)</label>
                                            <input type="text"  class="form-control"  wire:model="dimension" >
                                           

                                            @error('dimension')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 form-group">
                                            <label>Reference Picture</label>
                                            <input type="file" class="form-control" name="file" wire:model="file" />
                                            @if($file)
                                            <img src="<?php echo asset('storage/Asset_database/'.$file); ?>" class="img-rounded" alt="" width="160" height="90">
                                            @endif
                                            @error('file')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 form-group">
                                            <label>Link</label>
                                            <input type="text"  class="form-control"  wire:model="link" >
                                            @error('link')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror

                                        </div>

                                        <!-- <div class="col-md-6 form-group">
                                            <label>Serial Number</label>
                                            <input type="text"  class="form-control"  wire:model="serial_number" >
                                           

                                            @error('quantity')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div> -->


                                        <div class="col-md-6 form-group">
                                            <label>Detail Asset</label>
                                            <textarea name="" id="" cols="30" rows="6" class="form-control"  wire:model="detail"></textarea>

                                            @error('detail')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 form-group">
                                            <label>Reason Request</label>
                                            <textarea name="" id="" cols="30" rows="6" class="form-control"  wire:model="reason_request"></textarea>

                                            @error('detail')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>

                                        <!-- <div class="col-md-6 form-group">
                                            <label>Dana From</label>
                                            <select name="" id="" class="form-control"  wire:model="dana_from">
                                                <option value="" selected>-- Dana From --</option>
                                                <option value="1">e-PL</option>
                                                <option value="2">Petty Cash</option>
                                            </select>
                                            @error('dana_from')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>

                                        @if($prno == '1')
                                        <div class="col-md-6 form-group">
                                            <label>PR No</label>
                                            <input type="text"  class="form-control"  wire:model="pr_no" >
                                           

                                            @error('pr_no')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>
                                        @else
                                        
                                        @endif

                                        <div class="col-md-6 form-group">
                                            <label>Dana Amount</label>
                                            <input type="text"  class="form-control"  wire:model="dana_amount" >
                                           

                                            @error('dana_amount')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div> -->

                                        

                                       
                                    </div>
                                </div>
                                
                                <div class="col-md-12 form-group">
                                    <hr />
                                    
                                    <button type="submit" class="btn btn-info close-modal"><i class="fa fa-edit"></i> Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('after-scripts')
        <script type="text/javascript">
        

        $("input[data-type='currency']").on({
            keyup: function() {
                formatCurrency($(this));
            },
            blur: function() { 
                formatCurrency($(this), "blur");
            }
        });

        function formatNumber(n) {
            return n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",")
        }


        function formatCurrency(input, blur) {
            var input_val = input.val();
            
            // don't validate empty input
            if (input_val === "") { return; }
            
            // original length
            var original_len = input_val.length;

            // initial caret position 
            var caret_pos = input.prop("selectionStart");
                
            // check for decimal
            if (input_val.indexOf(".") >= 0) {
                var decimal_pos = input_val.indexOf(".");

                // split number by decimal point
                var left_side = input_val.substring(0, decimal_pos);
                var right_side = input_val.substring(decimal_pos);

                // add commas to left side of number
                left_side = formatNumber(left_side);

                // validate right side
                right_side = formatNumber(right_side);
                input_val = "Rp" + left_side;

            } else {
                input_val = formatNumber(input_val);
                input_val = "Rp" + input_val;
            }
            
            input.val(input_val);
            var updated_len = input_val.length;
            caret_pos = updated_len - original_len + caret_pos;
            input[0].setSelectionRange(caret_pos, caret_pos);
        }
        </script>
        @endpush
</div>