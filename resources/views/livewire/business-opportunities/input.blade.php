@section('title', __('Business Opportunities - Input'))
@section('parentPageTitle', 'Home')
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="tab-content">      
                <div class="header row">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-plus"></i> Input Business Opportunities</h5>
                </div>

                <div class="body pt-0">
                    <div class="form-group">
                        <form wire:submit.prevent="save">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-6 form-group">
                                            <label>Quotation Number</label>
                                            <input type="text" class="form-control" wire:model="quotation_number"/>
                                            @error('quotation_number')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label>PO Number</label>
                                            <input type="text" class="form-control" wire:model="po_number"/>
                                            @error('po_number')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label>Customer</label>
                                            <input type="text" class="form-control" wire:model="customer" required/>
                                            @error('customer')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label>Project Name</label>
                                            <input type="text" class="form-control" wire:model="project_name" required/>
                                            @error('project_name')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label>Region</label>
                                            <select class="form-control" wire:model="region" required>
                                                <option value="">-- Region --</option>
                                                @foreach(\App\Models\Region::orderBy('id', 'desc')->get() as $item)
                                                <option value="{{ $item->region }}">{{ $item->region }}</option>
                                                @endforeach
                                            </select>
                                            @error('region')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <div class="row">
                                                <div class="col-md-8 form-group">
                                                    <label>Quantity</label>
                                                    <input type="number" class="form-control" wire:model="qty" required/>
                                                    @error('qty')
                                                    <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                                    @enderror
                                                </div>
                                                <div class="col-md-4 form-group">
                                                    <label>Unit</label>
                                                    <select class="form-control" wire:model="unit">
                                                        <option value="">-- Unit --</option>
                                                        <option value="sites">Sites</option>
                                                        <option value="team">Team</option>
                                                        <option value="km">KM</option>
                                                    </select>
                                                    @error('unit')
                                                    <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                                    @enderror
                                                </div>
                                            </div>
                                            
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label>Price / Unit (IDR)</label>
                                            <!-- <input type="number" class="form-control" wire:model="price_or_unit" required/> -->
                                            <!-- <input type="text" class="form-control" name="currency-field" id="currency-field" pattern="^\$\d{1,3}(,\d{3})*(\.\d+)?$" value="" data-type="currency" wire:model="price_or_unit" required placeholder="Rp1,000,000"> -->
                                            <input type="text" class="form-control" name="currency-field" id="currency-field" value="" data-type="currency" wire:model="price_or_unit" required placeholder="Rp1,000,000">
                                            @error('price_or_unit')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label>Estimated Revenue (IDR)</label>
                                            <!-- <input onchange="currency()" id="estimated_revenue" type="text" class="form-control" wire:model="estimate_revenue"/> -->
                                            <!-- <input type="number" class="form-control" wire:model="estimate_revenue" required/> -->
                                            <input type="text" class="form-control" name="currency-field" id="currency-field" value="" data-type="currency" wire:model="estimate_revenue" required placeholder="Rp1,000,000">
                                            @error('estimate_revenue')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>
                                        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
                                        <script>

                                            // Jquery Dependency

                                            
                                            $("input[data-type='currency']").on({
                                                keyup: function() {
                                                formatCurrency($(this));
                                                },
                                                blur: function() { 
                                                formatCurrency($(this), "blur");
                                                }
                                            });


                                            function formatNumber(n) {
                                                // format number 1000000 to 1,234,567
                                                return n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",")
                                            }


                                            function formatCurrency(input, blur) {
                                                // appends $ to value, validates decimal side
                                                // and puts cursor back in right position.
                                                
                                                // get input value
                                                var input_val = input.val();
                                                
                                                // don't validate empty input
                                                if (input_val === "") { return; }
                                                
                                                // original length
                                                var original_len = input_val.length;

                                                // initial caret position 
                                                var caret_pos = input.prop("selectionStart");
                                                    
                                                // check for decimal
                                                if (input_val.indexOf(".") >= 0) {

                                                    // get position of first decimal
                                                    // this prevents multiple decimals from
                                                    // being entered
                                                    var decimal_pos = input_val.indexOf(".");

                                                    // split number by decimal point
                                                    var left_side = input_val.substring(0, decimal_pos);
                                                    var right_side = input_val.substring(decimal_pos);

                                                    // add commas to left side of number
                                                    left_side = formatNumber(left_side);

                                                    // validate right side
                                                    right_side = formatNumber(right_side);
                                                    
                                                    // On blur make sure 2 numbers after decimal
                                                    // if (blur === "blur") {
                                                    // right_side += "00";
                                                    // }
                                                    
                                                    // Limit decimal to only 2 digits
                                                    // right_side = right_side.substring(0, 2);

                                                    // join number by .
                                                    // input_val = "Rp" + left_side + "." + right_side;
                                                    input_val = "Rp" + left_side;

                                                } else {
                                                    // no decimal entered
                                                    // add commas to number
                                                    // remove all non-digits
                                                    input_val = formatNumber(input_val);
                                                    input_val = "Rp" + input_val;
                                                    
                                                    // final formatting
                                                    // if (blur === "blur") {
                                                    // input_val += ".00";
                                                    // }
                                                }
                                                
                                                // send updated string to input
                                                input.val(input_val);

                                                // put caret back in the right position
                                                var updated_len = input_val.length;
                                                caret_pos = updated_len - original_len + caret_pos;
                                                input[0].setSelectionRange(caret_pos, caret_pos);
                                            }





                                            // function currency(){
                                            //     var numb = document.getElementById("estimated_revenue").value;
                                            //     // numb.replace('IDR ', '');
                                            //     // numb.replace('.', '');
                                            //     // var txt = "#div-name-1234-characteristic:561613213213";
                                            //     // numb.replace('.00', '');
                                            //     // numb = numb.match(/\d/g);
                                            //     // numb = numb.join("");
                                                
                                            //     // numb.slice(-3);
                                            //     // console.log(numb.replace('.00', ''));
                                            //     var formatter = new Intl.NumberFormat('en-US', {
                                            //         style: 'currency',
                                            //         currency: 'IDR',
                                            //     });
                                                
                                            //     // console.log(formatter.format(numb));
                                                
                                            //     document.getElementById("estimated_revenue").value = formatter.format(numb);
                                            // }
                                        </script>
                                        <!-- <div class="col-md-6 form-group">
                                            <label>Duration</label>
                                            <input type="number" class="form-control" wire:model="duration"/>
                                            @error('duration')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div> -->
                                        <div class="col-md-6 form-group">
                                            <label>Start Duration</label>
                                            <input type="date" class="form-control" wire:model="startdate" required/>
                                            @error('startdate')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label>End Duration</label>
                                            <input type="date" class="form-control" wire:model="enddate" required/>
                                            @error('enddate')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>
                                        <!-- <div class="col-md-6 form-group">
                                            <label>Start Duration</label>
                                            <input type="date" class="form-control" wire:model="start_dur"/>
                                            @error('start_dur')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label>End Duration</label>
                                            <input type="date" class="form-control" wire:model="end_dur"/>
                                            @error('end_dur')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div> -->
                                        <div class="col-md-12 form-group">
                                            <label>Brief Description of Project</label>
                                            <textarea class="form-control" wire:model="brief_description" required></textarea>
                                            @error('start_dur')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>
                                        
                                        <div class="col-md-12 form-group">
                                            <label>Customer_type</label>
                                            <select class="form-control" wire:model="customer_type" x-data="" required>
                                                <option value="">-- Customer Type --</option>
                                                <option value="Tower Provider">Tower Provider</option>
                                                <option value="Vendor">Vendor</option>
                                                <option value="Operators">Operator</option>
                                                <option value="Others">Others</option>
                                            </select>
                                            <!-- <div x-show="$wire.show_customer_type2" class="mt-2">
                                                <input type="text" class="form-control" placeholder="Customer lain yang tidak disebutkan diatas:  *Free Text*" wire:model="customer_type2">
                                            </div> -->
                                            @error('customer_type')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>
                                       
                                        <!-- <div class="col-md-12 form-group" x-data="">
                                            <label>Jenis Insiden</label>
                                            <select class="form-control" wire:model="jenis_insiden" >
                                                <option value=""> -- Jenis Insiden --</option>
                                                <option value="Menabrak / Ditabrak sesuatu">Menabrak / Ditabrak sesuatu</option>
                                                <option value="Jatuh / Kejatuhan">Jatuh / Kejatuhan</option>
                                                <option value="Jatuh pada permukaan yang sama (terpeleset, terguling)">Jatuh pada permukaan yang sama (terpeleset, terguling)</option>
                                                <option value="Kontak dengan permukaan kerja (benda kasar/tajam, tersayat)">Kontak dengan permukaan kerja (benda kasar/tajam, tersayat)</option>
                                                <option value="Terjepit didalam, terkait pada, terjepit diantara, atau tergencet">Terjepit didalam, terkait pada, terjepit diantara, atau tergencet</option>
                                                <option value="Terkena suhu yang ekstrim (Heatstroke, Frostbite, Luka bakar, dll)">Terkena suhu yang ekstrim (Heatstroke, Frostbite, Luka bakar, dll)</option>
                                                <option value="Kontak dengan listrik/ radiasi/ bahankimia/ racun/ kebisingan">Kontak dengan listrik/ radiasi/ bahankimia/ racun/ kebisingan</option>
                                                <option value="Masuknya benda asing ke tubuh/mata/kulit (debu,logam)">Masuknya benda asing ke tubuh/mata/kulit (debu,logam)</option>
                                                <option value="Terpapar tekanan berlebih (stress)/ gerakan berlebih">Terpapar tekanan berlebih (stress)/ gerakan berlebih</option>
                                                <option value="Terjepit didalam, terkait pada, terjepit diantara, atau tergencet">Terjepit didalam, terkait pada, terjepit diantara, atau tergencet</option>
                                                <option value="Gerakan berulang-ulang (ergonomi)">Gerakan berulang-ulang (ergonomi)</option>
                                                <option value="Disengat oleh / digigit oleh sesuatu">Disengat oleh / digigit oleh sesuatu</option>
                                                <option value="Faktor biologis (Bakteri, Virus, Mikroba, Jamur)">Faktor biologis (Bakteri, Virus, Mikroba, Jamur)</option>
                                                <option value="Jenis Insiden lain yang tidak disebutkan diatas:  *Free Text*">Jenis Insiden lain yang tidak disebutkan diatas:  *Free Text*</option>
                                            </select>
                                            <div x-show="$wire.show_jenis_insiden2" class="mt-2">
                                                <input type="text" class="form-control" placeholder="Jenis Insiden lain yang tidak disebutkan diatas:  *Free Text*" wire:model="jenis_insiden2">
                                            </div>
                                        </div>
                                            @error('jenis_insiden')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror -->
                                        
                                        <!-- <div class="col-md-12 form-group">
                                            <label>Nik dan Nama</label>
                                            <input type="text" class="form-control" wire:model="nikdannama" >
                                            @error('nikdannama')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div> -->
                                    </div>
                                </div>
                                
                                <div class="col-md-12 form-group">
                                    <hr />
                                    <!-- <a href="{{route('accident-report.index')}}" class="mr-2"><i class="fa fa-arrow-left"></i> {{ __('Back') }}</a> -->
                                    <button type="submit" class="btn btn-info close-modal"><i class="fa fa-edit"></i> Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>