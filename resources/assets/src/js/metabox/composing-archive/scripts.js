'use strict'

import jQuery from 'jquery'
import 'presstify-framework/field/toggle-switch/js/scripts'

jQuery(document).ready(function ($) {
  $('#poststuff #ArchiveBannerAdjust-switcher').on('toggle-switch:change toggle-switch:init', function () {
    let $target = $($(this).data('target'))

    if ($(this).val() === 'on') {
      $target.attr('data-format', 'contain')
    } else {
      $target.attr('data-format', 'cover')
    }
  })
})