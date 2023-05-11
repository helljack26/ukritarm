$(document).ready(function () {
    const hiddenNpBlock = $("#hidden_novaposhta")
    const hiddenNpList = $("#hidden_novaposhta_block")
    const hiddenNpArrow = $(".hidden_novaposhta_header_arrow")

    let isOpenHiddenNpList = false;

    const openNPdropdown = () => {

        hiddenNpBlock.show();
        hiddenNpList.scrollTop(0);
        hiddenNpArrow.addClass('hidden_novaposhta_header_arrow_active');
        isOpenHiddenNpList = true;
    }
    const closeNPdropdown = () => {
        $('#novaposhta_search_department').val('');
        hiddenNpArrow.removeClass('hidden_novaposhta_header_arrow_active');
        isOpenHiddenNpList = false;
        hiddenNpBlock.hide();
        $(".hidden_novaposhta_block_item").css('display', 'block')
    }

    // 
    // Nova poshta initial browse departments
    // 
    $.ajax({
        type: "POST",
        url: "/components/my-cart/nova_poshta_query.php",
        data: {
            sel_city: "2",
            code_city: $(".nova_poshta_city_btn").attr("data"),
        },
        success: function (data) {
            hiddenNpList.html(data);
        },
    });

    // 
    // Np header event
    // 
    $(".hidden_novaposhta_header").click(function (event) {
        if (isOpenHiddenNpList === true) {
            closeNPdropdown()
            return
        }

        if ($(".nova_poshta_city_btn").first().attr("data") !== '8d5a980d-391c-11dd-90d9-001a92567626' ||
            location.pathname == '/admin/order_details.php') {
            hiddenNpList.html('');
            $.ajax({
                type: "POST",
                url: "/components/my-cart/nova_poshta_query.php",
                data: {
                    sel_city: "2",
                    code_city: $(".nova_poshta_city_btn").attr("data"),
                },
                success: function (data) {
                    hiddenNpList.html(data);
                    openNPdropdown();
                },
            });
        } else {
            openNPdropdown();
        }
        return false;
    });


    // 
    // Search nova poshta by field
    // 
    $("#novaposhta_search_department").on("input", function () {
        const searchValue = $(this).val().toLowerCase();
        $(".hidden_novaposhta_block_item").css("background", "#fff");

        $(".hidden_novaposhta_block_item").each(function () {
            const currentOptionText = $(this).text().toLowerCase();;
            if (currentOptionText.includes(searchValue)) {
                $(this).css('display', 'block')
            } else {
                $(this).css('display', 'none')
            }
        });
    });

    // 
    // Click on arrow
    // 
    $(".hidden_novaposhta_header_arrow").on("click", function () {
        hiddenNpBlock.toggle();
        hiddenNpArrow.toggleClass('hidden_novaposhta_header_arrow_active');
    });


    // Close popups if click outside
    $(document).click(function (e) {
        // Закрити пошук
        const hiddenNpContainer = $(".my_cart_delivery_block_item_hidden_np");
        if (hiddenNpContainer.has(e.target).length === 0) {
            closeNPdropdown();
        }
    });

    // 
    // Click on department
    // 
    $(document).on(
        "click",
        ".hidden_novaposhta_block_item",
        function () {
            $(".hidden_novaposhta_header_text").removeClass("hidden_novaposhta_header_text_error");
            $(".hidden_novaposhta_block_item").css("background", "#fff");
            $(this).css("background", "#001f4846");
            $(".hidden_novaposhta_header_text").text($(this).text().trim());

            if ($(".order_department_np_hidden")) {
                $(".order_department_np_hidden").val($(this).text().trim());
            }

            delivery = $(this).text().trim();
            closeNPdropdown();

            return false;
        }
    );
});




// City popup
$(document).ready(function () {

    let isOpenCityPopup = false;

    const openNPCityPopup = () => {
        $("#np_city_popup").fadeIn();
        isOpenCityPopup = true;
    }
    const closeNPCityPopup = () => {
        $("#np_city_popup").fadeOut();
        $("#novaposhta_search_city").val('');
        $("#hidden_novaposhta_city_block").html('');
        isOpenCityPopup = false;
    }

    // Open popup
    $(".nova_poshta_city_btn").click(function () {
        openNPCityPopup();
    });

    // Close popup
    $(document).on("click", ".np_city_popup_content_header_close, .np_city_popup_bg", function () {
        closeNPCityPopup()
    });

    $(document).keyup(function (e) {
        if (e.key === "Escape" && isOpenCityPopup === true) {
            isOpenCityPopup = false;
            closeNPCityPopup()
        }
    });

    // Choose city and close popup
    $(document).on("click", ".city_name", function () {
        const thisText = $(this).text().trim();

        const isPopularParent = $(this).parent().attr('class').includes('np_city_popup_content_popular');

        if (isPopularParent) {
            $('.np_city_popup_content_popular').children('.city_name').removeClass('city_name_active')
            $(this).addClass('city_name_active')
        } else {
            $('.np_city_popup_content_popular').children('.city_name').each(function () {
                const currentOptionText = $(this).text().toLowerCase();;

                currentOptionText.includes(thisText.toLowerCase()) ?
                    $(this).addClass('city_name_active') :
                    $(this).removeClass('city_name_active')
            });
        }
        $(".nova_poshta_city_btn").text(thisText);
        $(".nova_poshta_city_btn").attr("data", $(this).attr("code"));

        // For admin order history fields
        if ($(".nova_poshta_city_btn_hidden")) {
            $(".nova_poshta_city_btn_hidden").val(thisText);
        }
        if ($(".nova_poshta_city_btn_hidden_hash")) {
            $(".nova_poshta_city_btn_hidden_hash").val($(this).attr("code"));
        }


        $(".hidden_novaposhta_header_text").text('Оберіть потрібне Вам відділення із списку');

        closeNPCityPopup();
        return false;
    });


    // Popup city search
    $("#novaposhta_search_city").on("input", function () {
        const query = $(this).val().trim();

        if (query.length < 2) return

        $.ajax({
            type: "POST",
            beforeSend: function () {
                $("#hidden_novaposhta_city_block").html('');
                $("#np_city_popup_load").show();
            },
            url: "/components/my-cart/nova_poshta_query.php",
            data: {
                search: "1",
                text: query,
            },
            success: function (data) {
                $("#hidden_novaposhta_city_block").html(data);
                $("#np_city_popup_load").hide();
            }
        });
    });
})