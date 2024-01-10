<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <style>
            table {
                border-collapse: collapse;
                width: 100%;
                font-size: 14px;
                margin-top: 10px;
            }
            .left {
                float: left;
            }
            td.w-10 {
                width: 10%;
            }
            td.w-40 {
                width: 40%;
            }
            td.w-100 {
                width: 100%;
            }
            td.w-33 {
                width: 33%;
            }
            table,
            td,
            th {
                border: 2px solid #000;
            }
            th {
                font-weight: normal;
                text-align: center;
                padding: 5px 5px 0px 5px;
                background-repeat: repeat-x;
                height: 25px;
                font-size: 16px;
                font-weight: bold;
                border: 1px solid #000;
            }
            td {
                padding: 16px 3px 3px 3px;
                border: 1px solid #000;
            }
            @frame footer {
                -pdf-frame-content: footerContent;
                bottom: 2cm;
                margin-left: 1cm;
                margin-right: 1cm;

                border: none !important;
            }
        </style>
    </head>
    <body>
        <div class="row">
            <div class="col-12">
    {{--            <img src="LOGO" align="left" height="100" width="300"/>--}}
                <h3 class="text-center po" align='center' style='text-transform: uppercase; font-weight: bolder; color:#887d7d; margin-top: 130px;clear: both;'>Tax Invoice</h3>
                <br>
                <div class="col-lg-8 col-md-8 "></div>
                <div class="col-lg-4 col-md-4">
                    <table style="width:100%;" align='right'>
                        <tr>
                            <td>Invoice No: &nbsp;</td>
                            <td><span class="editcontent">123344</span></td>
                        </tr>
                        <tr>
                            <td> Booking Date: &nbsp;</td>
                            <td><span class="editcontent">12/12/20XX</span></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th align="left" style=" border: 1px solid;">Customer Info&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <td>{!! $customer_detail->customer_name !!}<br><br>GST:{!! $customer_detail->customer_gst_number !!}<br>Mobile:{!! $customer_detail->customer_phone !!}<br>Address {!! $customer_detail->customer_address !!}<br></td>
                </tr>
            </tbody>
        </table>

        <table class="table table-bordered" style=" border: 1px solid;">
            <thead>
                <tr style="text-align: center; border: 1px solid;">
                    <th style="text-align: center;">#</th>
                    <th style="width: 25%" style="text-align: center;">
                        Product Code
                    </th>
                    <th style="text-align: center;">Qty</th>
                    <th style="text-align: center;">No. Days</th>
                    <th style="text-align: center;">Unit Price</th>
                    <th style="text-align: center;">Total Price</th>
                </tr>
            </thead>

            <tbody>
                @foreach($quotation_data as $single_quotation_data)
                    <tr style="text-align: center;">
                        <td>{!! $single_quotation_data['id'] !!}</td>
                        <td>{!! $single_quotation_data['product_code'] !!}</td>
                        <td>{!! $single_quotation_data['quantity'] !!}</td>
                        <td>{!! $quotation_detail_data->delivery_parts_service !!}</td>
                        <td>{!! $single_quotation_data['unit_price_in_inr'] !!}</td>
                        <td>{!! $single_quotation_data['total_price_in_inr'] !!}</td>
                    </tr>
                @endforeach

                <tr>
                    <td></td>
                    <td>***No item(s) exists after this line***</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="4"></td>
                    <td>Sub Total</td>
                    <td>3000</td>
                </tr>
                <tr>
                    <td colspan="4"></td>
                    <td>GST (18%)</td>
                    <td>360</td>
                </tr>
                <tr>
                    <td colspan="4"></td>
                    <td>Total With GST</td>
                    <td>3600</td>
                </tr>
                <tr>
                    <td colspan="4"></td>
                    <td>Advance Amount</td>
                    <td>2000</td>
                </tr>
                <tr>
                    <td colspan="4"></td>
                    <td>Due Amount</td>
                    <td>1360</td>
                </tr>
            </tbody>
        </table>
{{--        <table class="table">--}}
{{--            <thead>--}}
{{--                <tr>--}}
{{--                    <th align="left" style="width: 50%">Company Details--}}
{{--                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;--}}
{{--                    </th>--}}
{{--                    <th align="left" style="width: 50%">Authorised Signatory--}}
{{--                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;--}}
{{--                    </th>--}}
{{--                </tr>--}}
{{--            </thead>--}}
{{--            <tbody>--}}
{{--                <tr>--}}
{{--                    <td>Free Online Projects <br/>--}}
{{--                        HSDFC, XXXXXXXX<br/>--}}
{{--                        Current A/c no : 5555XXXXXX<br/>--}}
{{--                        IFSC CODE : HDFCXXXXXXX<br/>--}}
{{--                        GST : SSSSXXXXXXX<br/>--}}
{{--                        PAN : SSSCCCXXXXX :<br/>--}}
{{--                    </td>--}}
{{--                    <td>My Customer<br></td>--}}
{{--                </tr>--}}
{{--            </tbody>--}}
{{--        </table>--}}
    </body>
</html>
