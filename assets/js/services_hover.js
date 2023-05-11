$(document).ready(function () {
    const setScrollHeight = () => {
        $(".services_row_results_item").mouseenter(function () {
            const thisItem = this;
            // Get heights and name distance to bottom
            const itemHeight = $(this).height();
            // Name height
            const itemName = $(this).children('.services_row_results_item_name');
            const nameHeight = itemName.height();

            const distanceToBottom = (itemHeight - nameHeight) / 2;

            // Hidden block
            const hiddenBlock = $(this).children('.services_row_results_item_hidden');
            const hiddenBlockHeight = hiddenBlock.height() + 40;

            // If hidden block height bigger than current distance to bottom add new bottom value 
            if (hiddenBlockHeight > distanceToBottom) {
                itemName.css('bottom', hiddenBlockHeight + 35);
            }
            hiddenBlock.addClass('services_row_results_item_hidden_hovered');
        });

        // If leave from intro remove all animation
        $(".services_row_results_item").mouseleave(function () {
            $('.services_row_results_item_name').css('bottom', '50%')
            $('.services_row_results_item_hidden').removeClass(
                'services_row_results_item_hidden_hovered');
        });
    }
    if (window.matchMedia("(min-width: 993px)").matches) {
        setScrollHeight()
    }

    window.onresize = function () {
        location.reload();
    }
});