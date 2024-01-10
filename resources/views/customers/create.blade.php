<h4 class="modal-title" id="itmesModalLabel">Add Customer Info</h4>

<div class="modal-form">
    <form enctype="multipart/form-data" id="customer_form" autocomplete="off">
        @csrf
        <input type="hidden" name="id" id="id" value="0">
        <div class="form-group">
            <label for="customer_name" class="col-form-label">Add Party Name</label>
            <input type="text" class="form-control" id="customer_name" value="" name="customer_name">
        </div>
        <div class="row">
            <div class="col-md-6 pr-2">
                <div class="form-group">
                    <label for="customer_gst_number" class="col-form-label">GST No</label>
                    <input type="text" class="form-control" id="customer_gst_number" name="customer_gst_number" value="">
                </div>
            </div>
            <div class="col-md-6 pl-2">
                <div class="form-group">
                    <label for="customer_phone" class="col-form-label">Phone Number</label>
                    <input type="text" class="form-control" id="customer_phone" name="customer_phone" value="">
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="customer_email" class="col-form-label">Email Id</label>
            <input type="text" class="form-control" id="customer_email" name="customer_email" value="">
        </div>
        <div class="form-group">
            <label for="customer_address" class="col-form-label">Address</label>
            <textarea class="form-control form-textarea" id="customer_address" name="customer_address" rows="6"></textarea>
        </div>

        <button type="button" class="btn btn-dark" id="customer_submit">Save</button>
    </form>
</div>

<script>
    jQuery.validator.addMethod("email", function(value, element) {

        if (/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/.test(value)) {
            return true;
        } else {
            return false;
        }
    }, "Please enter a valid Email.");

    var customerForm = $("#customer_form").validate({
        ignore: [],
        errorClass: "invalid",
        rules: {
            customer_name: {
                required: true,
            },
            customer_phone: {
                required: true,
            },
            customer_address: {
                required: true,
            },
            customer_email: {
                email: true,
                required: true,
                maxlength: 50,
            },
            customer_gst_number: {
                required: true,
            },
        },
        messages: {
            customer_name: {
                required: "Please enter Customer name.",
            },
            customer_phone: {
                required: "Please enter Phone number."
            },
            customer_email: {
                required: "Please enter Email.",
                email: "Please enter valid Email.",
                maxlength: "The email should less than or equal to 50 characters.",
            },
            customer_address: {
                required: "Please enter Address"
            },
            customer_gst_number: {
                required: "Please enter GST Number"
            },
        },
        errorPlacement: function(error, element) {
            element.after(error);
        }
    });
</script>