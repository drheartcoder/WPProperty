<?php
// Add property form shortcode
function add_property_form_shortcode() {
    ob_start();
    ?>
    <form method="POST">
        <?php wp_nonce_field('property_action', 'property_nonce'); ?>
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="address">Address</label>
            <textarea class="form-control" id="address" name="address" rows="3" required></textarea>
        </div>
        <div class="form-group">
            <label for="city">City</label>
            <input type="text" class="form-control" id="city" name="city" required>
        </div>
        <div class="form-group">
            <label for="country">Country</label>
            <input type="text" class="form-control" id="country" name="country" required>
        </div>
        <div class="form-group">
            <label for="pincode">Pincode</label>
            <input type="text" class="form-control" id="pincode" name="pincode" required>
        </div>
        <div class="form-group">
            <label for="status">Status</label>
            <select class="form-control" id="status" name="status" required>
                <option value="buy">Buy</option>
                <option value="sell">Sell</option>
                <option value="rent">Rent</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary btn-block">Add Property</button>
    </form>
    <?php
    return ob_get_clean();
}
add_shortcode('add_property_form', 'add_property_form_shortcode');
?>
