<a href="https://wa.me/94752388923?text=Hello!%20I%20need%20assistance%20with%20your%20services." class="whatsapp-float"
    target="_blank">
    <img src="https://static-00.iconduck.com/assets.00/whatsapp-icon-2040x2048-8b5th74o.png" alt="Chat on WhatsApp">
    <span class="whatsapp-tooltip">Chat with us on WhatsApp!</span>
</a>

<style>
    /* WhatsApp Floating Button */
    .whatsapp-float {
        position: fixed;
        bottom: 20px;
        right: 20px;
        z-index: 1000;
        display: flex;
        align-items: center;
        text-decoration: none;
    }

    /* WhatsApp Icon */
    .whatsapp-float img {
        width: 60px;
        height: 60px;
        border-radius: 50%;
    }

    /* Tooltip */
    .whatsapp-tooltip {
        background-color: #25D366;
        color: #fff;
        text-align: center;
        padding: 8px 12px;
        border-radius: 5px;
        font-size: 14px;
        white-space: nowrap;
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);

        position: absolute;
        right: 70px;
        /* Adjust based on icon size */
        bottom: 15px;

        opacity: 0;
        transform: translateX(20px);
        transition: opacity 0.5s ease-out, transform 0.5s ease-out;
    }

    /* Show Tooltip */
    .whatsapp-tooltip.show {
        opacity: 1;
        transform: translateX(0);
    }
</style>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        let tooltip = document.querySelector(".whatsapp-tooltip");

        // Show tooltip after 1 second
        // setTimeout(() => {
        //     tooltip.classList.add("show");
        //     console.log('add');

        // }, 1000);

        // // Hide tooltip after 5 seconds
        // setTimeout(() => {
        //     tooltip.classList.remove("show");
        //     console.log('remove');
        // }, 5000);

        setInterval(() => {
            tooltip.classList.add("show");
            console.log('add');
        }, 2000);

        setInterval(() => {
            tooltip.classList.remove("show");
            console.log('remove');
        }, 5000);
    });
</script>
