<div class="main-container ps-0 col-12">
    <h6 class="col-12 mx-3 text-end fst-italic lh-lg">Current Date: {{ \Carbon\Carbon::now()->format('m/d/Y') }}</h6>
    <div class="row">
        <div class="col-12 overflow-auto"style="height:280px;">
            <h4 class="mx-3" style="color:#F6F6E9;">Region Cases Data</h4>
            <div class="row gx-0">
                <div class="col-6 col-lg-3">
                    <div class="card mx-3 mt-0 mb-3" style="height: 14rem; background-color: #f6f6e9;">
                        <div class="card-body d-inline-grid justify-content-center" style="text-align:center;padding-top:50px;">
                            <div class="border border d-flex justify-content-center align-items-center mx-auto" style="width:68px;height:68px;border-radius:50%;background-color:#CEDAE0;">
                                <span class="iconify" data-icon="ic:outline-sick" style="color:#04297A;width:35px;height:35px;"></span>
                            </div>
                            <p class="card-text fw-bold" style="text-align:center;font-size:30px;padding-top:10px;margin-bottom:0;color:#04297A;">{{ $activeCases }}</p>
                            <h6 class="" style="text-align:center;color:#04297A;">Active Cases</h6>
                        </div>
                    </div>
                </div>

                <div class="col-6 col-lg-3">
                    <div class="card mx-3 mt-0 mb-3" style="height: 14rem; background-color: #f6f6e9;">
                        <div class="card-body d-inline-grid justify-content-center" style="text-align:center;padding-top:50px;">
                            <div class="border border d-flex justify-content-center align-items-center mx-auto" style="width:68px;height:68px;border-radius:50%;background-color:#C5E8B7;">
                                <span class="iconify" data-icon="fluent:accessibility-checkmark-24-regular" style="color:green;width:35px;height:35px;"></span>
                            </div>
                            <p class="card-text fw-bold" style="text-align:center;font-size:30px;padding-top:10px;margin-bottom:0;color:green;">{{ $recoveries }}</p>
                            
                            <h6 class="" style="text-align:center;color:green;">Recoveries</h6>
                        </div>
                    </div>
                </div>

                <div class="col-6 col-lg-3">
                    <div class="card mx-3 mt-0 mb-3" style="height: 14rem; background-color: #f6f6e9;">
                        <div class="card-body d-inline-grid justify-content-center" style="text-align:center;padding-top:50px;">
                            <div class="border border d-flex justify-content-center align-items-center mx-auto" style="width:68px;height:68px;border-radius:50%;background-color:#ECD3CC;">
                                <span class="iconify" data-icon="healthicons:coronary-care-unit-outline" style="color:#9B0D1C;width:35px;height:35px;"></span>
                            </div>
                            <p class="card-text fw-bold" style="text-align:center;font-size:30px;padding-top:10px;margin-bottom:0;color:#9B0D1C;">{{ $deaths }}</p>
                            <h6 class="" style="text-align:center;color:#9B0D1C;">Deaths</h6>
                        </div>
                    </div>
                </div>

                <br>
                                        
                <div class="col-6 col-lg-3">
                    <div class="card mx-3 mt-0 mb-3" style="height: 14rem;">
                        <div class="card-body d-inline-grid justify-content-center" style="text-align:center;padding-top:50px;">
                            <div class="border border d-flex justify-content-center align-items-center mx-auto" style="width:68px;height:68px;border-radius:50%;background-color:#E8E2FC;">
                                <span class="iconify" data-icon="clarity:list-solid-badged" style="color:#7908B8;width:35px;height:35px;"></span>
                            </div>
                            <p class="card-text fw-bold" style="text-align:center;font-size:30px;padding-top:10px;margin-bottom:0;color:#7908B8;">{{ $total }}</p>
                            <h6 class="" style="text-align:center;color:#7908B8;">Total Confirmed Cases</h6>
                        </div>
                    </div>
                </div>              
            </div>
        </div>
    </div>
    <div class="row">
        @include('statistics')
    </div>
    <div class="row mt-5 mx-2 pt-5">
        <div class="col-12">
        <h4 class="border-0 border-top border-3 border-white py-3 text-white">
        FILTER BELOW CITY/MUNICIPALITY CASES BY SELECTING PROVINCE</h4>
        </div>
        <div class="col-12">
            <select class="form-control" id="province_droplist">
                <!-- <option value="0">Select Province</option> -->
                <option value="" disabled selected>Select Province</option>
                <option value="">All</option>
                @foreach($provinces as $province => $value)
                    <option value="{{ $value->id }}">{{ $value->province }}</option>
                @endforeach

            </select>
        </div>
    </div>

    <div class="row gx-0 justify-content-center">
    <div class="row row-cols-2 row-cols-lg-6 g-2 g-lg-3" style="border-radius:50%;">
        <?php $prov = ''; ?>
        @foreach($location as $loc)
           <?php if ($prov != $loc->province) { ?>
                        <div class="col-12 all-barangays {{ strtolower(str_replace(' ', '-', $loc->province)) }}-barangays"><h2 style="color:#f6f6e9"> {{ $loc->province }}</h2></div>
                        
            <?php } ?>
                    <div class="col all-barangays {{ strtolower(str_replace(' ', '-', $loc->province)) }}-barangays">
                        <div class="p-3 border bg-light fw-bold" style="border-radius:5px;min-height:100px;background-color:red;">{{ $loc->locations_name }}:  {{ $loc->total_cases }}</div>
                    </div>
            <?php 
                $prov = $loc->province; 
            ?>
        @endforeach
        </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $( document ).ready(function() {
        $('#province_droplist').change(function() {
           const getProvinceID = $(this).val();
           console.log(getProvinceID);
           if(getProvinceID == 1)
           {
                $('.all-barangays').addClass('d-none');
                $('.cebu-barangays').removeClass('d-none');
           }
           else if(getProvinceID == 2) {
                $('.all-barangays').addClass('d-none');
                $('.bohol-barangays').removeClass('d-none');
           }
           else if(getProvinceID == 3) {
                $('.all-barangays').addClass('d-none');
                $('.siquijor-barangays').removeClass('d-none');
           }
           else if(getProvinceID == 4) {
                $('.all-barangays').addClass('d-none');
                $('.negros-oriental-barangays').removeClass('d-none');
           }
           else {
             $('.all-barangays').removeClass('d-none');
           }

        });
    });
</script>

