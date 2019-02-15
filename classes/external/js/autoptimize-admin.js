(function($) {
  "use strict";

  /**
   * All of the code for your admin-facing JavaScript source
   * should reside in this file.
   *
   * Note: It has been assumed you will write jQuery code here, so the
   * $ function reference has been prepared for usage within the scope
   * of this function.
   *
   * This enables you to define handlers, for when the DOM is ready:
   *
   * $(function() {
   *
   * });
   *
   * When the window is loaded:
   *
   * $( window ).load(function() {
   *
   * });
   *
   * ...and/or other possibilities.
   *
   * Ideally, it is not considered best practise to attach more than a
   * single DOM-ready or window-load handler for a particular page.
   * Although scripts in the WordPress core, Plugins and Themes may be
   * practising this, we should strive to set a better example in our own work.
   */

  jQuery(document).ready(function($) {
    
    /**
     * New impementation as fnction
     * stored_value_array: the value given by php array
     * list_container: where all list element will be added
     * tmpl: resource template id
     * add_btn: id of the button that will add the row
     * default_data: default object that will be used to add row
     * remove_row: class of element that will remove row
     */

    function pi_new_field(
      stored_value_array,
      list_container,
      tmpl,
      add_btn,
      default_data,
      remove_row
    ) {
      this.stored_value_array = stored_value_array;
      this.list_container = list_container;
      this.tmpl = tmpl;
      this.add_btn = add_btn;
      this.default_data = default_data;
      this.remove_row = remove_row;
      /**
       * populating based on stored value
       */
      if (typeof window[this.stored_value_array] != "undefined") {
        this.count =
          window[this.stored_value_array].length == 0
            ? 0
            : window[this.stored_value_array].length;

        jQuery("#" + this.list_container).append(
          jQuery("#" + this.tmpl).render(
            window[this.stored_value_array].map(function(val, index) {
              console.log({ count: index, value: val });
              return { count: index, value: val };
            })
          )
        );
      }

      /**
       * Adding
       */
      $("#" + this.add_btn).click(() => {
        var data = {
          count: this.count,
          value: this.default_data
        };
        var template = $.templates("#" + this.tmpl);
        var htmlOutput = template.render(data);
        $("#" + this.list_container).append(htmlOutput);
        this.count++;
      });

      /**
       * Removing
       */
      $(document).on("click", "." + this.remove_row, e => {
        var selected = $(e.currentTarget).parent();
        selected.remove();
        this.count--;
      });
    }

    /**
     * general push list resources
     */
    new pi_new_field(
      "general_push_list",
      "push-resource-list",
      "resource_tmpl",
      "add_resource_to_push",
      {
        url: "",
        as: "",
        to: "",
        apply_to: "all"
      },
      "remove_resource_to_push"
    );

    /**
     * CSS async list
     */
    new pi_new_field(
      "general_async_css_list",
      "css-resource-list",
      "async_css_list_tmpl",
      "add_css",
      {
        css: "",
        to: "",
        apply_to: "all"
      },
      "remove_css_resource"
    );

    /**
     * JSS async list
     */
    new pi_new_field(
      "general_async_js_list",
      "js-resource-list",
      "async_js_list_tmpl",
      "add_js",
      {
        js: "",
        to: "",
        apply_to: "all"
      },
      "remove_js_resource"
    );
  });
})(jQuery);
