@section('title', __('Accident Report'))
@section('parentPageTitle', 'Home')
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="tab-content">      
                <div class="header row">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-plus"></i> Request Asset</h5>
                </div>

                <div class="body pt-0">
                    <div class="form-group">
                        <form wire:submit.prevent="save">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                       

                                        <div class="col-md-6 form-group">
                                            <label>Employee Name Request</label>
                                            <input type="text" class="form-control"  wire:model="employee_name" readonly>
                                           

                                            @error('employee_name')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label>Position</label>
                                            <input type="text" class="form-control"  wire:model="position" readonly>
                                           

                                            @error('position')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label>Project</label>
                                            <!-- <select onclick="" class="form-control" wire:model="project">
                                                <option value=""> --- Project --- </option>
                                                
                                                @foreach($dataproject as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                            </select> -->
                                            <input type="text" class="form-control"  wire:model="project" readonly>
                                            @error('project')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label>Region</label>
                                            <input type="text" class="form-control" wire:model="region" readonly/>
                                            
                                            @error('region')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 form-group">
                                            <label>Type of Asset</label>
                                            <!-- <input type="text" class="form-control"  wire:model="asset_type" > -->
                                            <select onclick="" class="form-control" wire:model="asset_type">
                                                <option value=""> --- Type of Asset --- </option>
                                                <option value="1">Air Conditioner & Fan</option>
                                                <option value="2">Furniture & Fixture</option>
                                                <option value="3">Computer Equipment</option>
                                                <option value="4">Printer & Device</option>
                                            </select>

                                            @error('asset_type')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 form-group">
                                            <label>Name of Asset</label>
                                            <!-- <input list="asset_name1" class="form-control"  wire:model="asset_name">
                                            <datalist id="asset_name1" >
                                                @foreach($dataassetname as $item)
                                                <option value="{{ $item->asset_name }}">
                                                @endforeach
                                            </datalist> -->

                                            
                                            <select name="" id="" class="form-control"  wire:model="asset_name">
                                                <option value="">Name of Asset</option>
                                                @foreach($dataassetname as $item)
                                                <option value="{{ $item->asset_name }}">{{ $item->asset_name }}</option>
                                                @endforeach
                                            </select>
                                                

                                            @error('asset_name')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 form-group">
                                            <label>Location</label>
                                            <input type="text"  class="form-control"  wire:model="location" readonly>
                                            <!-- <select name="" id="" class="form-control"  wire:model="location">
                                                <option value="" selected>-- Location --</option>
                                                @foreach($datalocation as $item)
                                                    <option value="{{$item->id}}">{{$item->nama_dop}}</option>
                                                @endforeach
                                            </select> -->

                                            @error('location')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 form-group">
                                            <label>Dimension (H/L/W)</label>
                                            <input type="text"  class="form-control"  wire:model="dimension" readonly>
                                           

                                            @error('dimension')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 form-group">
                                            <label>Detail</label>
                                            <input type="text"  class="form-control"  wire:model="detail" readonly>
                                           

                                            @error('detail')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 form-group">
                                            <label>Quantity</label> <span style="color: red;"> Stok : <b>{{ $stock }}</b></span>
                                            <input type="number" max="{{ $stock }}" class="form-control"  wire:model="quantity" required>
                                           

                                            @error('quantity')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>

                                        <div class="col-md-12 form-group">
                                            <label>Reason of Request</label>
                                            <textarea name="" id="" cols="30" rows="2" class="form-control" wire:model="reason_request"></textarea>
                                           

                                            @error('request_reason')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 form-group">
                                            <label>Reference Picture</label>
                                            @if($reference_pic)
                                            <img src="<?php echo asset('storage/Asset_Database/'.$reference_pic); ?>" class="img-rounded" alt="" width="304" height="236">
                                            @endif
                                            <!-- <input type="file" class="form-control" name="file" wire:model="file" />
                                            @error('file')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror -->
                                        </div>

                                        <div class="col-md-6 form-group">
                                            <label>Link</label>
                                            @if($link)
                                            <a href="{{ $link }}">Link</a>
                                            @endif
                                        </div>

                                       
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