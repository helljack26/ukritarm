$(document).ready(function () {
    // Initial on focus shift cursor to end 
    const initialVal = $('#search_header_input').val();
    $('#search_header_input').focus().val('').val(initialVal);

    const getSearchList = () => {
        const search = $('#search_header_input').val().trim();

        $.ajax({
            type: "POST",
            url: "functions/search_fields.php",
            data: {
                q: search,
                search: "2",
            },
            success: function (data) {
                if (data.trim().length !== 0) {
                    $(".product_category_row_results_block_empty").hide();
                    $("#product_category_row_results").html(data);
                } else {
                    $("#product_category_row_results").html('');
                    $(".product_category_row_results_block_empty").show();
                }
                if (search.length === 0) {
                    $(".product_category_row_results_block_empty").hide();
                }
            },
        });
    }

    // Initial load list
    getSearchList()

    // After button click load list
    $("#search_header_row_button").on("click", function () {
        getSearchList()
    });

    // After enter press load list
    $("#search_header_input").on("keyup", function (e) {
        if (e.keyCode === 13 && $(this).val().length > 0) getSearchList()
    });

    // Load more logic
    let alreadyExist = 30;
    const step = 30;
    let isCanGet = 0;

    $(window).on('scroll', function (e) {
        var loadMore = $('#loadMore');
        const offsetTop = loadMore[0].offsetTop - 1500;
        const offsetWindowTop = $(window).scrollTop();
        let isSeeLoader = offsetTop < offsetWindowTop;
        if (isSeeLoader && isCanGet === 0) {
            isCanGet = 1;
            $('#loadMore').hide();
            setTimeout(() => {
                async function asyncCall() {
                    const result = await load_more_data({
                        start: alreadyExist,
                        end: alreadyExist + step,
                    });
                }
                asyncCall();
            }, 2000);
        }
    });

    function load_more_data({
        start,
        end
    }) {
        return new Promise(resolve => {
            $.ajax({
                type: 'POST',
                url: '../functions/load_more_products.php',
                data: {
                    start: start,
                    end: end,
                    searchQuery: $('#search_header_input').val(),
                },
                success: function (data) {
                    alreadyExist += step;
                    $('#product_category_row_results').append(data);
                    setTimeout(function () {
                        $('#loadMore').show();
                        isCanGet = 0;
                    }, 3000);
                    return
                }
            });
        });
    }

});