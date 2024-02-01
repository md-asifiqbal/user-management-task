import Swal from "sweetalert2";
$(function () {



  $(document).on("submit", "#ajax-form, .ajax-form", function (e) {
    e.preventDefault();
    let form = $(this);
    let method = form.attr("method");
    let button = form.find("button[type=submit]");
    let buttonText = button.html();
    button.text("Loading...");
    button.attr("disabled", true);
    let progress = form.find(".progress-bar");
    progress.html("0%");
    progress.css("width", "0px");
    let data = new FormData($(this)[0]);
    $.ajax({
      xhr: function () {
        var xhr = new window.XMLHttpRequest();
        xhr.upload.addEventListener(
          "progress",
          function (evt) {
            if (evt.lengthComputable) {
              var persentComplete = parseFloat(
                (evt.loaded / evt.total) * 100
              ).toFixed(2);
              progress.css("width", persentComplete + "%");
              progress.html(persentComplete + "%");
            }
          },
          false
        );
        return xhr;
      },
      type: method,
      url: form.attr("action"),
      data: data,
      contentType: false,
      cache: false,
      processData: false,
      success: function (output) {
        button.html(buttonText);
        button.removeAttr("disabled");
        if (output.modal) {
          $(".modal").modal("hide");
        }
        if (output.status) {
          successMessage(output.message, output.button);
        } else {
          errorMessage(output.message);
        }
        if (output.url) {
          window.location.href = output.url;
        }
        if (output.table) {
          $('.table').DataTable().draw(true);
        }
        if (output.reset) {
          form.trigger("reset");
        }
        if (output.html_page) {
          $(".modal .modal-dialog").html(output.html_page);
        }
      },
      error: function (response) {

        button.html(buttonText);
        button.removeAttr("disabled");
        if (response.responseJSON.errors) {
          $.each(response.responseJSON.errors, function (field, messages) {
            if (
              $("input[name='" + field + "']")
              .next()
              .find(".invalid-feedback")
            ) {
              $("input[name='" + field + "']")
                .next(".invalid-feedback")
                .remove();
            }
            $("input[name='" + field + "']").addClass("is-invalid");
            $("input[name='" + field + "']").after('<div class="invalid-feedback" >' +  messages[0] +"</div>");

            if($("."+field+"-errors").length){
                $("."+field+"-errors").html(messages[0]);
            }

            $("textarea[name='" + field + "']").addClass("is-invalid");
            $("textarea[name='" + field + "']").after('<div class="invalid-feedback" >' +  messages[0] +"</div>");



            if ($("select[name=" + field + "]").length) {
                $("select[name=" + field + "]").addClass("custom-invalid");
            }
          });


        }

        errorMessage(getError(response), false);
      },
    });
  });



  $(document).on("click", ".ajax-delete, #ajax-delete", function (e) {
    e.preventDefault();

    Swal.fire({
      icon: "warning",
      text: "Do you want to delete this?",
      showCancelButton: true,
      confirmButtonText: "Delete",
      confirmButtonColor: "#e3342f",
    }).then((result) => {
      if (result.isConfirmed) {
        let self = $(this);
        let buttonText = self.html();
        self.html("wait...");
        $.ajax({
          url: $(this).attr("href"),
          method: "DELETE",
          headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
          },
          success: function (output) {
            self.html(buttonText);
            if (output.status) {
              successMessage(output.message, output.button);
            } else {
              errorMessage(output.message);
            }
            if (output.url) {
              window.location.href = output.url;
            }
            if (output.table) {
              $('.table').DataTable().draw(true);
            }
            if (output.html_page) {
              $(".modal .modal-dialog").html(output.html_page);
            }
          },
          error: function (response) {
            self.html(buttonText);
            errorMessage(getError(response));
          },
        });
      }
    });
  });



  $(document).on("click", ".ajax-click-page, #ajax-click-page", function (e) {
    $("#exampleModal").modal({
      backdrop: "static",
      keyboard: false, // to prevent closing with Esc button (if you want this too)
    });
    e.preventDefault();
    let self = $(this);
    let modal = $(".modal");
    let buttonText = self.html();
    self.text("wait...");
    modal.modal("show");
    $.ajax({
      url: $(this).attr("href"),
      success: function (output) {
        $(".modal .modal-dialog").html(output);
        self.html(buttonText);
      },
      error: function (response) {
        self.html(buttonText);
        modal.modal("hide");
        errorMessage(getError(response));
      },
    });
  });


});



function getError(response) {

  let message = response.responseJSON.message;
  message += response.responseJSON.file ?
    " on " + response.responseJSON.file :
    "";
  message += response.responseJSON.line ?
    " on Line : " + response.responseJSON.line :
    "";
  return message;
}

function successMessage(message = null, button = false) {
  Swal.fire({
    icon: "success",
    html: message,
    showConfirmButton: button ? true : false,
    timer: button ? 100000 : 1000,
  });
}

function errorMessage(message = null, modalhide = true) {
  // if (modalhide) {
  //   $('.modal-backdrop').remove();
  //   $('.modal').remove();
  // }

  Swal.fire({
    icon: "error",
    title: "Oops...",
    html: message === null ? "Something went Wrong" : message,
  });
}
