<?php
if (post_password_required()) {
    echo get_the_password_form();
    return;
}

get_template_part('templates/blog/header'); // Load the header
?>


<div class="listivo-wrapper">
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <h1 class="listivo-blog-title"><?php the_title(); ?></h1>

        <div class="listivo-layout">
            <div class="listivo-layout__content listivo-layout__content--no-sidebar">
                <div class="listivo-post">
                    <div class="listivo-post-inner">
                        <!-- Your custom content starts here -->
                        <div class="container">
                            <h2>Make a Payment</h2>
                            <form id="payment-form">
                                <div id="card-element">
                                    <!-- A Stripe Element will be inserted here. -->
                                </div>
                                <!-- Used to display form errors. -->
                                <div id="card-errors" role="alert"></div>
                                <button id="submit">Submit Payment</button>
                            </form>
                        </div>
                        <!-- Your custom content ends here -->
                    </div>
                </div>
            </div>
        </div>
    </article>
</div>
<script type="text/javascript">
document.addEventListener('DOMContentLoaded', function () {
    const stripe = Stripe('pk_test_51Ph12E2NXYWCFF6vHPP26QFVVQwVa2rObt4MCln5ujyzMJ7MKpoPH1jLGyG95XiwLg9G251y0BCNsDuBOlgAXHxA00qdR6MJqd');
    const elements = stripe.elements();

    const style = {
        base: {
            color: '#32325d',
            fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
            fontSmoothing: 'antialiased',
            fontSize: '16px',
            '::placeholder': {
                color: '#aab7c4'
            }
        },
        invalid: {
            color: '#fa755a',
            iconColor: '#fa755a'
        }
    };

    const card = elements.create('card', { style: style });
    card.mount('#card-element');

    card.addEventListener('change', function (event) {
        const displayError = document.getElementById('card-errors');
        if (event.error) {
            displayError.textContent = event.error.message;
        } else {
            displayError.textContent = '';
        }
    });

    const form = document.getElementById('payment-form');
    form.addEventListener('submit', function (event) {
        event.preventDefault();

        stripe.createToken(card).then(function (result) {
            if (result.error) {
                const errorElement = document.getElementById('card-errors');
                errorElement.textContent = result.error.message;
            } else {
                stripeTokenHandler(result.token);
            }
        });
    });

    function stripeTokenHandler(token) {
        const form = document.getElementById('payment-form');
        const hiddenInput = document.createElement('input');
        hiddenInput.setAttribute('type', 'hidden');
        hiddenInput.setAttribute('name', 'stripeToken');
        hiddenInput.setAttribute('value', token.id);
        form.appendChild(hiddenInput);

        form.submit();
    }
});
</script>

<?php
get_template_part('templates/blog/footer'); // Load the footer

