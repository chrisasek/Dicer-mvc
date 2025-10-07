(function ($) {
  "use_strict";

  $messagePoint = $("#mp_modal");
  // Messages module
  var Messaging = {
    showMessage: function ($title, $msg, $function) {
      $messagePoint.find("#mp_modal").text($title);
      $messagePoint.find(".modal-body").text($msg);
      return $messagePoint
        .modal("show")
        .on("hidden.bs.modal", $function)
        .promise();
    },
  };

  $('.select2').select2({
    dropdownParent: $('.select2').parent()
  });
  // $(".slugit").slugit();

  function reload2home(time = 5000, to = null) {
    setTimeout(function () {
      // wait for 5 secs(2)
      to ? (location.href = to) : location.reload(); // then reload the page.(3)
    }, time);
  }

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

  $('.copy').on('click', function (e) {
    e.preventDefault();
    // Get the text field
    let prevText = $(this).html();
    var copyText = $(this).data('text');

    // Copy the text inside the text field
    navigator.clipboard.writeText(copyText);

    $(this).html("<span class='fs-10px'>Copied</span>")
    setTimeout(() => {
      $(this).html(prevText)
    }, 5000)
  });

  // Toggle Food
  $('.toggle-password').on('click', function (e) {
    e.preventDefault();

    let input = $("input#" + $(this).attr('data-target'));
    if (input.attr('type') == 'password') {
      input.attr('type', 'text')
    } else {
      input.attr('type', 'password')
    }
  });

  // Placeholder for dropdowns
  const $placeholder = $("select[placeholder]");
  if ($placeholder.length) {
    $placeholder.each(function () {
      const $this = $(this);

      // Initial
      $this.addClass("placeholder-shown");
      const placeholder = $this.attr("placeholder");
      const placeholder_value = $this.attr("placeholder-value");
      $this.prepend(`<option value="${placeholder_value}" selected>${placeholder}</option>`);

      // Change
      $this.on("change", (event) => {
        const $this = $(event.currentTarget);
        if ($this.val()) {
          $this.removeClass("placeholder-shown").addClass("placeholder-hidden");
        } else {
          $this.addClass("placeholder-shown").removeClass("placeholder-hidden");
        }
      });
    });
  }

  // $('.toggle-password').on('click', function (e) {
  //   e.preventDefault();

  //   let input = $("input#" + $(this).attr('data-target'));
  //   input.attr('type') == 'password' ? input.attr('type', 'text') : input.attr('type', 'password')
  // });

  $(".toggler").on("click", function (e) {
    e.preventDefault();
    if ($("#" + $(this).data("toggle")).is(":visible")) {
      $("#" + $(this).data("toggle"))
        .removeClass("d-block")
        .addClass("d-none");
    } else {
      $("#" + $(this).data("toggle"))
        .removeClass("d-none")
        .addClass("d-block");
    }
  });

  // tool tips
  $(function () {
    $('[data-toggle="tooltip"]').tooltip();
  });


  $(".world").on("change click", function (e) {
    e.preventDefault();

    type = $(this).data("type");
    append = $(this).data("world-append");
    append_txt = $(this).data("world-append-text")
      ? "<option value=''>" + $(this).data("world-append-text") + "</option>"
      : null;
    target = $(this).data("world-target");
    value = $(this).val();
    if (!value) {
    } else {
      wdata =
        "value=" +
        parseInt(value) +
        "&type=" +
        type +
        "&append=" +
        append +
        "&rq=world&rtype=html";
      processHttpRequests("controllers/get.php", wdata, "json").then(function (
        result
      ) {
        if (typeof result == "object" && result.success) {
          // 	console.log(result);
          if (result.success.type == "country") {
            if (result.success.append) {
              $(target).html(append_txt + result.success.data);
            } else {
              $(target).html(result.success.data);
            }
          }
          if (result.success.type == "state") {
            $(target).html(result.success.data);
          }
        } else {
          $(".lga").html('<option value="">Select LGA</option>');
        }
      });
    }
  });

  // Notification Setting
  // -- News
  $(".change-active-business").on("change", function () {

    let value = $(this).val()
    // if ($(this).is(":checked")) {
    //   value = $(this).is(":checked").val();
    // }
    console.log(value);

    // Change Active Business
    if (value) {
      let type = $(this).attr('data-setting-type');
      wdata =
        "business_id=" + value +
        "&rq=set-active-business&rtype=html";
      processHttpRequests("controllers/get.php", wdata, "json").then(function (
        result
      ) {
        if (typeof result == "object" && result.success) {
          alertToast(result.success.message, 'success')
        } else {
          alertToast(result.success.message, 'error')
        }
      });
    }
  });

  $(".toggle-amount").on("click", function (e) {
    e.preventDefault();
    let elem_main = $(this);

    let elem = $($(this).data("field"));
    const content = elem.data("value");


    if ($(this).hasClass("bi-eye-slash")) {
      elem.text("***");
      $(this).removeClass("bi-eye-slash").addClass("bi-eye");
    } else {
      elem.text(content);
      elem.attr('data-value', content);
      elem_main.removeClass("bi-eye").addClass("bi-eye-slash");
    }
  });
})(jQuery);
