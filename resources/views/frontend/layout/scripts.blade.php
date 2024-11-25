<script>
    $(document).ready(function() {
        // Add A Product Into Cart
        $(document).on('submit','.shopping_cart_form',function(e) {
            e.preventDefault();
            let formData = $(this).serialize();

            $.ajax({
                method: 'POST',
                url: '{{ route('add.to.cart') }}',
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if (response.status === 'stock_out') {
                        toastr.error(response.message); // Show stock error
                    } else if (response.status === 'success') {
                        toastr.success(response.message); // Show success message
                        $('.cart_mini_actions').removeClass('d-none');
                        CartBagCount();
                        fetchSidebarCartProduct();
                        UpdateSideBarCartTotal();

                        // Toggle cart_mini_actions visibility based on item count
                        if (response.cartCount > 0) {
                            $('.cart_mini_actions').removeClass('d-none');
                        } else {
                            $('.cart_mini_actions').addClass('d-none');
                        }
                    }
                },

                error: function(xhr, status, error) {
                    toastr.error('An error occurred, please try again.');
                }
            });
        });

        // Counter For Cart Bag In the header
        function CartBagCount() {
            $.ajax({
                method: 'GET',
                url: '{{ route('show.cart.count') }}',
                success: function(response) {
                    $('#shopping_bag_count').html(response.count);
                },
                error: function(xhr, status, error) {}
            });
        }
        // Fetch Cart Bag Content Data
        function fetchSidebarCartProduct() {
            let currency = "{{ $settings->currency_icon }}";
            $.ajax({
                method: 'GET',
                url: '{{ route('get.sidebar.cart.products') }}',
                success: function(response) {
                    // Clear the existing cart items
                    $('#sidebar_cart_products_container').empty();

                    // Loop through each product in the response and append it to the cart
                    $.each(response.products, function(index, product) {
                        let productHtml = `
                                <li id="cart_mini_${product.rowId}" style="margin-bottom: 30px;">
                                    <div class="wsus__cart_img">
                                        <a href="${product.options.slug}"><img src="${product.options.image}" alt="${product.name}"
                                            class="img-fluid w-100"></a>
                                        <a class="wsis__del_icon remove_sidebar_product" data-rowId="${product.rowId}" href="#"><i class="fas fa-minus-circle"></i></a>
                                    </div>
                                    <div class="wsus__cart_text">
                                        <a class="wsus__cart_title" href="${product.options.slug}">${product.name} </a>
                                        <p>${currency}${product.price}</p>
                                          <code>Product Variants : ${product.options.variants_total}</code>
                                         <code>Quantity : ${product.qty }</code>

                                    </div>
                                </li>`;

                        // Append the product to the cart container
                        $('#sidebar_cart_products_container').append(productHtml);
                    });
                },
                error: function(xhr, status, error) {}
            });
        }
        // Remove Product From Cart Bag
        $('body').on('click', '.remove_sidebar_product', function(e) {
            e.preventDefault();
            let rowId = $(this).attr('data-rowId');
            $.ajax({
                method: 'POST',
                data: {
                    rowId: rowId,
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '{{ route('remove.side.cart.product') }}',
                success: function(response) {
                    $('#cart_mini_' + rowId)
                        .remove();
                    toastr.success(response.message);
                    if ($('#sidebar_cart_products_container').find('li').length == 0) {
                        let li = "<li >This Cart Is Empty</li>";
                        $('#sidebar_cart_products_container').html(li);
                        $('.cart_mini_actions').addClass('d-none');
                    }
                    UpdateSideBarCartTotal();
                },
                error: function(xhr, status, error) {
                    console.log(error);
                }
            });
        });

        //Add A Product To Wishlist
        $('.add_to_wishlist').on('click', function(e) {
            e.preventDefault();
            let productId = $(this).attr('data-id');
            $.ajax({
                method: 'GET',
                data: {
                    productId: productId
                },
                url: "{{ route('add.to.wishlist') }}",
                success: function(response) {
                    if (response.status == 'success') {
                        toastr.success(response.message);
                        $('.wishlist_class_counter').html(response.count);
                    } else if (response.status == 'error') {
                        toastr.error(response.message);
                    }
                },
                error: function(xhr, status, error) {
                    // Display error message from backend using Toastr
                    toastr.error(xhr.responseJSON.message);
                }
            });
        });

        // Calc The Product Total And Keep the SideBar Cart Total Price Updating
        function UpdateSideBarCartTotal() {
            let currency = "{{ $settings->currency_icon }}";
            $.ajax({
                method: 'GET',
                url: '{{ route('get.cart.total') }}',
                success: function(response) {
                    $('#sidbar_cart_total').empty();
                    $('#sidbar_cart_total').text(currency + response.total);
                },
                error: function(xhr, status, error) {}
            });
        }

        function GetSubTotal() {
            let currency = "{{ $settings->currency_icon }}";
            $.ajax({
                method: 'GET',
                url: '{{ route('get.cart.total') }}',
                success: function(response) {
                    $('#sub_total_span').html(currency + response.total);
                },
                error: function(xhr, status, error) {}
            });
        }
        $('#newsletters_subscribe').on('submit', function(e) {
            e.preventDefault();
            let formData = $(this).serialize();
            $.ajax({
                method: 'POST',
                data: formData,
                url: '{{ route('newsletters.subscribe') }}',
                beforeSend: function() {
                    // Show spinner and disable the button to prevent multiple submissions
                    $('.subscribe_btn').html(
                        '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...'
                    ).prop('disabled', true);
                },
                success: function(response) {
                    if (response.status === 'success') {
                        toastr.success(response.message);
                    } else if (response.status === 'error') {
                        toastr.error(response.message);
                    }
                },
                error: function(xhr) {
                    // Check if there is a JSON response and handle the 'message' directly
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        toastr.error(xhr.responseJSON.message);
                    } else {
                        // Loop through validation errors if they exist
                        let errors = xhr.responseJSON.errors;
                        $.each(errors, function(index, value) {
                            toastr.error(value);
                        });
                    }
                },
                complete: function() {
                    // Reset button to original state
                    $('.subscribe_btn').html('Subscribe').prop('disabled', false);
                },
            });
        });

        // Show Modal
        $('.show_modal').on('click', function() {
            let id = $(this).attr('data-productID');
            $.ajax({
                method: 'GET',
                url: '{{ route('show.product.modal', ':id') }}'.replace(':id', id),
                beforeSend: function() {
                    $('.product_modal_content').html('<span class="loader"></span>');
                },
                success: function(response) {
                    $('.product_modal_content').html(response);
                },
                error: function(xhr, status, error) {},

                complete: function() {},
            });
        });

    });
</script>

