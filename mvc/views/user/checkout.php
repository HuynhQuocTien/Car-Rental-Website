<div id="page-container">
<!-- Main Container -->
<main id="main-container">
  <!-- Page Content -->
  <div class="content content-boxed content-full overflow-hidden">
    <!-- Header -->
    <div class="py-5 text-center">
      <!-- <a class="link-fx fw-bold fs-3" href="index.html">
        <span class="text-dark">Dash</span><span class="text-primary">mix</span>
      </a> -->
      <h1 class="fs-2 fw-bold mt-4 mb-2">
        Complete Payment
      </h1>
      <h2 class="fs-5 fw-medium text-muted mb-0">
        Thank you for shopping from our store. Your items are almost at your doorstep.
      </h2>
    </div>
    <!-- END Header -->

    <!-- Checkout -->
    <form onsubmit="return false;">
    <div class="row">
        <!-- Order Info -->
        <div class="col-xl-7">
          <!-- Shipping Method -->
          <!-- <div class="block block-rounded">
            <div class="block-header block-header-default">
              <h3 class="block-title">
                1. Shipping Method
              </h3>
            </div>
            <div class="block-content block-content-full space-y-3">
              <div class="form-check form-block">
                <input type="radio" class="form-check-input" id="checkout-delivery-1" name="checkout-delivery" checked>
                <label class="form-check-label" for="checkout-delivery-1">
                  <span class="d-block fw-normal p-1">
                    <span class="d-block fw-semibold mb-1">Standard Delivery</span>
                    <span class="d-block fs-sm fw-medium text-muted"><span class="fw-semibold">FREE</span> (4-5 working days)</span>
                  </span>
                </label>
              </div>
              <div class="form-check form-block">
                <input type="radio" class="form-check-input" id="checkout-delivery-2" name="checkout-delivery">
                <label class="form-check-label" for="checkout-delivery-2">
                  <span class="d-block fw-normal p-1">
                    <span class="d-block fw-semibold mb-1">
                      Express Delivery
                      <i class="fa fa-fire text-danger ms-1"></i>
                    </span>
                    <span class="d-block fs-sm fw-medium text-muted"><span class="fw-semibold">+$9.99</span> (1-2 working days)</span>
                  </span>
                </label>
              </div>
            </div>
          </div>
           -->
          <!-- END Shipping Method -->

          <!-- Shipping Address -->
          <div class="block block-rounded">
            <div class="block-header block-header-default">
              <h3 class="block-title">
                1. Shipping Address
              </h3>
            </div>
            <div class="block-content">
              <!-- <div class="mb-4">
                <div class="form-floating">
                  <input type="text" class="form-control" id="checkout-company" name="checkout-company" placeholder="Enter your company">
                  <label class="form-label" for="checkout-company">Company (optional)</label>
                </div>
              </div> -->
              <div class="row mb-4">
                <div class="col-12">
                  <div class="form-floating">
                    <input type="text" class="form-control" id="checkout-fullname" name="checkout-fullname" placeholder="Enter your fullname">
                    <label class="form-label" for="checkout-fullname">Fullname</label>
                  </div>
                </div>
                <!-- <div class="col-6">
                  <div class="form-floating">
                    <input type="text" class="form-control" id="checkout-lastname" name="checkout-lastname" placeholder="Enter your lastname">
                    <label class="form-label" for="checkout-lastname">Lastname</label>
                  </div>
                </div> -->
              </div>
              <div class="mb-4">
                <div class="form-floating">
                  <input type="text" class="form-control" id="checkout-street" name="checkout-street" placeholder="Enter your street address">
                  <label class="form-label" for="checkout-street">Street Address</label>
                </div>
              </div>
              <div class="row mb-4">
                <div class="col-7">
                  <div class="form-floating">
                    <input type="text" class="form-control" id="checkout-city" name="checkout-city" placeholder="Enter your city">
                    <label class="form-label" for="checkout-city">City</label>
                  </div>
                </div>
                <div class="col-5">
                  <div class="form-floating">
                    <input type="text" class="form-control" id="checkout-postal" name="checkout-postal" placeholder="Enter your postal">
                    <label class="form-label" for="checkout-postal">Postal</label>
                  </div>
                </div>
              </div>
              <div class="mb-4">
                <div class="form-floating">
                  <input type="text" class="form-control" id="checkout-phone" name="checkout-phone" placeholder="Enter your phone number">
                  <label class="form-label" for="checkout-phone">Phone Number</label>
                </div>
              </div>
              <!-- <div class="mb-4">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="" id="checkout-billing-address-same" name="checkout-billing-address-same" checked>
                  <label class="form-check-label fw-medium text-muted" for="checkout-billing-address-same">Billing address is the same</label>
                </div>
              </div> -->
            </div>
          </div>
          <!-- END Shipping Address -->

          <!-- Payment -->
          <div class="block block-rounded">
            <div class="block-header block-header-default">
              <h3 class="block-title">
                2. Payment
              </h3>
            </div>
            <div class="block-content block-content-full space-y-3">
              <div class="form-check form-block">
                <input type="radio" class="form-check-input" id="payment-cash" name="payment-method" value="cash">
                <label class="form-check-label" for="payment-cash">
                  <span class="d-block fw-normal p-1">
                    <span class="d-block fw-semibold mb-1">Cash on Delivery</span>
                    <span class="d-block fs-sm fw-medium text-muted">Pay when you receive the items</span>
                  </span>
                </label>
              </div>
                <div class="form-check form-block">
                <input type="radio" class="form-check-input" id="payment-bank" name="payment-method" value="bank">
                <label class="form-check-label" for="payment-bank">
                  <span class="d-block fw-normal p-1">
                  <span class="d-block fw-semibold mb-1">Bank Transfer</span>
                  <span class="d-block fs-sm fw-medium text-muted">Transfer to our bank account</span>
                  </span>
                </label>
                </div>
                <div id="card-info" style="display: none; margin-top: 15px;">
                  <div class="mb-4">
                    <div class="form-floating">
                    <input type="text" class="form-control" id="card-number" name="card-number" placeholder="Enter your card number">
                    <label class="form-label" for="card-number">Card Number</label>
                    </div>
                  </div>
                <div class="row mb-4">
                  <div class="col-6">
                  <div class="form-floating">
                    <input type="text" class="form-control" id="card-expiry" name="card-expiry" placeholder="MM/YY">
                    <label class="form-label" for="card-expiry">Expiry Date (MM/YY)</label>
                  </div>
                  </div>
                  <div class="col-6">
                  <div class="form-floating">
                    <input type="text" class="form-control" id="card-cvv" name="card-cvv" placeholder="CVV">
                    <label class="form-label" for="card-cvv">CVV</label>
                  </div>
                  </div>
                </div>
                <div class="mb-4">
                  <div class="form-floating">
                  <input type="text" class="form-control" id="card-holder" name="card-holder" placeholder="Enter cardholder name">
                  <label class="form-label" for="card-holder">Cardholder Name</label>
                  </div>
                </div>
                </div>
                <script>
                function toggleCardInfo(show) {
                  document.getElementById('card-info').style.display = show ? 'block' : 'none';
                }
                
                document.querySelectorAll('input[name="payment-method"]').forEach(input => {
                  input.addEventListener('change', function() {
                  if (this.value !== 'bank') {
                    toggleCardInfo(false);
                  }
                  });
                });
                </script>
            </div>
          </div>
          <!-- END Payment -->
        </div>
        <!-- END Order Info -->

        <!-- Order Summary -->
        <div class="col-xl-5 order-xl-last">
          <div class="block block-rounded">
            <div class="block-header block-header-default">
              <h3 class="block-title">
                Order Summary
              </h3>
            </div>
            <div class="block-content block-content-full">
              <table id="carts" class="table table-vcenter">
                <tbody>
                  <!-- <tr>
                    <td class="ps-0">
                      <a class="fw-semibold" href="javascript:void(0)">Airpods</a>
                      <div class="fs-sm text-muted">Bluetooth headset</div>
                    </td>
                    <td class="pe-0 fw-medium text-end">$129</td>
                  </tr>
                  <tr>
                    <td class="ps-0">
                      <a class="fw-semibold" href="javascript:void(0)">Mac Mini</a>
                      <div class="fs-sm text-muted">256GB, 16GB RAM</div>
                    </td>
                    <td class="pe-0 fw-medium text-end">$799</td>
                  </tr> -->
                </tbody>
                <tbody>
                  <!-- <tr>
                    <td class="ps-0 fw-medium">Subtotal</td>
                    <td class="pe-0 fw-medium text-end">$928</td>
                  </tr>
                  <tr>
                    <td class="ps-0 fw-medium">Vat (10%)</td>
                    <td class="pe-0 fw-medium text-end">$92.8</td>
                  </tr>
                  <tr>
                    <td class="ps-0 fw-medium">Total</td>
                    <td class="pe-0 fw-bold text-end">$1,020.8</td>
                  </tr> -->
                </tbody>
                <tr>
                  <td class="ps-0 fw-medium">Promotion</td>
                  <td class="pe-0 fw-medium text-end">
                  <select id="promotion" name="promotion" class="form-select" onchange="applyPromotion()">
                    <option value="" selected>Choose Promotion</option>
                    <option value="promo10" data-discount-type="0" data-discount-value="10">10% Off</option>
                    <option value="promo20" data-discount-type="0" data-discount-value="20">20% Off</option>
                    <option value="promo30" data-discount-type="0" data-discount-value="30">30% Off</option>
                  </select>
                  </td>
                </tr>
                <tr>
                  <td class="ps-0 fw-medium">Discount</td>
                  <td id="discount-value" class="pe-0 fw-medium text-end">$0.00</td>
                </tr>
                <tr>
                  <td class="ps-0 fw-medium">Total</td>
                  <td id="total-value" class="pe-0 fw-bold text-end">$0.00</td>
                </tr>

              </table>
            </div>
          </div>
          <button id="btnCompleteOrder" type="submit" class="btn btn-primary w-100 py-3 push">
            <i class="fa fa-check opacity-50 me-1"></i>
            Complete Order
          </button>
        </div>
        <!-- END Order Summary -->
      </div>
    </form>
    <!-- END Checkout -->
  </div>
  <!-- END Page Content -->
</main>
<!-- END Main Container -->
</div>