<h4 class="modal-title" id="itmesModalLabel">Edit Item</h4>

<div class="modal-form">
    <form enctype="multipart/form-data" id="items_edit_form" autocomplete="off">
        @csrf
        <input type="hidden" name="id" id="id" value="{{ $items_object->id }}">
        <!-- <input type='hidden' name='thenumbers'> -->
        <div class="row">
            <div class="col-md-6 pr-2">
                <div class="form-group">
                    <label for="item_name" class="col-form-label">Item Name</label>
                    <input type="text" class="form-control" id="item_name" value="{{ $items_object->item_name }}" name="item_name">
                </div>
            </div>
            <div class="col-md-6 pl-2">
                <div class="form-group">
                    <label for="item_hsn_code" class="col-form-label">HSN Code</label>
                    <input type="text" class="form-control" id="item_hsn_code" name="item_hsn_code" value="{{ $items_object->item_hsn_code }}">
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="item_vendor" class="col-form-label">Vendor Name</label>
            <input type="text" class="form-control" id="item_vendor" name="item_vendor" value="{{ $items_object->item_vendor }}">
        </div>
        <div class="form-group">
            <label for="item_description" class="col-form-label">Item Description</label>
            <textarea class="form-control" id="item_description" name="item_description">{{ $items_object->item_description }}</textarea>
        </div>

        <div class="form-group" id="item_gst_percentage_valid">
            <label for="item_gst_percentage" class="col-form-label">GST</label>
            <select name="item_gst_percentage" id="item_gst_percentage">
                <option value="">Select</option>
                <option value="5" @if($items_object->item_gst_percentage == 5) selected @endif>5</option>
                <option value="10" @if($items_object->item_gst_percentage == 10) selected @endif>10</option>
                <option value="15" @if($items_object->item_gst_percentage == 15) selected @endif>15</option>
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
    var items_edit_form = $("#items_edit_form").validate({
        ignore: [],
        validClass: "success",
        errorClass: "invalid",
        rules: {
            item_name: {
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
            item_hsn_code: {
                required: true,
            },
        },
        messages: {
            item_name: {
                required: "Please enter Item name.",
            },
            item_vendor: {
                required: "Please enter Vendor name."
            },
            item_gst_percentage: {
                required: "Please select Gst.",
            },
            item_description: {
                required: "Please enter Description"
            },
            item_hsn_code: {
                required: "Please enter HSN."
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