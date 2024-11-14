"use strict";

// Class definition
var HcSettingProfile = (function () {
    // Elements
    var form;
    var submitButton;
    var validator;

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
    var handleValidation = function (e) {
        // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
        validator = FormValidation.formValidation(form, {
            fields: {
                business_description: {
                    validators: {
                        notEmpty: {
                            message: "Business decription is required",
                        },
                    },
                },
                contact_mail: {
                    validators: {
                        notEmpty: {
                            message: "Contact email is required",
                        },
                    },
                },
                support_mail: {
                    validators: {
                        notEmpty: {
                            message: "Support email is required",
                        },
                    },
                },
            },
            // plugins: {
            //     // trigger: new FormValidation.plugins.Trigger(),
            //     bootstrap: new FormValidation.plugins.Bootstrap5({
            //         rowSelector: ".fv-row",
            //         eleInvalidClass: "", // comment to enable invalid state icons
            //         eleValidClass: "", // comment to enable valid state icons
            //     }),
            //     fieldStatus: new FormValidation.plugins.FieldStatus({
            //         onStatusChanged: function (areFieldsValid) {
            //             areFieldsValid
            //                 ? // Enable the submit button
            //                 // so user has a chance to submit the form again
            //                 submitButton.removeAttribute("disabled")
            //                 : // Disable the submit button
            //                 submitButton.setAttribute("disabled", "disabled");
            //         },
            //     }),
            // },
        });
    };

    var handleSubmitAjax = function (e) {
        // Handle form submit
        submitButton.addEventListener("click", function (e) {
            // Prevent button default action
            e.preventDefault();

            // Validate form
            validator.validate().then(function (status) {
                if (status == "Valid") {
                    // Show loading indication
                    submitButton.setAttribute("data-kt-indicator", "on");
                    // Disable button to avoid multiple click
                    submitButton.disabled = true;

                    // Get Data
                    const business_description = form.querySelector(
                        '[name="business_description"]'
                    ).value;
                    const contact_mail = form.querySelector(
                        '[name="contact_mail"]'
                    ).value;
                    const support_mail = form.querySelector(
                        '[name="support_mail"]'
                    ).value;
                    const phone_number = form.querySelector(
                        '[name="phone_number"]'
                    ).value;
                    const state = form.querySelector('[name="state"]').value;
                    const city = form.querySelector('[name="city"]').value;
                    const office_address = form.querySelector(
                        '[name="office_address"]'
                    ).value;
                    const website = form.querySelector('[name="website"]').value;
                    const facebook = form.querySelector('[name="facebook"]').value;
                    const instagram = form.querySelector('[name="instagram"]').value;
                    const twitter = form.querySelector('[name="twitter"]').value;

                    // Send Data
                    const wdata = `business_description=${business_description}&contact_mail=${contact_mail}&support_mail=${support_mail}&phone_number=${phone_number}&state=${state}&city=${city}&office_address=${office_address}&website=${website}&facebook=${facebook}&instagram=${instagram}&twitter=${twitter}&rq=business-info&rtype=html`;
                    processHttpRequests(
                        "controllers/onboarding/business-information.php",
                        wdata,
                        "json"
                    )
                        .then(function (response) {
                            if (response.success) {
                                // form.querySelector('[name="code"]').value = "";

                                const redirectUrl = response.success.redirect
                                    ? response.success.redirect
                                    : form.getAttribute("data-kt-redirect-url");

                                // Show message
                                // alertToast(
                                //   response.success
                                //     ? "" + response.success.message
                                //     : "Your Business Info has been updated successfully, Proceed to document verification.",
                                //   "success"
                                // );

                                if (redirectUrl) {
                                    location.href = redirectUrl;
                                }
                            } else {
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
                                response.error
                                    ? "" + response.error.message
                                    : "Sorry, looks like there are some errors detected, please try again.",
                                "error"
                            );
                        });
                } else {
                    // Hide loading indication
                    submitButton.removeAttribute("data-kt-indicator");
                    submitButton.disabled = false;

                    // Show message
                    alertToast(
                        "Sorry, looks like there are some errors detected, please try again.",
                        "error"
                    );
                }
            });
        });
    };

    // Upload Logo
    var handleLogoUpload = function (e) {
        function convertImageToBinary(file) {
            return new Promise((resolve, reject) => {
                const reader = new FileReader();

                reader.onloadend = () => {
                    // Binary data as ArrayBuffer
                    const binaryData = reader.result;
                    resolve(binaryData);
                };

                reader.onerror = () => {
                    reject(new Error("Error converting image to binary data."));
                };

                reader.readAsArrayBuffer(file);
            });
        }

        // Assuming you have an input element of type "file"
        const input = document.querySelector("input#business_logo");
        if (input) {
            input.addEventListener("change", async () => {
                const file = input.files[0];

                try {
                    const binaryData = await convertImageToBinary(file);
                    console.log("Binary data:", binaryData);
                    // Call the uploadBinaryData function here passing the binaryData
                    uploadBinaryData(binaryData);
                } catch (error) {
                    console.error("Error:", error);
                }
            });
        }

        function uploadBinaryData(binaryData) {
            // Convert binary data to a Blob
            const blob = new Blob([binaryData]);

            // Create a FormData object and append the blob
            const formData = new FormData();
            formData.append("fileUpload", blob, "filename.bin");
            formData.append("resource_type", "upload_logo");
            formData.append(
                "id",
                document.querySelector("input[name=biz_merchant_id]").value
            );

            dataForm(formData);
        }

        function dataForm(formData) {
            $.ajax({
                url: "https://appapi.etegram.com/business/api/document_upload/",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    // url = response.data.url
                    // Handle the response data
                    // console.log("PHP script response:", response);
                },
                error: function (error) {
                    // Handle any errors
                    alertToast(
                        "Sorry, looks like there are some errors uploading business logo, please try again."
                    );
                },
                xhr: function () {
                    var xhr = new window.XMLHttpRequest();
                    xhr.upload.addEventListener(
                        "progress",
                        function (evt) {
                            if (evt.lengthComputable) {
                                var percentComplete = (evt.loaded / evt.total) * 100;
                                console.log(percentComplete);
                                // Place upload progress bar visibility code here
                            }
                        },
                        false
                    );
                    return xhr;
                },
            });
        }

        $(".business_logo_remove").click(function () {
            console.log("remove logo");
        });
    };

    // Public functions
    return {
        init: function () {
            form = document.querySelector("#hc_setting_profile");
            if (form) {
                submitButton = form.querySelector("#hc_setting_profile_btn");

                console.log(submitButton);

                handleValidation();
                handleSubmitAjax();
                handleLogoUpload();
            }
        },
    };
})();

// On document ready
document.addEventListener("DOMContentLoaded", () => {
    console.log('profile drawer');
    HcSettingProfile.init();
});
