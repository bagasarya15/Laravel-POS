$(function () {
    //Start-Preview Image
    $("input[name=image]").change(function () {
        let img = $(this);
        let imgPreview = $(".img-preview");
        let getFile = new FileReader();

        getFile.readAsDataURL(img[0].files[0]);

        getFile.onload = function (e) {
            imgPreview[0].src = e.target.result;
        };
    });
    //End Preview Image //

    //Start-Sweet Alert //
    $(".btn-delete").on("click", function (e) {
        e.preventDefault();
        let form = $(this).parents("form");
        Swal.fire({
            title: "Konfirmasi Hapus!",
            text: "Yakin ingin menghapus data ini ?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya, Hapus !",
            cancelButtonText: "Batal",
        }).then((result) => {
            if (result.value) {
                form.submit();
            }
        });
    });

    $(".btn-logout").on("click", function (e) {
        e.preventDefault();
        const url = $(this).attr("href");
        console.log(url);
        Swal.fire({
            title: "Konfirmasi Logout !",
            text: "Anda Yakin Ingin Logout ?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya, Logout !",
            cancelButtonText: "Batal",
        }).then(function (result) {
            if (result.value) {
                document.location.href = url;
            }
        });
    });

    const FlasherSuccess = $(".success-message").data("message");
    if (FlasherSuccess) {
        Swal.fire({
            position: "center",
            icon: "success",
            title: FlasherSuccess,
            showConfirmButton: false,
            type: "success",
            timer: 2000,
        });
    }

    const FlasherError = $(".error-message").data("message");
    if (FlasherError) {
        Swal.fire({
            position: "center",
            icon: "error",
            title: FlasherError,
            showConfirmButton: false,
            type: "error",
            timer: 2000,
        });
    }

    const FlasherWarning = $(".warning-message").data("message");
    if (FlasherWarning) {
        Swal.fire({
            position: "center",
            icon: "warning",
            title: FlasherWarning,
            showConfirmButton: false,
            type: "warning",
            timer: 2000,
        });
    }

    const FlasherInfo = $(".info-message").data("message");
    if (FlasherInfo) {
        Swal.fire({
            position: "center",
            icon: "info",
            title: FlasherInfo,
            showConfirmButton: false,
            type: "info",
            timer: 2000,
        });
    }
    // End-Sweet Alert //
});

// ToasTr Alert //
// let successMessage = $(".success-message").data("message");
// let errorMessage = $(".error-message").data("message");
// let infoMessage = $(".info-message").data("message");
// let warningMessage = $(".warning-message").data("message");

// toastr.options = {
//     positionClass: "toast-top-right",
//     timeOut: "5000",
//     closeButton: true,
//     debug: false,
//     newestOnTop: true,
//     progressBar: true,
//     preventDuplicates: true,
//     onclick: null,
//     showDuration: "500",
//     hideDuration: "1000",
//     extendedTimeOut: "1000",
//     showEasing: "swing",
//     hideEasing: "linear",
//     showMethod: "show",
//     hideMethod: "hide",
//     tapToDismiss: false,
//     preventOpenDuplicates: true,
// };

// if (successMessage) {
//     toastr.success(successMessage);
// }
// if (errorMessage) {
//     toastr.error(errorMessage);
// }
// if (infoMessage) {
//     toastr.info(infoMessage);
// }
// if (warningMessage) {
//     toastr.warning(warningMessage);
// }
// End-ToasTr //
