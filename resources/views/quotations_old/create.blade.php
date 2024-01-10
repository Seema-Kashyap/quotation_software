@extends('layout.app')
@section('content')

    <a class="btn btn-primary" id="" href="javascript:void(0);" data-toggle="tooltip"
       title="Create">Add Customer</a>


    {{--    <a id="purchase_quote" href="javascript:void(0);" data-toggle="tooltip"--}}
    {{--       title="Create">File Upload</a>--}}

    <form id="myForm" action="{{ route('quotations.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="file" name="purchase_quotes_image" id="purchase_quote" class="btn btn-primary" multiple>
        <input type="button" id="purchase_quotes_image_upload" class="btn btn-primary" value="upload">
        <textarea class="form-group" name="purchase_quotes_text" id="purchase_quotes_text"></textarea>
        <div class="table-responsive">
            <table class="table table-bordered" id="quotations">
                <thead>
                <tr>
                    <th class="text-center">Sr No</th>
                    <th class="text-center">HSN Code</th>
                    <th class="text-center">Product Code</th>
                    <th class="text-center">Material Description</th>
                    <th class="text-center">Quantity</th>
                    <th class="text-center">UOM</th>
                    <th class="text-center">List Price</th>
                    <th class="text-center">Discount</th>
                    <th class="text-center">Unit Cost in INR</th>
                    <th class="text-center">Factor</th>
                    <th class="text-center">Unit Price in INR</th>
                    <th class="text-center">Total Cost in INR</th>
                    <th class="text-center">Total Price in INR</th>
                    <th class="text-center">Profit</th>
                    <th class="text-center">Action</th>
                </tr>
                </thead>
                <tbody id="tbody">
                <tr id="add-row-0">
                    <td class="row-index text-center" id="id-0">0</td>
                    <td class="row-index text-center hsn_search" contenteditable="true" id="hsn_code-0"></td>
                    <td class="row-index text-center" contenteditable="true" id="product_code-0"></td>
                    <td class="row-index text-center" contenteditable="true" id="material_description-0"></td>
                    <td class="row-index text-center allownumeric quantities" contenteditable="true"
                        id="quantity-0"></td>
                    <td class="row-index text-center" contenteditable="true" id="oum-0"></td>
                    <td class="row-index text-center allowdecimal" contenteditable="true" id="list_price-0"></td>
                    <td class="row-index text-center allowdecimal" contenteditable="true" id="discount-0"></td>
                    <td class="row-index text-center allowdecimal unit_cost_in_inrs" contenteditable="true"
                        id="unit_cost_in_inr-0"></td>
                    <td class="row-index text-center allowdecimal factors" contenteditable="true" id="factor-0"></td>
                    <td class="row-index text-center allowdecimal unit_price_in_inrs" contenteditable="true"
                        id="unit_price_in_inr-0"></td>
                    <td class="row-index text-center total_cost_in_inrs" id="total_cost_in_inr-0"></td>
                    <td class="row-index text-center total_price_in_inrs" id="total_price_in_inr-0"></td>
                    <td class="row-index text-center profits" id="profit-0"></td>
                    <td class="row-index text-center add-row" id="change_button-0">
                        <a href="javascript:void(0);" class="btn btn-info add_button" id="row-0">+</a>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        <ul>
            <li>sub total <span id="subtotal"></span> | <span id="totalPriceINR"></span> | <span id="profit"></span> |
            </li>
            <li>discount on basic amount 3% <span id="discount"></span></li>
            <li>sub total in figure in inr <span id="subtotalfigure"></span></li>
            <li>gst applicable
                <select name="gst">
                    <option>5</option>
                    <option>10</option>
                    <option>15</option>
                </select>
                :
                <span id="subtotal"></span>
            </li>
            <li>total amount <span id="totalmaount"></span></li>
        </ul>

        <ul id="array_files">
        </ul>
        <input type="submit" class="btn btn-success" value="Submit">
    </form>

    <div id="image-list"></div>

