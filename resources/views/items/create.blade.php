<h4 class="modal-title" id="itmesModalLabel">Add Item</h4>

<div class="modal-form">
    <form enctype="multipart/form-data" id="items_form" autocomplete="off">
        @csrf
        <input type="hidden" name="id" id="id" value="0">
        <!-- <input type='hidden' name='thenumbers'> -->
        <div class="row">
            <div class="col-md-6 pr-2">
                <div class="form-group">
                    <label for="item_name" class="col-form-label">Item Name</label>
                    <input type="text" class="form-control" id="item_name" value="" name="item_name" aria-describedby="ItemName" placeholder="Item Name">
                </div>
            </div>
            <div class="col-md-6 pl-2">
                <div class="form-group">
                    <label for="item_hsn_code" class="col-form-label">HSN Code</label>
                    <input type="text" class="form-control" id="item_hsn_code" name="item_hsn_code" value="" placeholder="HSN Code">
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="item_vendor" class="col-form-label">Vendor Name</label>
            <input type="text" class="form-control" id="item_vendor" name="item_vendor" value="">
        </div>
        <div class="form-group">
            <label for="item_description" class="col-form-label">Item Description</label>
            <textarea class="form-control" id="item_description" name="item_description"></textarea>
        </div>

        <div class="form-group">
            <label for="item_gst_percentage" class="col-form-label">GST</label>
            <select name="item_gst_percentage" id="item_gst_percentage">
                <option value="">Select</option>
                <option value="5">5</option>
                <option value="10">10</option>
                <option value="15">15</option>
            </select>
        </div>
        <!-- <div class="form-group">
            <div class="d-flex align-items-center">
                <label for="item_gst_percentage" class="mb-0 gst-label">GST</label>
                <div class="dropdown gst-dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="gstdropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        18%
                    </button>
                    <div class="dropdown-menu dropdown-gst" aria-labelledby="gstdropdown">
                        <button class="dropdown-item" type="button">18%</button>
                        <button class="dropdown-item" type="button">12%</button>
                        <button class="dropdown-item" type="button">5%</button>
                        <button class="dropdown-item" type="button">Optional</button>
                        <input type="text" class="form-control" placeholder="00%">
                    </div>
                </div>
            </div>
        </div> -->

        <button type="button" class="btn btn-dark" id="items_submit">Save</button>
    </form>
</div>

<script>
    // $(function(){
    //     //Listen for a click on any of the dropdown items
    //     $(".dropdown-gst").click(function(){
    //         //Get the value
    //         var value = $(this).attr("value");
    //         //Put the retrieved value into the hidden input
    //         $("input[name='thenumbers']").val(value);
    //     });
    // });

    var itemsForm = $("#items_form").validate({
        ignore: [],
        errorClass: "invalid",
        rules: {
            item_name: {
                required: true,
            },
            item_hsn_code: {
                required: true,
            },
            item_vendor: {
                required: true,
            },
            item_description: {
                required: true,
            },
            item_gst_percentage: {
                required: true,
            },
        },
        messages: {
            item_name: {
                required: "Please enter Item name.",
            },
            item_hsn_code: {
                required: "Please enter HSN."
            },
            item_vendor: {
                required: "Please enter Vendor Name.",
            },
            item_description: {
                required: "Please enter Description."
            },
            item_gst_percentage: {
                required: "Please enter GST Number."
            },
        },
        errorPlacement: function(error, element) {
            if (element.attr("name") == "item_gst_percentage") {
                $('#item_gst_percentage_valid').append(error);
            } else {
                element.after(error);
            }
        }
    });
</script>