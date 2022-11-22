"use strict";
var KTSigninGeneral = function() {
    var t, e, i;
    return {
        init: function() {
            t = document.querySelector("#kt_sign_in_form"), e = document.querySelector("#kt_sign_in_submit"), i = FormValidation.formValidation(t, {
                fields: {
                    email: {
                        validators: {
                            notEmpty: {
                                message: "Email wajib di isi"
                            },
                            emailAddress: {
                                message: "Format email tidak sesuai"
                            }
                        }
                    },
                    password: {
                        validators: {
                            notEmpty: {
                                message: "Password wajib di isi"
                            }
                        }
                    }
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger,
                    bootstrap: new FormValidation.plugins.Bootstrap5({
                        rowSelector: ".fv-row"
                    })
                }
            }), e.addEventListener("click", (function(n) {
                n.preventDefault(), i.validate().then((function(i) {
                    "Valid" == i ? (e.setAttribute("data-kt-indicator", "on"), e.disabled = !0, setTimeout((function() {
                        e.removeAttribute("data-kt-indicator"), e.disabled = !1, Swal.fire({
                            text: "Login berhasil",
                            icon: "success",
                            buttonsStyling: !1,
                            confirmButtonText: "Ok",
                            customClass: {
                                confirmButton: "btn btn-primary"
                            }
                        }).then((function(e) {
                            e.isConfirmed && (t.querySelector('[name="email"]').value = "", t.querySelector('[name="password"]').value = "")
                        }))
                    }), 2e3)) : Swal.fire({
                        text: "Email dan Password tidak ditemukan",
                        icon: "error",
                        buttonsStyling: !1,
                        confirmButtonText: "Ok",
                        customClass: {
                            confirmButton: "btn btn-primary"
                        }
                    })
                }))
            }))
        }
    }
}();
KTUtil.onDOMContentLoaded((function() {
    KTSigninGeneral.init()
}));