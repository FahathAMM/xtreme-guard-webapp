<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 50">
    <circle fill="white" stroke="white" stroke-width="2" r="10" cx="20" cy="20">
        <animate attributeName="cy" calcMode="spline" dur="2s" values="20;40;20;" keySplines=".5 0 .5 1;.5 0 .5 1"
            repeatCount="indefinite" begin="-.4">
        </animate>
    </circle>
    <circle fill="white" stroke="white" stroke-width="2" r="10" cx="50" cy="20">
        <animate attributeName="cy" calcMode="spline" dur="2s" values="20;40;20;" keySplines=".5 0 .5 1;.5 0 .5 1"
            repeatCount="indefinite" begin="-.2">
        </animate>
    </circle>
    <circle fill="white" stroke="white" stroke-width="2" r="10" cx="80" cy="20">
        <animate attributeName="cy" calcMode="spline" dur="2s" values="20;40;20;" keySplines=".5 0 .5 1;.5 0 .5 1"
            repeatCount="indefinite" begin="0">
        </animate>
    </circle>
</svg>

@push('scripts')
    <script src="{{ asset('assets/js/ajax.js') }}"></script>
    <script src="{{ asset('assets/js/custom-table.js') }}"></script>
    <script src="{{ asset('assets/js/helper.js') }}"></script>

    <script>
        const wrapMapLinks = document.querySelectorAll('.wrap-map a');

        setTimeout(() => {
            wrapMapLinks.forEach(link => {
                link.style.display = 'none';
            });
        }, 2 * 1000);

        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll(".load-btn").forEach(function(btn) {
                btn.addEventListener("click", function() {
                    btn.classList.add("loading");

                    // Select the span containing the "Submit" text
                    let textSpan = btn.querySelector(".text.text-button > span");
                    if (textSpan) {
                        textSpan.classList.add("d-none"); // Hide the text
                    }

                    // setTimeout(() => {
                    //     btn.classList.remove("loading");
                    //     textSpan.classList.remove("d-none"); // Hide the text
                    // }, 3000); // 3 seconds
                });
            });
        });
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
