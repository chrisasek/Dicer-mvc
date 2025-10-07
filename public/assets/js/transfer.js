"use strict";

// Class definition
var TransferDrawer = (function () {
    // Elements
    var form;
    var form_selector = '#form_transfer';

    var form_2;

    var submit_selector = '#form_transfer_btn';
    var submit_selector_2 = '#form_transfer_2_btn';

    var submitButton;
    var submitButton2;
    var validator;

    function redirect_to(time = 5000, to = null) {
        setTimeout(function () {
            // wait for 5 secs(2)
            to ? (location.href = to) : location.reload(); // then reload the page.(3)
        }, time);
    }

    // AJAX
    function processHttpRequests(url, data, re) {
        if (url && data) {
            return $.ajax({
                url: url,
                data: data,
                cache: false,
                type: "post",
                dataType: re,
            }).promise();
        }
    }

    // Handle form


    var handleValidation = function (form_selector_str, submit_selector_str) {
        $(form_selector_str).on('blur keyup change', 'input', function (event) {
            validateForm(form_selector_str);
        });
        $(form_selector_str).on('blur keyup change', 'select', function (event) {
            validateForm(form_selector_str);
        });
        $(form_selector_str).on('blur keyup change', 'textarea', function (event) {
            validateForm(form_selector_str);
        });

        function validateForm(id) {
            var valid = $(id).validate().checkForm();
            // var valid = $(id).valid();
            if (valid) {
                $(submit_selector_str).prop('disabled', false);
                $(submit_selector_str).removeClass('isDisabled');
            } else {
                $(submit_selector_str).prop('disabled', 'disabled');
                $(submit_selector_str).addClass('isDisabled');
            }
        }
        // validateForm(form_selector_str);

        // Validate inputs
        $(form_selector_str).validate({
            submitHandler: function (form) {
                handleSubmitAjax(form)
            },
            // Check focus
            onfocusout: function (element) {
                //console.log(this.element(element));
                !this.element(element) || !$(element).val() || $(element).val() == 'default' ? $(element).addClass('red-border') : $(element).addClass('input-no-error');
            },
            // Set rules
            rules: {
                amount: {
                    required: true,
                    number: true,
                    min: 1000
                },
            },
            // Message for the rules
            messages: {
                amount: {
                    required: "Please this is required and must be filled out",
                    number: "This field accepts only positive numbers",
                    min: "Minimium Amount is 1000"
                }
            }

        });
    };

    // Handle Continue
    var handleNameLookup = function (bank_code, account_number) {
        let submit_data = "rq=name-look-up&bank_code=" + bank_code + "&account_number=" + account_number;

        processHttpRequests(
            "transfer/lookup",
            submit_data,
            "json"
        )
            .then(function (response) {
                if (response.status == 'success') {
                    const data = response.data;

                    $('.transfer-name-reference').val(data.sessionId);
                    $('.transfer-account-name').removeClass('d-none').html(data.accountName);
                    $('.transfer-amount-section').removeClass('d-none');
                    $('.transfer-naration-section').removeClass('d-none');
                } else {
                    $('.transfer-name-reference').val('');
                    $('.transfer-account-name').addClass('d-none');
                    $('.transfer-amount-section').addClass('d-none');
                    $('.transfer-naration-section').addClass('d-none');

                    // Hide loading indication
                    submitButton.removeAttribute("data-kt-indicator");
                    submitButton.disabled = false;

                    // Show message
                    alertToast(
                        response.error
                            ? "" + response.error.message
                            : "Check input, please try again.",
                        "error"
                    );
                }
            })
            .catch(function (error) {
                // Hide loading indication
                submitButton.removeAttribute("data-kt-indicator");
                submitButton.disabled = false;

                // Show message
                alertToast(
                    "Sorry, looks like there are some errors detected, please try again.",
                    "error"
                );
            });
    };

    var handleAccountChange = function (e) {
        $('select#transfer-bank').on('change', e => {
            e.preventDefault();
            const bank_code = $('#transfer-bank').find(":selected").val();
            const account_number = $('#transfer-account').val();

            if (bank_code && account_number.length > 9) {
                handleNameLookup(bank_code, account_number)
            }
        });

        $('input#transfer-account').on('keyup', e => {
            e.preventDefault();
            const bank_code = $('#transfer-bank').find(":selected").val();
            const account_number = $('#transfer-account').val();

            if (bank_code && account_number.length > 9) {
                handleNameLookup(bank_code, account_number)
            }
        });
    };

    // Handle Submit
    var handleSubmitAjax = function (form, e) {
        $(submit_selector).on('click', e => {
            e.preventDefault();
            const form = $('#form_transfer');
            if (form.valid()) {
                let form_data = form.serialize();
                let submit_data = form_data + "&transfer-name-reference=" + $('.transfer-name-reference').val();

                processHttpRequests(
                    "transfer",
                    submit_data,
                    "json"
                )
                    .then(function (response) {
                        if (response.status == 'success') {
                            // Reset Form
                            $('.transfer-name-reference').val('');
                            $('.transfer-account-name').addClass('d-none');
                            $('.transfer-amount-section').addClass('d-none');
                            $('.transfer-naration-section').addClass('d-none');

                            // Show message
                            alertToast(
                                "Transfer sent successfully.",
                                "success"
                            );

                            redirect_to(5000, 'transactions');
                            // form.reset();
                        } else {
                            // Hide loading indication
                            submitButton.removeAttribute("data-kt-indicator");
                            submitButton.disabled = false;

                            // Show message
                            alertToast(
                                response.status == 'failed'
                                    ? "" + response.message
                                    : "Check input, please try again.",
                                "error"
                            );
                        }
                    })
                    .catch(function (error) {
                        // Hide loading indication
                        submitButton.removeAttribute("data-kt-indicator");
                        submitButton.disabled = false;

                        // Show message
                        alertToast(
                            "Sorry, looks like there are some errors detected, please try again.",
                            "error"
                        );
                    });
            }
        });
    };

    // Public functions
    return {
        init: function () {
            form = document.querySelector(form_selector);
            if (form) {
                // Button
                submitButton = form.querySelector(submit_selector);

                // Handle Validation
                handleValidation(form_selector, submit_selector);

                handleAccountChange();

                // Handle Submit
                handleSubmitAjax();
            }
        },
    };
})();

// On document ready
document.addEventListener("DOMContentLoaded", () => {
    TransferDrawer.init();
});