@stop

@section('js')
    <script>


        // $("#purchase_quote").change(function() {
        //     var filename = $(this).val().split('\\').pop(); // Get the selected file name
        //     var fileLink = window.URL.createObjectURL(this.files[0]); // Create a URL for the selected file
        //
        //     // Display the file name as a link
        //     $("#image-info").html('<p>Selected Image: <a href="' + fileLink + '" target="_blank" id="image-link">' + filename + '</a></p>');
        // });

        // let filArray = [];
        var selectedImages = [];

        $(document).on('click', '#purchase_quotes_image_upload', function () {
            var fileInput = $("#purchase_quote");
            var filename = fileInput.val().split('\\').pop(); // Get the selected file name
            var fileLink = window.URL.createObjectURL(fileInput[0].files[0]); // Create a URL for the selected file

            // Add the image information to the array
            selectedImages.push({ name: filename, link: fileLink });

            // Display the image name and link
            $("#image-list").append('<p><a href="' + fileLink + '" target="_blank">' + filename + '</a></p>');

            // Clear the file input for the next selection
            fileInput.val('');

            // for (var i = 0; i < upload.files.length; i++) {
            //     // var filename = upload.files[i].name; // Get the selected file name
            //     // var fileLink = window.URL.createObjectURL(upload.files[i]); // Create a URL for the selected file
            //     //
            //     // // Display the file name as a link to view the image in a new tab
            //     // $("#image-info").append('<p><a href="' + fileLink + '" target="_blank">' + filename + '</a></p>');
            //
            //     var filename = upload.files[i].name;
            //     var fileLink = window.URL.createObjectURL(upload.files[i]);
            //
            //     var imageLink = $('<a>', {
            //         text: filename,
            //         href: fileLink,
            //         target: "_blank"
            //     });
            //
            //     $("#image-info").append($('<p>').append(imageLink));
            //
            // }



            // var file_name = $('#purchase_quote').val().replace(/.*(\/|\\)/, '');
            // var purchase_quote_text = $('#purchase_quotes_text').val();
            //
            // filArray.push(upload.files[0]);
            // var file_path = $('#purchase_quote').val();
            // if(file_name && purchase_quote_text) {
            //     var file_html = "<li>"+file_name+"<ul><li>"+purchase_quote_text+"</li></ul></li>";
            //     $("#array_files").append(file_html);
            //     // $("<input>")
            //     //     .attr("type", "hidden")
            //     //     .attr("name", "purchase_quotes_image[]")
            //     //     .val(file_name)
            //     //     .append("#myForm");
            //     //
            //     // $("<input>")
            //     //     .attr("type", "hidden")
            //     //     .attr("name", "purchase_quotes_text[]")
            //     //     .val(purchase_quote_text)
            //     //     .append("#myForm");
            // }
        });
        // $(document).on('change', '#purchase_quote', function () {
        // const file = this.files[0];
        // if (file) {
        //     const reader = new FileReader();
        //     var file_html = '';
        //     reader.onload = function (event) {
        //         // file_html += `<li><a href="${event.target.result}">${reader.fileName}</a></li>`;
        //         // console.log(reader.fileName); // file name
        //         // console.log(file_html); // file name
        //         // $("#array_files").append(file_html);
        //     };
        //     // set file name for reader;
        //     reader.fileName = file.name;
        //
        //     // Read the file
        //     reader.readAsDataURL(file);
        // }
        // });

        $(document).on('click', '.add_button', function () {
            var id = $(this).attr('id').split('-')[1];
            if (id) {
                $('#change_button-' + id).html('');
                $('#change_button-' + id).html('<a href="javascript:void(0);" class="btn btn-danger remove_button" id="row-' + id + '">-</a>')
                id++;
                $('#tbody').append(
                    '<tr id="add-row-' + id + '">' +
                    '<td class="row-index text-center" id="id-' + id + '">' + id + '</td>' +
                    '<td class="row-index text-center hsn_search" contenteditable="true" id="hsn_code-' + id + '"></td>' +
                    '<td class="row-index text-center" contenteditable="true" id="product_code-' + id + '"></td>' +
                    '<td class="row-index text-center" contenteditable="true" id="material_description-' + id + '"></td>' +
                    '<td class="row-index text-center allownumeric quantities" contenteditable="true" id="quantity-' + id + '"></td>' +
                    '<td class="row-index text-center" contenteditable="true" id="oum-' + id + '"></td>' +
                    '<td class="row-index text-center allowdecimal" contenteditable="true" id="list_price-' + id + '"></td>' +
                    '<td class="row-index text-center allowdecimal discounts" contenteditable="true" id="discount-' + id + '"></td>' +
                    '<td class="row-index text-center allowdecimal unit_cost_in_inrs" contenteditable="true" id="unit_cost_in_inr-' + id + '"></td>' +
                    '<td class="row-index text-center allowdecimal factors" contenteditable="true" id="factor-' + id + '"></td>' +
                    '<td class="row-index text-center allowdecimal unit_price_in_inrs" contenteditable="true" id="unit_price_in_inr-' + id + '"></td>' +
                    '<td class="row-index text-center total_cost_in_inrs" id="total_cost_in_inr-' + id + '"></td>' +
                    '<td class="row-index text-center total_price_in_inrs" id="total_price_in_inr-' + id + '"></td>' +
                    '<td class="row-index text-center profits" id="profit-' + id + '"></td>' +
                    '<td class="row-index text-center add-row" id="change_button-' + id + '">' +
                    '<a href="javascript:void(0);" class="btn btn-info add_button" id="row-' + id + '">+</a>' +
                    '</td>'
                );
                calculateSubTotal();
                calculateTotalPriceINR();
                calculateTotalProfits();
            } else {
                alert('There is some error please try again!');
            }
        });

        $("#myForm").submit(function (event) {
            event.preventDefault(); // Prevent the default form submission
            var jsonImages = JSON.stringify(selectedImages);
            console.log(jsonImages);
            console.log('jsonImages');
            $("#myForm").append('<input type="hidden" name="images" value="'+jsonImages+'">');
            // $("<input>").attr({
            //     type: "hidden",
            //     name: "images",
            //     value: jsonImages
            // }).appendTo($(this));


            // var formData = new FormData(this);
            // var uploadedFiles = $("#purchase_quote")[0].files;

            // var file_data = $('#poster').prop('files')[0];
            // console.log(filArray)
            // // var form = $('#myForm')[0];
            // var formData = new FormData();
            // for (var i = 0; i < filArray.length; i++) {
            //     var file = filArray[i];
            //     console.log(file.name);
            //     $("#myForm").append('file', file);//
            //     // $("<input>")
            //     //     .attr("type", "hidden")
            //     //     .attr("name", "purchase_quotes_image[]")
            //     //     .val(file)
            //     //     .appendTo("#myForm");
            //     // formData.append("purchase_quotes_imagess[]", file);
            // }

            // Create an empty array to store cell values
            var cellValues = [];

            // Loop through each table row
            $("#quotations tr").each(function () {
                var rowValues = [];

                // Loop through each cell in the row
                $(this).find("td").each(function () {
                    // Push the cell's text content to the rowValues array
                    rowValues.push($(this).text());
                });

                // Push the rowValues array to the cellValues array
                cellValues.push(rowValues);
            });

            // Convert the cellValues array to a JSON string
            var jsonData = JSON.stringify(cellValues);

            // Create a hidden input field to hold the JSON data
            $("#myForm").append('<input type="hidden" name="cellValues" value="'+jsonData+'">');
            // $("<input>")
            //     .attr("type", "hidden")
            //     .attr("name", "cellValues")
            //     .val(jsonData)
            //     .appendTo("#myForm");



            // Submit the form with the hidden input
            $("#myForm").unbind("submit").submit();
        });

        $(document).on('keyup', '.hsn_search', function () {
            var id = $(this).attr('id').split('-')[1];
            var hsn_code = $(this).text().trim();

            if (hsn_code) {
                $.ajax({
                    url: '{{ route('quotations.search_hsn') }}',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        '_token': '{{ csrf_token() }}', hsn_code: hsn_code,
                    },
                    success: function (response) {
                        console.log(response.status);
                        if (response.status) {
                            calculateSubTotal();
                            calculateTotalPriceINR();
                            calculateTotalProfits();
                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        if (jqXHR.status == 500) {
                            alert('Internal error: ' + jqXHR.responseText);
                        } else {
                            alert('There is some error.');
                        }
                    }
                });
            }
        });

        $(document).on('keyup', '.total_cost_in_inrs', function () {
            calculateSubTotal();
        })

        ;$(document).on('keyup', '.profits', function () {
            calculateTotalProfits();
        });

        $(document).on('keyup', '.total_price_in_inrs', function () {
            calculateTotalPriceINR();
        });

        $(document).on('keyup change', '.unit_price_in_inrs', function () {
            var get_id = $(this).attr('id').split('-')[1];
            var unit_price_in_inrs_value = $(this).text();
            var get_quantity = $('#quantity-' + get_id).text();

            var total_price_in_inr_table_row = parseFloat(get_quantity * unit_price_in_inrs_value);
            $('#total_price_in_inr-' + get_id).text(total_price_in_inr_table_row);

            calulateSingleProfit(get_id);
            calculateTotalProfits();
            calculateTotalPriceINR();
            calculateSubTotal();
        });

        $(document).on('keyup change', '.unit_cost_in_inrs', function () {
            var get_id = $(this).attr('id').split('-')[1];
            var unit_cost_in_inrs_value = $(this).text();
            var unit_cost_get_quantity = $('#quantity-' + get_id).text();

            var single_factor = $('#factor-' + get_id).text();
            $('#unit_price_in_inr-' + get_id).text(Math.round(parseFloat(unit_cost_in_inrs_value * single_factor)).toLocaleString('en-US'));

            var total_cost_in_inr_table_row = Math.round(parseFloat(unit_cost_get_quantity * unit_cost_in_inrs_value)).toLocaleString('en-US');
            $('#total_cost_in_inr-' + get_id).text(total_cost_in_inr_table_row);

            calulateSingleProfit(get_id);
            calculateTotalProfits();
            calculateTotalPriceINR();
            calculateSubTotal();
        });

        $(document).on('keyup', '.factors', function () {
            var factor_id = $(this).attr('id').split('-')[1];
            var single_factor = $(this).text();
            var unit_cost_in_inrs_value = $('#unit_cost_in_inr-' + factor_id).text();
            $('#unit_price_in_inr-' + factor_id).text(parseFloat(unit_cost_in_inrs_value * single_factor));
            var get_quantity = $('#quantity-' + factor_id).text();

            var unit_price_in_inrs_value = $('#unit_price_in_inr-' + factor_id).text();
            var total_price_in_inr_table_row = parseFloat(get_quantity * unit_price_in_inrs_value);
            $('#total_price_in_inr-' + factor_id).text(total_price_in_inr_table_row);

            calulateSingleProfit(factor_id);
            calculateTotalProfits();
            calculateTotalPriceINR();
            calculateSubTotal();
        });

        $(document).on('keyup', '.quantities', function () {
            var quantity_id = $(this).attr('id').split('-')[1];
            var single_quantity = $(this).text();

            var unit_cost_in_inrs_value = $('#unit_cost_in_inr-' + quantity_id).text();
            var total_cost_in_inr_table_row = Math.round(parseFloat(single_quantity * unit_cost_in_inrs_value)).toLocaleString('en-US');
            $('#total_cost_in_inr-' + quantity_id).text(total_cost_in_inr_table_row);

            var unit_price_in_inrs_value = $('#unit_price_in_inr-' + quantity_id).text();
            var total_price_in_inr_table_row = Math.round(parseFloat(single_quantity * unit_price_in_inrs_value)).toLocaleString('en-US');
            $('#total_price_in_inr-' + quantity_id).text(total_price_in_inr_table_row);

            calulateSingleProfit(quantity_id);
            calculateTotalProfits();
            calculateTotalPriceINR();
            calculateSubTotal();
        });

        calculateSubTotal();
        calculateTotalPriceINR();
        calculateTotalProfits();

        function calculateSubTotal() {
            var subtotal = 0;
            $('.total_cost_in_inrs').each(function () {
                if ($(this).text()) {
                    subtotal += parseFloat($(this).text());
                }
            });
            $('#subtotal').text(subtotal);
        }

        function calulateSingleProfit(id) {
            var unit_price = $('#unit_price_in_inr-' + id).text();
            var unit_cost = $('#unit_cost_in_inr-' + id).text();
            var single_row_profit = 0;
            if (unit_price && unit_cost) {
                var single_row_profit = parseFloat(unit_price - unit_cost);
            }
            $('#profit-' + id).text(single_row_profit);
        }

        function calculateTotalPriceINR() {
            var totalPriceINR = 0;
            $('.total_price_in_inrs').each(function () {
                if ($(this).text()) {
                    console.log($(this).text());
                    totalPriceINR += parseFloat($(this).text());
                    console.log(totalPriceINR);
                    console.log('totalPriceINR');
                }
            });
            $('#totalPriceINR').text(totalPriceINR);
        }

        function calculateTotalProfits() {
            var totalProfits = 0;
            $('.profits').each(function () {
                if ($(this).text()) {
                    totalProfits += parseFloat($(this).text());
                }
            });
            $('#profit').text(totalProfits);
        }

        $(document).on("keypress keyup blur", '.allowdecimal', function (event) {
            var $this = $(this);
            if ((event.which != 46 || $this.text().indexOf('.') != -1) &&
                ((event.which < 48 || event.which > 57) &&
                    (event.which != 0 && event.which != 8))) {
                event.preventDefault();
            }

            var text = $(this).text();
            if ((event.which == 46) && (text.indexOf('.') == -1)) {
                setTimeout(function () {
                    if ($this.text().substring($this.text().indexOf('.')).length > 3) {
                        $this.text($this.text().substring(0, $this.text().indexOf('.') + 3));
                    }
                }, 1);
            }

            if ((text.indexOf('.') != -1) &&
                (text.substring(text.indexOf('.')).length > 1) &&
                (event.which != 0 && event.which != 8) &&
                ($(this)[0].selectionStart >= text.length - 1)) {
                event.preventDefault();
            }
        });

        $(document).on("keypress keyup blur", '.allownumeric', function (event) {
            $(this).val($(this).val().replace(/[^\d].+/, ""));
            if ((event.which < 48 || event.which > 57)) {
                event.preventDefault();
            }
        });

        $(document).on("keypress keyup blur", '.allowstring', function (event) {
            $(this).val($(this).val().replace(/[^\w].+/, ""));
            if (!((event.which >= 65 && event.which < 92) ||
                (event.which >= 97 && event.which <= 122))) {
                event.preventDefault();
            }
        });

        $(document).bind("paste", '.allowdecimal,', function (e) {
            var text = e.originalEvent.clipboardData.getData('Text');
            if ($.isNumeric(text)) {
                if ((text.substring(text.indexOf('.')).length > 3) && (text.indexOf('.') > -1)) {
                    e.preventDefault();
                    $(this).val(text.substring(0, text.indexOf('.') + 3));
                }
            } else {
                e.preventDefault();
            }
        });

        // function getStyle(el, cssprop) {
        //     if (el.currentStyle)
        //         return el.currentStyle[cssprop];	 // IE
        //     else if (document.defaultView && document.defaultView.getComputedStyle)
        //         return document.defaultView.getComputedStyle(el, "")[cssprop];	// Firefox
        //     else
        //         return el.style[cssprop]; //try and get inline style
        // }

        // function applyEdit(tabID, editables) {
        //     var tab = document.getElementById(tabID);
        //     if (tab) {
        //         var rows = tab.getElementsByTagName("tr");
        //         for (var r = 0; r < rows.length; r++) {
        //             var tds = rows[r].getElementsByTagName("td");
        //             for (var c = 0; c < tds.length; c++) {
        //                 if (editables.indexOf(c) > -1)
        //                     tds[c].onclick = function () {
        //                         beginEdit(this,c);
        //                     };
        //             }
        //         }
        //     }
        // }

        // var oldColor, oldText, padTop, padBottom, firstNode = "";

        // function beginEdit(td, c) {
        //
        //     if (td.firstChild && td.firstChild.tagName == "INPUT")
        //         return;
        //
        //     oldText = td.innerHTML.trim();
        //     firstNode = td.firstChild;
        //     // oldColor = getStyle(td, "backgroundColor");
        //     // padTop = getStyle(td, "paddingTop");
        //     // padBottom = getStyle(td, "paddingBottom");
        //
        //     var input = document.createElement("input");
        //     input.value = oldText;
        //
        //     //// ------- input style -------
        //     // var left = getStyle(td, "paddingLeft").replace("px", "");
        //     // var right = getStyle(td, "paddingRight").replace("px", "");
        //     // input.style.width = td.offsetWidth - left - right - (td.clientLeft * 2) - 2 + "px";
        //     // input.style.height = td.offsetHeight - (td.clientTop * 2) - 2 + "px";
        //     // input.style.border = "0px";
        //     // input.style.fontFamily = "inherit";
        //     // input.style.fontSize = "inherit";
        //     // input.style.textAlign = "inherit";
        //     // input.style.backgroundColor = "LightGoldenRodYellow";
        //
        //     input.onblur = function () {
        //         endEdit(this);
        //     };
        //
        //     td.innerHTML = "";
        //     // td.style.paddingTop = "0px";
        //     // td.style.paddingBottom = "0px";
        //     // td.style.backgroundColor = "LightGoldenRodYellow";
        //     td.insertBefore(input, td.firstChild);
        //     input.select();
        // }
        //
        // function endEdit(input) {
        //     var td = input.parentNode;
        //     td.removeChild(td.firstChild);	//remove input
        //     td.innerHTML = input.value;
        //     var gettdid = td.id;
        //     console.log(gettdid)
        //     if(gettdid) {
        //         getTableDataByHSN(gettdid);
        //     }
        //     console.log(input.value)
        //     if (oldText != input.value.trim())
        //         td.style.color = "red";
        //
        //     td.style.paddingTop = padTop;
        //     td.style.paddingBottom = padBottom;
        //     td.style.backgroundColor = oldColor;
        //
        //     //added ajax for search for hsn
        // }
        //
        // applyEdit("quotations", [0,1]);
        //
        // function getTableDataByHSN(gettdid) {
        //
        // }


        // $(function () {
        //     $("td").click(function(event){
        //         if($(this).children("input").length > 0)
        //             return false;
        //
        //         var tdObj = $(this);
        //         var preText = tdObj.html();
        //         var inputObj = $("<input type='text' />");
        //         tdObj.html("");
        //
        //         inputObj.width(tdObj.width())
        //             .height(tdObj.height())
        //             .css({border:"0px",fontSize:"17px"})
        //             .val(preText)
        //             .appendTo(tdObj)
        //             .trigger("focus")
        //             .trigger("select");
        //
        //         inputObj.keyup(function(event){
        //             if(13 == event.which) { // press ENTER-key
        //                 var text = $(this).val();
        //                 tdObj.html(text);
        //             }
        //             else if(27 == event.which) {  // press ESC-key
        //                 tdObj.html(preText);
        //             }
        //         });
        //
        //         inputObj.click(function(){
        //             return false;
        //         });
        //     });
        // });

    </script>
@stop
