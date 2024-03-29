! function (t) {
	"use strict";
	var e = function () {};
	e.prototype.init = function () {
		t("#sa-basic").on("click", function () {
			swal("Any fool can use a computer").catch(swal.noop)
		}), t("#sa-title").click(function () {
			swal("The Internet?", "That thing is still around?", "question")
		}), t("#sa-success").click(function () {
			swal({
				title: "Good job!",
				text: "You clicked the button!",
				type: "success",
				showCancelButton: !0,
				confirmButtonClass: "btn btn-success",
				cancelButtonClass: "btn btn-danger m-l-10"
			})
		}), t("#sa-warning").click(function () {
			swal({
				title: "Estas seguro?",
				text: "Esta opción no se puede deshacer!",
				type: "warning",
				showCancelButton: !0,
				confirmButtonClass: "btn btn-success",
				cancelButtonClass: "btn btn-danger m-l-10",
				cancelButtonText: "Cancelar",
				confirmButtonText: "Si, borrar"
			}).then(function () {
                window.location.href = "URL para borrar.php";
				//swal("Deleted!", "Your file has been deleted.", "success")
			})
		}), t("#sa-params").click(function () {
			swal({
				title: "Are you sure?",
				text: "You won't be able to revert this!",
				type: "warning",
				showCancelButton: !0,
				confirmButtonText: "Yes, delete it!",
				cancelButtonText: "No, cancel!",
				confirmButtonClass: "btn btn-success",
				cancelButtonClass: "btn btn-danger m-l-10",
				buttonsStyling: !1
			}).then(function () {
				swal("Deleted!", "Your file has been deleted.", "success")
			}, function (t) {
				"cancel" === t && swal("Cancelled", "Your imaginary file is safe :)", "error")
			})
		}), t("#sa-image").click(function () {
			swal({
				title: "Sweet!",
				text: "Modal with a custom image.",
				imageUrl: "assets/images/logo.png",
				imageHeight: 30,
				animation: !1
			})
		}), t("#sa-close").click(function () {
			swal({
				title: "Auto close alert!",
				text: "I will close in 2 seconds.",
				timer: 2e3
			}).then(function () {}, function (t) {
				"timer" === t && console.log("I was closed by the timer")
			})
		}), t("#custom-html-alert").click(function () {
			swal({
				title: "<i>HTML</i> <u>example</u>",
				type: "info",
				html: 'You can use <b>bold text</b>, <a href="//Mannatthemes.in/">links</a> and other HTML tags',
				showCloseButton: !0,
				showCancelButton: !0,
				confirmButtonClass: "btn btn-success",
				cancelButtonClass: "btn btn-danger m-l-10",
				confirmButtonText: '<i class="fa fa-thumbs-up"></i> Great!',
				cancelButtonText: '<i class="fa fa-thumbs-down"></i>'
			})
		}), t("#custom-padding-width-alert").click(function () {
			swal({
				title: "Custom width, padding, background.",
				width: 600,
				padding: 100,
				background: "#fff url(//subtlepatterns2015.subtlepatterns.netdna-cdn.com/patterns/geometry.png)"
			})
		}), t("#ajax-alert").click(function () {
			swal({
				title: "Submit email to run ajax request",
				input: "email",
				showCancelButton: !0,
				confirmButtonText: "Submit",
				showLoaderOnConfirm: !0,
				confirmButtonClass: "btn btn-success",
				cancelButtonClass: "btn btn-danger m-l-10",
				preConfirm: function (n) {
					return new Promise(function (t, e) {
						setTimeout(function () {
							"taken@example.com" === n ? e("This email is already taken.") : t()
						}, 2e3)
					})
				},
				allowOutsideClick: !1
			}).then(function (t) {
				swal({
					type: "success",
					title: "Ajax request finished!",
					html: "Submitted email: " + t
				})
			})
		}), t("#chaining-alert").click(function () {
			swal.setDefaults({
				input: "text",
				confirmButtonText: "Next &rarr;",
				showCancelButton: !0,
				animation: !1,
				progressSteps: ["1", "2", "3"]
			});
			swal.queue([{
				title: "Question 1",
				text: "Chaining swal2 modals is easy"
			}, "Question 2", "Question 3"]).then(function (t) {
				swal.resetDefaults(), swal({
					title: "All done!",
					html: "Your answers: <pre>" + JSON.stringify(t) + "</pre>",
					confirmButtonText: "Lovely!",
					showCancelButton: !1
				})
			}, function () {
				swal.resetDefaults()
			})
		}), t("#dynamic-alert").click(function () {
			swal.queue([{
				title: "Your public IP",
				confirmButtonText: "Show my public IP",
				text: "Your public IP will be received via AJAX request",
				showLoaderOnConfirm: !0,
				preConfirm: function () {
					return new Promise(function (e) {
						t.get("https://api.ipify.org?format=json").done(function (t) {
							swal.insertQueueStep(t.ip), e()
						})
					})
				}
			}])
		})
	}, t.SweetAlert = new e, t.SweetAlert.Constructor = e
}(window.jQuery),
function (t) {
	"use strict";
	window.jQuery.SweetAlert.init()
}();