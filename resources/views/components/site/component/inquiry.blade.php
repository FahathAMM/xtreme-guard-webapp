 <!-- modal ask_question -->
 <div class="modal modalCentered fade tf-product-modal modal-part-content" id="ask_question">
     <div class="modal-dialog modal-dialog-centered">


         <div class="modal-content">

             <div class="header">
                 <div class="demo-title">Ask a question</div>
                 <span class="icon-close icon-close-popup" data-bs-dismiss="modal"></span>
             </div>

             <div class="msg-container my-3" style="display:none; font-family: system-ui; ">
                 <div class="alert alert-success alert-dismissible alert-label-icon label-arrow fade show mb-xl-0">
                     <i class="ri-checkbox-circle-line label-icon"></i>
                     <strong class=""style="font-size: 13px;" id="suc-msg"></strong>
                 </div>
             </div>

             <div class="overflow-y-auto">
                 {{-- <form class="">
                     <fieldset class="">
                         <label>Name *</label>
                         <input type="text" placeholder="" class="" name="text" tabindex="2"
                             value="" aria-required="true" required="">
                     </fieldset>
                     <fieldset class="">
                         <label>Email *</label>
                         <input type="email" placeholder="" class="" name="text" tabindex="2"
                             value="" aria-required="true" required="">
                     </fieldset>
                     <fieldset class="">
                         <label>Phone number</label>
                         <input type="number" placeholder="" class="" name="text" tabindex="2"
                             value="" aria-required="true" required="">
                     </fieldset>
                     <fieldset class="">
                         <label>Message</label>
                         <textarea name="message" rows="4" placeholder="" class="" tabindex="2" aria-required="true"
                             required=""></textarea>
                     </fieldset>
                     <button type="submit" class="btn-style-2 w-100"><span class="text">Send</span></button>
                 </form> --}}
                 <form id="contact-form" action="{{ url('contact') }}" method="post" class="form-leave-comment">
                     @csrf
                     <div class="wrap">
                         <div class="cols">
                             <fieldset class="">

                                 <input type="hidden" name="product_id" id="product_id">
                                 <input type="hidden" name="product_name" id="product_name">
                                 {{-- <input class="frm" type="text" placeholder="Your Name*" name="name"
                                     id="name" tabindex="2" value="" aria-required="true" required=""> --}}

                                 <input class="frm" type="text" placeholder="Your Name*" name="name"
                                     id="name" tabindex="2" value="" aria-required="true" required="">
                                 <div class="invalid-feedback d-block invalid-msg"> </div>
                             </fieldset>
                             <fieldset class="">
                                 <input class="frm" type="text" placeholder="Your Email*" name="email"
                                     id="email" tabindex="2" value="" aria-required="true" required="">
                                 <div class="invalid-feedback d-block invalid-msg"> </div>
                             </fieldset>
                         </div>

                         {{-- <div class="cols">
                             <fieldset class="">
                                 <input class="frm" type="text" placeholder="Your Phone" name="phone"
                                     id="phone" tabindex="2" value="" aria-required="true" required="">
                                 <div class="invalid-feedback d-block invalid-msg"> </div>
                             </fieldset>
                             <fieldset class="">
                                 <input class="frm" type="text" placeholder="Your Email*" name="email"
                                     id="email" tabindex="2" value="" aria-required="true" required="">
                                 <div class="invalid-feedback d-block invalid-msg"> </div>
                             </fieldset>
                         </div> --}}

                         <div class="cols">
                             <fieldset class="">
                                 <input class="frm" type="text" placeholder="Enter subject*" name="subject"
                                     id="subject" tabindex="2" value="" aria-required="true" required="">
                                 <div class="invalid-feedback d-block invalid-msg"> </div>
                             </fieldset>
                         </div>

                         <fieldset class="">
                             <textarea class="frm" name="message" id="message" rows="4" placeholder="Your Message*" tabindex="2"
                                 aria-required="true" required=""></textarea>
                             <div class="invalid-feedback d-block invalid-msg"> </div>
                         </fieldset>
                     </div>
                     <div class="button-submit send-wrap">

                         <button class="tf-btns btn-fill load-btn loadings" type="button" id="btnLoader"
                             onclick="store()">
                             <span class="text text-button">
                                 <span>Send message</span>
                                 <x-site.input.btn-loader />
                             </span>
                         </button>
                     </div>
                 </form>
             </div>
         </div>
     </div>
 </div>
 <!-- /modal ask_question -->

 @push('scripts')
     <script src="{{ asset('assets/js/ajax.js') }}"></script>
     <script src="{{ asset('assets/js/custom-table.js') }}"></script>
     <script src="{{ asset('assets/js/helper.js') }}"></script>

     <script>
         function openInquiryModal(data = null) {
             $('#ask_question').modal('show');
             console.log(data);
             //  setValueByName('subject', data?.name || '');
             setValueByName('subject', `Inquiry Message for ${data?.name || 'Product'} `);
             setValueByName('product_id', data?.id);
             setValueByName('product_name', data?.name);


         }

         function eLoadingSite(btnId = 'sbtBtn') {
             let btn = document.querySelector(`#${btnId}`);

             if (btn) {
                 setTimeout(() => {
                     btn.classList.remove("loading");
                     let textSpan = btn.querySelector(".text.text-button > span");
                     if (typeof textSpan !== 'undefined') {
                         textSpan.classList.remove("d-none");
                     }
                 }, 500);
             } else {
                 console.error('Button not found.');
             }
         }


         const formName = 'contact-form'

         function store() {
             var form = document.getElementById(formName);
             var url = form.getAttribute('action');
             var method = form.getAttribute('method');
             var payload = new FormData(form);

             const options = {
                 // contentType: 'application/json',
                 contentType: 'multipart/form-data',
                 method: 'POST',
                 headers: {
                     dataType: "json",
                     'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                 }
             };
             sendData(
                 url,
                 payload,
                 options,
                 (response) => {
                     if (response.status) {
                         // $("#contact-form :input").not("#is_active").val("");
                         alertNotify(response.message, 'success')
                         associateErrors1([], 'contact-form');
                         eLoadingSite('btnLoader')

                         $('#ask_question').fadeOut(1000, function() {
                             $('#ask_question').modal('hide');
                         });

                         //  $('.error-list').empty();
                         //  setHtml('suc-msg', response.message);
                         //  $('.msg-container').show();

                         //  //  $('.msg-container').fadeOut(10 * 1000);

                         //  //  $('.msg-container').fadeOut(10 * 1000, function() {
                         //  //      $('.msg-container').hide();

                         //  //  });
                         //  $('.msg-container').fadeTo(1000, 1);
                         //  //  $('.msg-container').slideUp(10 * 1000);

                     } else {
                         associateErrors1(response.errors, 'contact-form');
                         eLoadingSite('btnLoader')

                         alertNotify(response.message, 'success')
                     }
                 },
                 (error) => {
                     console.error('Error:', error);
                 }
             );
         }

         function associateErrors1(errors, formId) {
             let $form = $(`#${formId}`);
             $form.find('fieldset .invalid-msg').text('');
             $form.find('fieldset .frm').removeClass('is-invalid');

             Object.keys(errors).forEach(function(fieldName) {

                 let $group = $form.find('[name="' + fieldName + '"]');
                 $group.addClass('is-invalid');
                 $group.closest('fieldset').find('.invalid-msg').text(errors[fieldName][0]);
             });
         }

         function alertNotify(msg, status) {

             let sts = status || 'success';

             const arr = {
                 success: 'bg-success',
                 error: 'bg-danger',
                 warning: 'bg-info',
             }
             console.log(arr[sts]);
             Toastify({
                 text: msg || '',
                 duration: 9 * 1000,
                 newWindow: true,
                 close: false,
                 gravity: "top", // `top` or `bottom`
                 position: "center", // `left`, `center` or `right`
                 stopOnFocus: true, // Prevents dismissing of toast on hover
                 className: arr[sts],
                 // style: {
                 //     background: "linear-gradient(to right, #00b09b, #96c93d)",
                 // },
                 onClick: function() {} // Callback after click
             }).showToast();
         }
     </script>
 @endpush

 <style>
     .load-btn svg {
         width: 30px;
         height: 30px;
         display: none;
     }

     .load-btn:hover {
         background: black;
         color: white;
     }

     .loading svg {
         display: inline-block;
     }



     .toast:not(:last-child) {
         margin-bottom: .75rem
     }

     .toast-border-primary .toast-body {
         color: #405189;
         border-bottom: 3px solid #405189
     }

     .toast-border-secondary .toast-body {
         color: #3577f1;
         border-bottom: 3px solid #3577f1
     }

     .toast-border-success .toast-body {
         color: #0ab39c;
         border-bottom: 3px solid #0ab39c
     }

     .toast-border-info .toast-body {
         color: #299cdb;
         border-bottom: 3px solid #299cdb
     }

     .toast-border-warning .toast-body {
         color: #f7b84b;
         border-bottom: 3px solid #f7b84b
     }

     .toast-border-danger .toast-body {
         color: #f06548;
         border-bottom: 3px solid #f06548
     }

     .toast-border-light .toast-body {
         color: #f3f6f9;
         border-bottom: 3px solid #f3f6f9
     }

     .toast-border-dark .toast-body {
         color: #212529;
         border-bottom: 3px solid #212529
     }


     .toastify {
         padding: 12px 16px;
         color: #fff;
         display: inline-block;
         -webkit-box-shadow: 0 3px 6px -1px rgba(0, 0, 0, .12), 0 10px 36px -4px rgba(77, 96, 232, .3);
         box-shadow: 0 3px 6px -1px rgba(0, 0, 0, .12), 0 10px 36px -4px rgba(77, 96, 232, .3);
         background: var(--vz-success);
         position: fixed;
         opacity: 0;
         -webkit-transition: all .4s cubic-bezier(.215, .61, .355, 1);
         transition: all .4s cubic-bezier(.215, .61, .355, 1);
         border-radius: 2px;
         cursor: pointer;
         text-decoration: none;
         max-width: calc(50% - 20px);
         z-index: 2147483647
     }

     .toastify.on {
         opacity: 1
     }

     .toast-close {
         opacity: .4;
         padding: 0 5px;
         position: relative;
         left: 4px;
         margin-left: 4px;
         border: none;
         background: 0 0;
         color: #fff
     }

     .toastify-right {
         right: 15px
     }

     .toastify-left {
         left: 15px
     }

     .toastify-left .toast-close {
         left: -4px;
         margin-left: 0;
         margin-right: 4px
     }

     .toastify-top {
         top: -150px
     }

     .toastify-bottom {
         bottom: -150px
     }

     .toastify-rounded {
         border-radius: 25px
     }

     .toastify-avatar {
         width: 1.5em;
         height: 1.5em;
         margin: -7px 5px;
         border-radius: 2px
     }

     .toastify-center {
         margin-left: auto;
         margin-right: auto;
         left: 0;
         right: 0;
         max-width: -webkit-fit-content;
         max-width: fit-content;
         max-width: -moz-fit-content
     }

     @media only screen and (max-width:360px) {

         .toastify-left,
         .toastify-right {
             margin-left: auto;
             margin-right: auto;
             left: 0;
             right: 0;
             max-width: -webkit-fit-content;
             max-width: -moz-fit-content;
             max-width: fit-content
         }
     }


     .toast {
         --vz-toast-zindex: 1090;
         --vz-toast-padding-x: 0.75rem;
         --vz-toast-padding-y: 0.5rem;
         --vz-toast-spacing: 1.5rem;
         --vz-toast-max-width: 350px;
         --vz-toast-font-size: 0.875rem;
         --vz-toast-bg: var(--vz-secondary-bg);
         --vz-toast-border-width: var(--vz-border-width);
         --vz-toast-border-color: var(--vz-border-color);
         --vz-toast-border-radius: var(--vz-border-radius);
         --vz-toast-box-shadow: var(--vz-box-shadow);
         --vz-toast-header-color: var(--vz-secondary-color);
         --vz-toast-header-bg: var(--vz-secondary-bg);
         --vz-toast-header-border-color: var(--vz-border-color);
         width: var(--vz-toast-max-width);
         max-width: 100%;
         font-size: var(--vz-toast-font-size);
         color: var(--vz-toast-color);
         pointer-events: auto;
         background-color: var(--vz-toast-bg);
         background-clip: padding-box;
         border: var(--vz-toast-border-width) solid var(--vz-toast-border-color);
         -webkit-box-shadow: var(--vz-toast-box-shadow);
         box-shadow: var(--vz-toast-box-shadow);
         border-radius: var(--vz-toast-border-radius)
     }

     .toast.showing {
         opacity: 0
     }

     .toast:not(.show) {
         display: none
     }

     .toast-container {
         --vz-toast-zindex: 1090;
         position: absolute;
         z-index: var(--vz-toast-zindex);
         width: -webkit-max-content;
         width: -moz-max-content;
         width: max-content;
         max-width: 100%;
         pointer-events: none
     }

     .toast-container>:not(:last-child) {
         margin-bottom: var(--vz-toast-spacing)
     }

     .toast-header {
         display: -webkit-box;
         display: -ms-flexbox;
         display: flex;
         -webkit-box-align: center;
         -ms-flex-align: center;
         align-items: center;
         padding: var(--vz-toast-padding-y) var(--vz-toast-padding-x);
         color: var(--vz-toast-header-color);
         background-color: var(--vz-toast-header-bg);
         background-clip: padding-box;
         border-bottom: var(--vz-toast-border-width) solid var(--vz-toast-header-border-color);
         border-top-left-radius: calc(var(--vz-toast-border-radius) - var(--vz-toast-border-width));
         border-top-right-radius: calc(var(--vz-toast-border-radius) - var(--vz-toast-border-width))
     }

     .toast-header .btn-close {
         margin-right: calc(-.5 * var(--vz-toast-padding-x));
         margin-left: var(--vz-toast-padding-x)
     }

     .toast-body {
         padding: var(--vz-toast-padding-x);
         word-wrap: break-word
     }
 </style>
