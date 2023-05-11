export const mobileMenu = () => {
    // Side menu action
    const openSideMenu = () => {
        // closeMobileSearchItems();

        $(".mobile-navbar-toggle").addClass("mobile-navbar-toggle_open");

        $(".mobile-navbar-collapse").animate({
                left: "0px",
            },
            "slow"
        );
        $(".mobile-navbar-collapse").attr("data", "1");
        $(".mobile_menu_bg").fadeIn("slow");
        $("body").css("overflow-y", "hidden");
        return;
    };

    const closeSideMenu = () => {
        $(".mobile-navbar-toggle").removeClass("mobile-navbar-toggle_open");

        $(".mobile-navbar-collapse").animate({
                left: "-100%",
            },
            "slow"
        );
        $(".mobile-navbar-collapse").attr("data", "0");
        $(".mobile_menu_bg").fadeOut("slow");
        $("body").css("overflow-y", "scroll");
        // Close inside items
        setTimeout(() => {
            $(".allproduct_collapsed").slideUp();
            $(".allproduct_child").slideUp();
            $(".allproduct_category_arrow").removeClass("arrow_rotate");
            $(".mobile_parent_arrow").removeClass("arrow_rotate");
            $(".prod").next("ul").slideUp();
        }, 400);
        return;
    };
    // Close side menu by swipe
    var touchstartXMenu = 0;
    var touchendXMenu = 0;

    var gestureZoneMenu = document.querySelector(".mobile_menu_bg");

    gestureZoneMenu.addEventListener(
        "touchstart",
        function (event) {
            touchstartXMenu = event.changedTouches[0].screenX;
        },
        false
    );

    gestureZoneMenu.addEventListener(
        "touchend",
        function (event) {
            touchendXMenu = event.changedTouches[0].screenX;
            handleGestureMenu();
        },
        false
    );

    function handleGestureMenu() {
        if (
            touchendXMenu < touchstartXMenu + 200 &&
            $(".mobile-navbar-collapse").css("left") == "0px"
        ) {
            closeSideMenu();
        }
    }

    // Side menu event
    $(".mobile-navbar-toggle").click(function () {
        if ($(".mobile-navbar-collapse").attr("data") == "0") {
            openSideMenu();
        } else {
            closeSideMenu();
        }
    });
    $(".mobile_menu_bg").click(function () {
        closeSideMenu();
    });

};