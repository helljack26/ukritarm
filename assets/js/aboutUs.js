$(document).ready(function () {
    const tabs = {
        1: {
            wrapper: '#about_company_wrapper',
            button: '#btn_about_company',
            hash: '#about_company'
        },
        2: {
            wrapper: '#manufacture_wrapper',
            button: '#btn_manufacture',
            hash: '#manufacture'
        },
        3: {
            wrapper: '#gallery_wrapper',
            button: '#btn_gallery',
            hash: '#gallery'
        }
    };

    const scrollToTab = (tabId) => {
        const scrollTab = $(tabId);
        $("html:not(:animated),body:not(:animated)").animate({
                scrollTop: scrollTab.offset().top - 120,
            },
            500
        );
    }

    // Set active link to account sidebar
    let currentHash = location.hash;
    let isOnce = false;
    // Show tab action
    const showTab = (activeButton, activeTab, activeHash) => {
        if (currentHash === activeHash) {
            $(activeButton).addClass("about_tabs_links_active");
            $(activeTab).show();
        } else if (currentHash === '' && isOnce === false) {
            $(tabs[1].button).addClass("about_tabs_links_active");
            $(tabs[1].wrapper).show();
            isOnce = true;
        }

        $(activeButton).click(function () {
            for (const tab in tabs) {
                const {
                    wrapper,
                    button,
                    hash
                } = tabs[tab];

                if (wrapper === activeTab) {
                    $(button).addClass("about_tabs_links_active");
                    $(activeTab).show();
                    location.hash = hash;
                    scrollToTab(activeTab);

                } else {
                    $(button).removeClass("about_tabs_links_active");
                    $(wrapper).hide();
                };
            }
        });
    }

    showTab(tabs[1].button, tabs[1].wrapper, tabs[1].hash);
    showTab(tabs[2].button, tabs[2].wrapper, tabs[2].hash);
    showTab(tabs[3].button, tabs[3].wrapper, tabs[3].hash);

    // Scroll to tab top on load
    switch (currentHash) {
        case tabs[1].hash:
            scrollToTab(tabs[1].wrapper)
            break;

        case tabs[2].hash:
            scrollToTab(tabs[2].wrapper)
            break;

        case tabs[3].hash:
            scrollToTab(tabs[3].wrapper)
            break;

        default:
            break;
    }
});