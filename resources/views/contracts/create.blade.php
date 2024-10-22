@extends('layouts.app')
@section('title', 'Contact')
@section('style')

@endsection
@section('content')

<!-- Content Header (Page header) -->
<div class="page-header">
    <div class="row align-items-end">
        <div class="col-lg-8">
            <div class="page-header-title">
                <div class="d-inline">
                    <h4 class="test">New AMC Contract</h4>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="page-header-breadcrumb">
                <ul class="breadcrumb-title">
                    <li class="breadcrumb-item">
                        <a href="/home"> <i class="feather icon-home"></i> </a>
                    </li>
                    <li class="breadcrumb-item"><a href="{{route('contact.index')}}">Contracts</a> </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- /.content-header -->

<div class="page-body">
    <div class="container-fluid">
        <form action="{{route('amc-contracts.store')}}" method="post">
            @csrf
            <div class="card mb-2">
                <div class="card-body text-dark">
                    <h6><b>Contact Information</b></h6><br>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="ref_no">Referance No.</label>
                                <input type="text" placeholder="" name="ref_no" class="form-control" id="ref_no" value="{{ $refNo ?? '0000' }}" readonly>
                                @if ($errors->has('ref_no')) <p class="help-block">{{ $errors->first('ref_no') }}</p> @endif
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="type">Contract Type</label>
                                <select name="type" id="type" class="form-control">
                                    <option value="comp" {{ old('type') == 'comp' ? 'selected' : '' }} >Comprehensive</option>
                                    <option value="non_comp" {{ old('type') == 'non_comp' ? 'selected' : '' }}>Non Comprehensive</option>
                                </select>
                                @if ($errors->has('type')) <p class="help-block">{{ $errors->first('type') }}</p> @endif
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="location">Location</label>
                                <input type="text" class="form-control" value="{{ old('location') }}" placeholder="Location" name="location">
                                @if ($errors->has('location')) <p class="help-block">{{ $errors->first('location') }}</p> @endif
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="account">Account</label>
                            <span class="text-danger"></span>
                            <div class="form-group">
                                <select name="account_id" id="search-account" class="form-control" >
                                </select>
                                <div class="wrapper" id="wrp" style="display: none;">
                                    <a href="javascript:void(0);" id="account" class="font-weight-300" onclick="openAccountForm();">+ Add New Account</a>
                                </div>

                            @if ($errors->has('account_id')) <p class="text-danger">{{ $errors->first('account_id') }}</p> @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mb-2">
                <div class="card-header">
                    <div class="card-title">
                        <h5>Contract Terms & Conditions</h5>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12" id="comprehensive">
                            <label for="">Comprehensive</label>
                            <textarea name="terms_cond" class="form-control" id="comp-terms" cols="40" rows="20">
                                {{ old('terms_cond') }}
                            </textarea>
                        </div>

                    </div>
                </div>
            </div>
            <div class="card mb-2">
                <div class="card-header">
                    <div class="card-title">
                        <h5>Authority Details</h5>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <h6>Company Authorized Signatory Details</h6><hr>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="own_auth_sign_name">Authority Name </label>
                                <input id="own_auth_sign_name" value="{{ old('own_auth_sign_name') }}" placeholder="Name" class="form-control" type="text" name="own_auth_sign_name">
                                @if ($errors->has('own_auth_sign_name')) <p class="text-danger">{{ $errors->first('own_auth_sign_name') }}</p> @endif
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="own_auth_sign_desn">Authority Designation </label>
                                <input id="own_auth_sign_desn" class="form-control" value="{{ old('own_auth_sign_desn') }}" placeholder="Designation" type="text" name="own_auth_sign_desn">
                                @if ($errors->has('own_auth_sign_desn')) <p class="text-danger">{{ $errors->first('own_auth_sign_desn') }}</p> @endif
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="own_auth_sign_mobile">Authority Contact No </label>
                                <input id="own_auth_sign_mobile" placeholder="Contact No" value="{{ old('own_auth_sign_mobile') }}" class="form-control" type="text" name="own_auth_sign_mobile">
                                @if ($errors->has('own_auth_sign_mobile')) <p class="text-danger">{{ $errors->first('own_auth_sign_mobile') }}</p> @endif
                            </div>
                        </div>

                        <div class="col-md-12">
                            <h6> Customer's Authorized Signatory Details</h6><hr>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="cust_auth_sign_name">Authority Name </label>
                                <input id="cust_auth_sign_name" placeholder="Name" class="form-control" value="{{ old('cust_auth_sign_name') }}" type="text" name="cust_auth_sign_name">
                                @if ($errors->has('cust_auth_sign_name')) <p class="text-danger">{{ $errors->first('cust_auth_sign_name') }}</p> @endif
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="cust_auth_sign_desn">Authority Designation </label>
                                <input id="cust_auth_sign_desn" class="form-control" placeholder="Designation" type="text" value="{{ old('cust_auth_sign_desn') }}" name="cust_auth_sign_desn">
                                @if ($errors->has('cust_auth_sign_desn')) <p class="text-danger">{{ $errors->first('cust_auth_sign_desn') }}</p> @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mb-2">
                <div class="card-header">
                    <div class="card-title">
                        <h5>ANNEXURE A Details</h5>
                    </div>
                </div>
                <div class="card-body">
                    <div id="product-item" class="demo-wrap">
                        <div class="row toclone">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="product_items">Product Description</label>
                                    <input id="product_items" class="form-control" type="text" name="product_items[]" value="{{ old('product_items.0') }}" placeholder="Product Description" >
                                    @if ($errors->has('product_items.0')) <p class="text-danger">{{ $errors->first('product_items.0') }}</p> @endif
                                </div>
                            </div>
                            <div class="col-sm-3 cost">
                                <div class="form-group ">
                                    <label for="hsn">HSN CODE</label>
                                    <input id="hsn" class="form-control cpu" type="text" name="hsn[]" value="{{ old('hsn.0') }}" placeholder="HSN Code">
                                    @if ($errors->has('hsn.0')) <p class="text-danger">{{ $errors->first('hsn.0') }}</p> @endif
                                </div>
                            </div>
                            <div class="col-sm-3 cost">
                                <div class="form-group ">
                                    <label for="rating">Rating/Capacity</label>
                                    <input id="rating" class="form-control cpu" type="text" name="rating[]" value="{{ old('rating.0') }}" placeholder="Rating or Capacity">
                                    @if ($errors->has('rating.0')) <p class="text-danger">{{ $errors->first('rating.0') }}</p> @endif
                                </div>
                            </div>

                            <div class="col-sm-3 cost">
                                <div class="form-group ">
                                    <label for="sr_no">Sr. No</label>
                                    <input id="sr_no" class="form-control cpu" type="text" name="sr_no[]" value="{{ old('sr_no.0') }}" placeholder="Sr. No.">
                                    @if ($errors->has('sr_no.0')) <p class="text-danger">{{ $errors->first('sr_no.0') }}</p> @endif
                                </div>
                            </div>
                            <div class="col-sm-2 qty">
                                <div class="form-group">
                                    <label for="rate">Rate</label>
                                    <input id="cost_per_unit" class="form-control" type="text" name="cost_per_unit[]" value="{{ old('cost_per_unit.0') }}"  placeholder="cost_per_unit" onkeyup="getId(this)">
                                    @if ($errors->has('cost_per_unit.0')) <p class="text-danger">{{ $errors->first('cost_per_unit.0') }}</p> @endif
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label for="qty">Qty</label>
                                    <input id="quantity" class="form-control" type="text" name="quantity[]" value="{{ old('quantity.0') }}"  placeholder="quantity" onkeyup="getId(this)">
                                    @if ($errors->has('quantity.0')) <p class="text-danger">{{ $errors->first('quantity.0') }}</p> @endif
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label for="amount">Amount</label>
                                    <input id="total_cost" class="form-control" type="text" name="total_cost[]" value="{{ old('total_cost.0') }}"  placeholder="total_cost" readonly>
                                    @if ($errors->has('total_cost.0')) <p class="text-danger">{{ $errors->first('total_cost.0') }}</p> @endif
                                </div>
                            </div>
                            {{-- <div class="col-sm-2"> --}}
                                <a href="#" class="clone pt-4"><i class="fa fa-plus"></i> </a>
                                <a href="#" class="delete mx-2 pt-4"><i class="fa fa-minus"></i></a>
                            {{-- </div> --}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <h5>Other Terms & Conditions</h5>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="taxes">Taxes</label>
                                <input id="taxes" placeholder="Taxes" class="form-control" value="{{ old('taxes') }}" type="text" name="taxes">
                                @if ($errors->has('taxes')) <p class="text-danger">{{ $errors->first('taxes') }}</p> @endif
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="payment">Payment Terms</label>
                                <input id="payment" placeholder="Payment Terms" class="form-control" value="{{ old('payment') }}" type="text" name="payment">
                                @if ($errors->has('payment')) <p class="text-danger">{{ $errors->first('payment') }}</p> @endif
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="validity">Validity of Offer</label>
                                <input id="validity" placeholder="In days" class="form-control" value="{{ old('validity') }}" type="text" name="validity">
                                @if ($errors->has('validity')) <p class="text-danger">{{ $errors->first('validity') }}</p> @endif
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="contract_start">Contract Start Date</label>
                                <input id="contract_start" placeholder="Contract Start Date" class="form-control datepicker" value="{{ old('contract_start') }}" type="text" name="contract_start">
                                @if ($errors->has('contract_start')) <p class="text-danger">{{ $errors->first('contract_start') }}</p> @endif
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="contract_end">Contract End Date</label>
                                <input id="contract_end" placeholder="Contract End Date" class="form-control datepicker" value="{{ old('contract_end') }}" type="text" name="contract_end">
                                @if ($errors->has('contract_end')) <p class="text-danger">{{ $errors->first('contract_end') }}</p> @endif
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-primary float-right btn-sm">Submit</button>
                            <a href="{{ route('amc-contracts.index') }}" class="btn btn-sm btn-secondary float-right m-r-5">Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
{{-- @include('shared._create_account') --}}

@endsection
@section('scripts')
<script src="//cdn.ckeditor.com/4.13.0/standard/ckeditor.js"></script>
<script>
CKEDITOR.replace('comp-terms', {
      uiColor: '#CCEAEE'
    });
// CKEDITOR.replace('non-comp-terms', {
//     uiColor: '#CCEAEE'
// });

</script>
    <script>
$(document).ready(function () {
    var flg = 0;
    $('#search-account').on("select2:open", function () {
        flg++;
        if (flg == 1) {
            $this_html = jQuery('#wrp').html();
            $(".select2-results").append("<div class='select2-results__option'>" + $this_html + "</div>");
        }
    });

    var type = $('#type');
    var compTerms = $('#comp-terms');
    var editor = CKEDITOR.instances['comp-terms'];
    var compData = "<p>1.The contract pertains to the breakdown as well as preventive maintenance of the said systems installed at the customer&rsquo;s location. The contract will commence on the Date of PO and shall be valid for the same period.</p><p>&nbsp;</p><p>2. The Annual Maintenance Contract amount for the said period 100% amount including Tax will be paid by the &Customer along with Order.</p><p>&nbsp;</p><p>3. The contract pertains only to the maintenance of UPS systems as per Annexure A and will not include accessories like batteries, cables etc.</p><p>&nbsp;</p><p>4. Cost of Spares excluding batteries, power transformer, chokes, capacitors, semiconductor devices, switchgears will be borne by Power Vision.</p><p>&nbsp;</p><p>5. Customer should ensure periodical maintenance of batteries, which is essential for the satisfactory working of the UPS Systems.</p><p>&nbsp;</p><p>6. M/s. Power Vision engineer will visit the customer quarterly during the contract period for the preventive maintenance checkup,And also whenever There is service call from the customer.</p><p>&nbsp;</p><p>7. Barring unforeseen circumstances, best efforts will be made by Power Vision to attend the fault within 24 hours of the receipt of complaint on Working days.</p><p>&nbsp;</p><p>8. &nbsp;The customer will permit complete access to the system if necessary even after working hours and on a holiday to enable Power Vision to meet the Obligations of the contract during their visit.</p><p>&nbsp;</p><p>9. M/s power Vision will not be liable at any time for any damage which occurs to the systems as a result of misuse, alterations, Additions, modifications of any sort made to it without prior written consent from M/s Power Vision.</p><p>&nbsp;</p><p>10. M/s Power Vision will not be liable at any time for any damage, which occurs to the system as a result of transfer of the system by the customer to Another location/ premises without the approval of M/s Power Vision or assistance of M/s Power Vision engineer in this respect.</p><p>&nbsp;</p><p>11. M/s Power Vision will not be liable to meet its obligations under the maintenance contract in the event of natural disasters like fire, storm, flood, Earthquake, explosion, strikes, lockouts, industrial disputes, civil commotion, riots, war, accidents etc.</p><p>&nbsp;</p><p>12. M/s Power Vision will not be liable at any time for any damages occurs in the UPS systems due to ageing effects of active and passive components and cables resulted in the short circuit or fire in the UPS systems.</p><p>&nbsp;</p><p>13. The contract will be considered null and void if the customer permits third party to undertake repair/ servicing etc. unless prior consent has been Obtained from M/s Power Vision to this effect in writing.</p><p>&nbsp;</p><p>14. The customer may terminate this contract at any time by informing M/s Power Vision if their intention to do so. However no entitlement for&nbsp;refund or compensation will be accrue to the customer for the unutilized portion of the contract period.</p><p>&nbsp;</p><p>15. In case the maintenance contract is not renewed before the expiry period, M/s power Vision shall first ensure that the systems are fully operational before & entering into the new maintenance agreement. If the system is not operational, then it will be the responsibility of the customer to pay the actual repair cost & quoted by M/s Power Vision before the fresh annual maintenance contract commences.</p><p>&nbsp;</p><p>16. Power Vision&rsquo;s liability is restricted to maintenance and satisfactory working of UPS systems only and it excludes other liabilities including &Consequential damages.</p>"


    var nonCompData = "<p>1.The contract pertains to the breakdown as well as preventive maintenance of the said systems installed at the customer&rsquo;s location. The contract will commence on the Date of PO and shall be valid for the same period.</p><p>2. The Annual Maintenance Contract amount for the said period 100% amount including Tax will be paid by the &Customer along with Order.</p><p>3. The contract pertains only to the maintenance of UPS systems as per Annexure A and will not include accessories like batteries, cables etc.</p><p>4. Cost of Spares excluding batteries, power transformer, chokes, capacitors, semiconductor devices, switchgears will be borne by Power Vision.</p><p>5. Customer should ensure periodical maintenance of batteries, which is essential for the satisfactory working of the UPS Systems.</p><p>6. M/s. Power Vision engineer will visit the customer quarterly during the contract period for the preventive maintenance checkup,And also whenever There is service call from the customer.</p><p>7. Barring unforeseen circumstances, best efforts will be made by Power Vision to attend the fault within 24 hours of the receipt of complaint on Working days.</p><p>8. &nbsp;The customer will permit complete access to the system if necessary even after working hours and on a holiday to enable Power Vision to meet the Obligations of the contract during their visit.</p><p>9. M/s power Vision will not be liable at any time for any damage which occurs to the systems as a result of misuse, alterations, Additions, modifications of any sort made to it without prior written consent from M/s Power Vision.</p><p>10. M/s Power Vision will not be liable at any time for any damage, which occurs to the system as a result of transfer of the system by the customer to Another location/ premises without the approval of M/s Power Vision or assistance of M/s Power Vision engineer in this respect.</p><p>11. M/s Power Vision will not be liable to meet its obligations under the maintenance contract in the event of natural disasters like fire, storm, flood, Earthquake, explosion, strikes, lockouts, industrial disputes, civil commotion, riots, war, accidents etc.</p><p>12. M/s Power Vision will not be liable at any time for any damages occurs in the UPS systems due to ageing effects of active and passive components and cables resulted in the short circuit or fire in the UPS systems.</p><p>13. The contract will be considered null and void if the customer permits third party to undertake repair/ servicing etc. unless prior consent has been Obtained from M/s Power Vision to this effect in writing.</p><p>14. The customer may terminate this contract at any time by informing M/s Power Vision if their intention to do so. However no entitlement for&nbsp;refund or compensation will be accrue to the customer for the unutilized portion of the contract period.</p><p>15. In case the maintenance contract is not renewed before the expiry period, M/s power Vision shall first ensure that the systems are fully operational before & entering into the new maintenance agreement. If the system is not operational, then it will be the responsibility of the customer to pay the actual repair cost & quoted by M/s Power Vision before the fresh annual maintenance contract commences.</p><p>16. Power Vision&rsquo;s liability is restricted to maintenance and satisfactory working of UPS systems only and it excludes other liabilities including &Consequential damages.</p>"

    if (type.val() == 'non_comp') {
            editor.setData(nonCompData);
        }else{
            editor.setData(compData);
        }

    type.on('change', function(){
        var value = $(this).val();
        if (value == 'non_comp') {
            editor.setData(nonCompData);
        }else{
            editor.setData(compData);
        }
    })


});
    </script>

@endsection
