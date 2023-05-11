$(document).ready(function () {
   let scrollHeight = 260;

   // If content bigger than scroll height add shadow on bottom
   $('.news_list_item_content_scroll_text').each(function (i) {
      const itemHeight = $(this).height();
      if (itemHeight > scrollHeight) {
         $(this).parent().addClass('news_list_item_content_scroll_shadow_bottom')
      }
   });


   const setScrollHeight = () => {

      if (window.matchMedia("(min-width: 1400px)").matches) {
         scrollHeight = 260;
      }
      if (window.matchMedia("(max-width: 1400px)").matches) {
         scrollHeight = 230;
      }
   }

   window.onresize = function () {
      setScrollHeight()
   }
});