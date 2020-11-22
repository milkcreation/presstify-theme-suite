'use strict'

import jQuery from 'jquery'

jQuery(document).ready(function ($) {
  $('#poststuff #SingularHeader-switcher').on('toggle-switch:change toggle-switch:init', function () {
    let $target = $($(this).data('target'))

    if ($(this).val() === 'on') {
      $target.show()
    } else {
      $target.hide()
    }
  })
})