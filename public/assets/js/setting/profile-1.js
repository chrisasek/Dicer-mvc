(function ($) {
    "use_strict";
  
    // Search User Drawer
    var sm_bank_drawer = document.querySelector(
      "#kt_drawer_send_money_bank_comp"
    );
    var _sm_bank_drawer = new KTDrawer(sm_bank_drawer, {
      overlay: true,
    });
  
    // Confirm Transfer Drawer
    var sm_confirm_drawer = document.querySelector(
      "#kt_drawer_send_money_bank_confirm_comp"
    );
    var _sm_confirm_drawer = new KTDrawer(sm_confirm_drawer, {
      overlay: true,
    });
  
    // Thank you Drawer
    var sm_thanks_drawer = document.querySelector(
      "#kt_drawer_send_money_bank_complete_comp"
    );
    var _sm_thanks_drawer = new KTDrawer(sm_thanks_drawer, {
      overlay: true,
    });
  
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
  
    // Bank Click
    function loadBanks() {
      console.log(
        $("#kt_drawer_send_money_bank_comp [name=bank]").find("option").length
      );
      if (
        $("#kt_drawer_send_money_bank_comp [name=bank]").find("option").length ==
        1
      ) {
        //Check condition here
        // $("#roleType").empty().append("<option>select</option>");
  
        wdata = "option=1&rq=fetch_banks&rtype=html";
        processHttpRequests(
          "controllers/transaction/send-money.php",
          wdata,
          "json"
        )
          .then(function (response) {
            if (response.success) {
              var banks = response.success.data;
              console.log(banks);
  
              if (banks != "") {
                for (i in banks) {
                  console.log(banks);
                  $("#kt_drawer_send_money_bank_comp [name=bank]").append(
                    `<option value="${banks[i].code}" data-bank-name="${banks[i].name}">${banks[i].name}</option>`
                  );
                }
              }
            }
          })
          .catch(function (error) {
            // Hide loading indication
            submitButton.removeAttribute("data-kt-indicator");
            // Enable button
            submitButton.removeAttribute("disabled");
  
            Swal.fire({
              text: "Sorry, looks like there are some errors detected, please try again.",
              icon: "error",
              buttonsStyling: false,
              confirmButtonText: "Ok, got it!",
              customClass: {
                confirmButton: "btn btn-primary",
              },
            });
          });
      }
    }
    // Load Bank when drawer is shown
    _sm_bank_drawer.on("kt.drawer.show", function () {
      console.log("kt.drawer.show event is fired");
      loadBanks();
    });
  
    // On Change account number
    $("#kt_drawer_send_money_bank_comp").on(
      "change keyup paste",
      "[name=account_number]",
      function (e) {
        let submitButton = document.querySelector(
          "#kt_drawer_send_money_bank_comp #kt_submit"
        );
  
        submitButton.removeAttribute("disabled");
        submitButton.setAttribute("data-action", "search");
        submitButton.innerText = "Search User";
  
        document
          .querySelector("#kt_drawer_send_money_bank_comp  .user-details")
          .classList.add("d-none");
        document
          .querySelector("#kt_drawer_send_money_bank_comp  .continue-action")
          .classList.add("d-none");
      }
    );
  
    // Seach User
    $("#kt_drawer_send_money_bank_comp").on(
      "click",
      "#kt_submit[data-action=search]",
      function (e) {
        e.preventDefault();
        // Show loading indication
        let submitButton = e.target;
        submitButton.setAttribute("data-kt-indicator", "on");
        submitButton.setAttribute("disabled", "disabled");
  
        let bank_code = document.querySelector(
          "#kt_drawer_send_money_bank_comp [name=bank]"
        ).value;
  
        let account_number = document.querySelector(
          "#kt_drawer_send_money_bank_comp [name=account_number]"
        ).value;
  
        if (!bank_code) {
          // Show loading indication
          submitButton.removeAttribute("data-kt-indicator", "on");
          submitButton.removeAttribute("disabled");
  
          Swal.fire({
            text: "Sorry, the username is required, please try again.",
            icon: "error",
            buttonsStyling: false,
            confirmButtonText: "Ok, got it!",
            customClass: {
              confirmButton: "btn btn-primary",
            },
          });
        } else {
          const wdata = `bank_code=${bank_code}&account_number=${account_number}&rq=resolve_other_banks&rtype=html`;
          processHttpRequests(
            "controllers/transaction/send-money.php",
            wdata,
            "json"
          )
            .then(function (response) {
              // Show loading indication
              submitButton.setAttribute("data-kt-indicator", "on");
              submitButton.setAttribute("disabled", "disabled");
  
              if (response.success) {
                // Set the name
                let user_details = document.querySelector(
                  "#kt_drawer_send_money_bank_comp .user-details"
                );
                if (user_details.classList.contains("d-none")) {
                  user_details.classList.remove("d-none");
                }
  
                user_details.querySelector(".bank-account-name").innerText =
                  response.success.data.account_name;
  
                sm_bank_drawer
                  .querySelector("#kt_submit")
                  .setAttribute(
                    "data-account-name",
                    response.success.data.account_name
                  );
  
                submitButton.removeAttribute("data-kt-indicator");
                submitButton.setAttribute("disabled", "disabled");
              } else {
                // Hide loading indication
                submitButton.removeAttribute("data-kt-indicator");
                submitButton.removeAttribute("disabled");
  
                // Show error popup. For more info check the plugin's official documentation: https://sweetalert2.github.io/
                Swal.fire({
                  text: response.error
                    ? "" + response.error.message
                    : "Sorry, the email or password is incorrect, please try again.",
                  icon: "error",
                  buttonsStyling: false,
                  confirmButtonText: "Ok, got it!",
                  customClass: {
                    confirmButton: "btn btn-primary",
                  },
                });
              }
            })
            .catch(function (error) {
              // Hide loading indication
              submitButton.removeAttribute("data-kt-indicator");
              // Enable button
              submitButton.removeAttribute("disabled");
  
              Swal.fire({
                text: "Sorry, looks like there are some errors detected, please try again.",
                icon: "error",
                buttonsStyling: false,
                confirmButtonText: "Ok, got it!",
                customClass: {
                  confirmButton: "btn btn-primary",
                },
              });
            });
        }
      }
    );
  
    // Toggle Checkbox
    $("#checkbox_confirm_bank").click(function () {
      let submitButton = document.querySelector(
        "#kt_drawer_send_money_bank_comp #kt_submit"
      );
      var check_box = $("input[name=checkbox_confirm_bank]");
  
      if (check_box.prop("checked")) {
        // Set the next action status
        document
          .querySelector("#kt_drawer_send_money_bank_comp  [name=account_number]")
          .setAttribute("disabled", "disabled");
        document
          .querySelector("#kt_drawer_send_money_bank_comp  .continue-action")
          .classList.remove("d-none");
  
        submitButton.setAttribute("data-action", "confirmed");
        submitButton.innerText = "Complete Transfer";
        submitButton.removeAttribute("disabled");
      } else {
        document
          .querySelector("#kt_drawer_send_money_bank_comp  [name=account_number]")
          .removeAttribute("disabled", "disabled");
        document
          .querySelector("#kt_drawer_send_money_bank_comp  .continue-action")
          .classList.add("d-none");
  
        submitButton.setAttribute("data-action", "search");
        submitButton.innerText = "Search Account";
        submitButton.setAttribute("disabled", "disabled");
      }
      // check_box.prop("checked", !checkBoxes.prop("checked"));
    });
  
    // Step 1
    $("#kt_drawer_send_money_bank_comp").on(
      "click",
      "#kt_submit[data-action=confirmed]",
      function (e) {
        e.preventDefault();
  
        // Show loading indication
        let submitButton = e.target;
        submitButton.setAttribute("data-kt-indicator", "on");
        submitButton.setAttribute("disabled", "disabled");
  
        let account_name = submitButton.getAttribute("data-account-name");
        let bank_name = $("#kt_drawer_send_money_bank_comp [name=bank]")
          .find(":selected")
          .attr("data-bank-name");
        let bank_code = document.querySelector(
          "#kt_drawer_send_money_bank_comp [name=bank]"
        ).value;
        let account_number = document.querySelector(
          "#kt_drawer_send_money_bank_comp [name=account_number]"
        ).value;
        let amount = document.querySelector(
          "#kt_drawer_send_money_bank_comp [name=amount]"
        ).value;
        let narration = document.querySelector(
          "#kt_drawer_send_money_bank_comp [name=narration]"
        ).value;
  
        if (
          account_name.length > 0 &&
          bank_name.length > 0 &&
          bank_code.length > 0 &&
          account_number > 0 &&
          amount.length > 0
        ) {
          // Hide Current Drawer
          _sm_bank_drawer.hide();
  
          // Show Next Drawer
          _sm_confirm_drawer.show();
          sm_confirm_drawer.querySelector(".receiver-name").innerText =
            account_name;
          sm_confirm_drawer.querySelector(".receiver-bank-name").innerText =
            bank_name;
          sm_confirm_drawer.querySelector(".receiver-account-number").innerText =
            account_number;
          sm_confirm_drawer.querySelector(".receiver-amount").innerText = amount;
          sm_confirm_drawer.querySelector(".receiver-narration").innerText =
            narration;
  
          sm_confirm_drawer
            .querySelector("#validate_transfer_btn")
            .setAttribute("data-account-name", account_name);
          sm_confirm_drawer
            .querySelector("#validate_transfer_btn")
            .setAttribute("data-bank-name", bank_name);
          sm_confirm_drawer
            .querySelector("#validate_transfer_btn")
            .setAttribute("data-bank-code", bank_code);
          sm_confirm_drawer
            .querySelector("#validate_transfer_btn")
            .setAttribute("data-account-number", account_number);
          sm_confirm_drawer
            .querySelector("#validate_transfer_btn")
            .setAttribute("data-amount", amount);
          sm_confirm_drawer
            .querySelector("#validate_transfer_btn")
            .setAttribute("data-narration", narration);
        } else {
          // Show loading indication
          submitButton.removeAttribute("data-kt-indicator", "on");
          submitButton.removeAttribute("disabled");
  
          Swal.fire({
            text: "Sorry, the input fields are required, please try again.",
            icon: "error",
            buttonsStyling: false,
            confirmButtonText: "Ok, got it!",
            customClass: {
              confirmButton: "btn btn-primary",
            },
          });
        }
      }
    );
  
    // Confirm Transfer Event
    $("#kt_drawer_send_money_bank_confirm_comp").on(
      "click",
      "#validate_transfer_btn",
      function (e) {
        e.preventDefault();
  
        // Show loading indication
        let submitButton = e.target;
        submitButton.setAttribute("data-kt-indicator", "on");
        submitButton.setAttribute("disabled", "disabled");
  
        const account_name = document
          .querySelector(
            "#kt_drawer_send_money_bank_confirm_comp #validate_transfer_btn"
          )
          .getAttribute("data-account-name");
        const bank_name = document
          .querySelector(
            "#kt_drawer_send_money_bank_confirm_comp #validate_transfer_btn"
          )
          .getAttribute("data-bank-name");
        const bank_code = document
          .querySelector(
            "#kt_drawer_send_money_bank_confirm_comp #validate_transfer_btn"
          )
          .getAttribute("data-bank-code");
        const account_number = document
          .querySelector(
            "#kt_drawer_send_money_bank_confirm_comp #validate_transfer_btn"
          )
          .getAttribute("data-account-number");
        const amount = document
          .querySelector(
            "#kt_drawer_send_money_bank_confirm_comp #validate_transfer_btn"
          )
          .getAttribute("data-amount");
        const narration = document
          .querySelector(
            "#kt_drawer_send_money_bank_confirm_comp #validate_transfer_btn"
          )
          .getAttribute("data-narration");
        const password = document.querySelector(
          "#kt_drawer_send_money_bank_confirm_comp [name=password]"
        ).value;
  
        if (password.length > 0) {
          wdata =
            "account_name=" +
            account_name +
            "&bank_name=" +
            bank_name +
            "&bank_code=" +
            bank_code +
            "&account_number=" +
            account_number +
            "&amount=" +
            amount +
            "&narration=" +
            narration +
            "&password=" +
            password +
            "&rq=send_money_to_other_banks&rtype=html";
          processHttpRequests(
            "controllers/transaction/send-money.php",
            wdata,
            "json"
          )
            .then(function (response) {
              // Show loading indication
              submitButton.setAttribute("data-kt-indicator", "on");
              submitButton.setAttribute("disabled", "disabled");
  
              if (!response.success) {
                // Hide current
                _sm_bank_drawer.hide();
                _sm_confirm_drawer.hide();
                // usernameDrawer.hide();
  
                // Show Next
                _sm_thanks_drawer.show();
                sm_thanks_drawer.querySelector(".transfer-amount").innerText =
                  amount;
                sm_thanks_drawer.querySelector(".receiver-fullname").innerText =
                  account_name;
                sm_thanks_drawer.querySelector(".receiver-bank").innerText =
                  bank_name;
                sm_thanks_drawer.querySelector(
                  ".receiver-account-number"
                ).innerText = account_number;
                // confirmdrawer
                //   .querySelector("[name=username]")
                //   .setAttribute("disabled", "disabled");
                // confirmdrawer.querySelector("[name=amount]").value = amount;
  
                submitButton.removeAttribute("data-kt-indicator");
                submitButton.removeAttribute("disabled");
              } else {
                // Hide loading indication
                submitButton.removeAttribute("data-kt-indicator");
                submitButton.removeAttribute("disabled");
  
                // Show error popup. For more info check the plugin's official documentation: https://sweetalert2.github.io/
                Swal.fire({
                  text: response.error
                    ? "" + response.error.message
                    : "Sorry, the email or password is incorrect, please try again.",
                  icon: "error",
                  buttonsStyling: false,
                  confirmButtonText: "Ok, got it!",
                  customClass: {
                    confirmButton: "btn btn-primary",
                  },
                });
              }
            })
            .catch(function (error) {
              // Hide loading indication
              submitButton.removeAttribute("data-kt-indicator");
              // Enable button
              submitButton.removeAttribute("disabled");
  
              Swal.fire({
                text: "Sorry, looks like there are some errors detected, please try again.",
                icon: "error",
                buttonsStyling: false,
                confirmButtonText: "Ok, got it!",
                customClass: {
                  confirmButton: "btn btn-primary",
                },
              });
            });
        } else {
          // Show loading indication
          submitButton.removeAttribute("data-kt-indicator", "on");
          submitButton.removeAttribute("disabled");
  
          Swal.fire({
            text: "Sorry, check input and try again.",
            icon: "error",
            buttonsStyling: false,
            confirmButtonText: "Ok, got it!",
            customClass: {
              confirmButton: "btn btn-primary",
            },
          });
        }
      }
    );
  })(jQuery);
  