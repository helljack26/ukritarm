$(document).ready(function () {

    // Show link on hover card
    $(".product_small_card").mouseenter(function () {
        const dataHash = `link${$(this).attr('data-hash')}`
        const linkId = `.${dataHash}`
        $(this).addClass('product_small_card_hover')
        $(linkId).addClass('popularProduct_slider_links_link_hovered')
    });


    // If leave from intro remove all animation
    $(".product_small_card").mouseleave(function (e) {
        const thisSliderItem = this;
        const currentLinkClass = `link${$(this).attr('data-hash')}`;

        function hoverRemove(e) {
            const classListArr = e.target.classList !== undefined ? e.target.classList : [];

            let isOnCurrentLink = false;
            classListArr.forEach(element => {
                if (element === currentLinkClass) {
                    isOnCurrentLink = true;
                }
            });

            if (!isOnCurrentLink) {
                $(thisSliderItem).removeClass('product_small_card_hover')
                $(`.${currentLinkClass}`).removeClass('popularProduct_slider_links_link_hovered')
                isOnCurrentLink = false
                document.removeEventListener("mouseover", hoverRemove);
            }
        }
        document.addEventListener("mouseover", hoverRemove);
    });
})