<!-- src => https://www.w3schools.com/howto/howto_js_scroll_to_top.asp -->

<button onclick="topFunction()" id="back-to-top" title="Go to top" class="btn btn-dark text-white rounded-pill p-2">
    <i class="fas fa-space-shuttle fa-rotate-270"></i>
</button>

<style>
    #back-to-top {
        display: none;
        /* Hidden by default */
        position: fixed;
        /* Fixed/sticky position */
        bottom: 20px;
        /* Place the button at the bottom of the page */
        right: 30px;
        /* Place the button 30px from the right */
        z-index: 99;
        /* Make sure it does not overlap */
        cursor: pointer;
        font-size: 18px;
    }
</style>

<script>
    //Get the button:
    mybutton = document.getElementById("back-to-top");

    // When the user scrolls down 20px from the top of the document, show the button
    window.onscroll = function() {
        scrollFunction()
    };

    function scrollFunction() {
        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
            mybutton.style.display = "block";
        } else {
            mybutton.style.display = "none";
        }
    }

    // When the user clicks on the button, scroll to the top of the document
    function topFunction() {
        document.body.scrollTop = 0; // For Safari
        document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
    }
</script>