/**
 * Tutor CUF Admin - Advanced Field Management
 * Version 2.0
 */
(function($) {
    'use strict';

    var typesWithOptions = tutorCufAdmin.typesWithOptions || ['select', 'radio', 'checkbox'];
    var i18n = tutorCufAdmin.i18n || {};

    /**
     * Initialize everything on DOM ready
     */
    $(document).ready(function() {
        initTabs();
        initAddField();
        initRemoveField();
        initTypeToggle();
        initSortable();
        initLabelSync();
        initAutoMetaKey();
        initCollapsible();
    });

    /**
     * Tab switching
     */
    function initTabs() {
        $(document).on('click', '.nav-tab', function(e) {
            e.preventDefault();
            var target = $(this).attr('href');
            
            $('.nav-tab').removeClass('nav-tab-active');
            $(this).addClass('nav-tab-active');
            
            $('.tab-content').hide();
            $(target).show();
        });
    }

    /**
     * Add new field card
     */
    function initAddField() {
        // For student fields
        $(document).on('click', '#cuf_add_field', function() {
            addNewFieldCard('cuf', '#cuf_fields_container');
        });

        // For instructor fields
        $(document).on('click', '#cif_add_field', function() {
            addNewFieldCard('cif', '#cif_fields_container');
        });
    }

    function addNewFieldCard(prefix, containerSelector) {
        var templateHtml = $('#tmpl-cuf-field-row').html();
        var container = $(containerSelector);
        var newIndex = container.find('.tutor-cuf-field-card').length;

        // Replace prefix and index placeholders
        templateHtml = templateHtml.replace(/__PREFIX__/g, prefix);
        templateHtml = templateHtml.replace(/__INDEX__/g, newIndex);

        var $newCard = $(templateHtml);
        $newCard.find('.tutor-cuf-card-body').show();
        container.append($newCard);

        // Re-initialize sortable
        initSortable();

        // Scroll to new card
        $('html, body').animate({
            scrollTop: $newCard.offset().top - 100
        }, 400);
    }

    /**
     * Remove field card
     */
    function initRemoveField() {
        $(document).on('click', '.tutor-cuf-remove-btn', function() {
            var container = $(this).closest('.tutor-cuf-fields-container');
            if (container.find('.tutor-cuf-field-card').length <= 1) {
                alert(i18n.atLeastOne || 'You must have at least one field.');
                return;
            }
            if (confirm(i18n.confirmRemove || 'Are you sure you want to remove this field?')) {
                $(this).closest('.tutor-cuf-field-card').slideUp(300, function() {
                    $(this).remove();
                    reindexCards(container);
                });
            }
        });
    }

    /**
     * Toggle options textarea based on field type
     */
    function initTypeToggle() {
        $(document).on('change', '.tutor-cuf-type-select', function() {
            var type = $(this).val();
            var card = $(this).closest('.tutor-cuf-field-card');
            var optionsRow = card.find('.tutor-cuf-options-row');

            if (typesWithOptions.indexOf(type) !== -1) {
                optionsRow.slideDown(200);
            } else {
                optionsRow.slideUp(200);
            }

            // Update badge
            var selectedText = $(this).find('option:selected').text();
            card.find('.tutor-cuf-card-type-badge').text(selectedText);
        });
    }

    /**
     * Drag & drop sortable
     */
    function initSortable() {
        $('.tutor-cuf-fields-container').sortable({
            handle: '.tutor-cuf-drag-handle',
            items: '.tutor-cuf-field-card',
            placeholder: 'tutor-cuf-sortable-placeholder',
            tolerance: 'pointer',
            opacity: 0.7,
            update: function(event, ui) {
                reindexCards($(this));
            }
        });
    }

    /**
     * Re-index cards after sorting or removal
     */
    function reindexCards(container) {
        container.find('.tutor-cuf-field-card').each(function(index) {
            $(this).attr('data-index', index);
        });
    }

    /**
     * Sync label input to card header title
     */
    function initLabelSync() {
        $(document).on('input', '.tutor-cuf-label-input', function() {
            var val = $(this).val();
            var card = $(this).closest('.tutor-cuf-field-card');
            card.find('.tutor-cuf-card-title').text(val || (i18n.newField || 'New Field'));
        });
    }

    /**
     * Auto-generate meta key from label
     */
    function initAutoMetaKey() {
        $(document).on('blur', '.tutor-cuf-label-input', function() {
            var card = $(this).closest('.tutor-cuf-field-card');
            var metaKeyInput = card.find('.tutor-cuf-metakey-input');

            // Only auto-fill if meta key is empty
            if (metaKeyInput.val().trim() === '') {
                var label = $(this).val().trim();
                var metaKey = label
                    .toLowerCase()
                    .replace(/[^a-z0-9\s_]/g, '')
                    .replace(/\s+/g, '_')
                    .replace(/_+/g, '_')
                    .replace(/^_|_$/g, '');
                
                if (metaKey) {
                    metaKeyInput.val(metaKey);
                }
            }
        });
    }

    /**
     * Collapse/expand field cards
     */
    function initCollapsible() {
        $(document).on('click', '.tutor-cuf-toggle-btn, .tutor-cuf-card-title', function() {
            var card = $(this).closest('.tutor-cuf-field-card');
            var body = card.find('.tutor-cuf-card-body');
            var toggleBtn = card.find('.tutor-cuf-toggle-btn');

            body.slideToggle(200);
            toggleBtn.toggleClass('dashicons-arrow-down-alt2 dashicons-arrow-up-alt2');
        });
    }

    /**
     * Live preview for Terms Appearance sliders
     */
    function initTermsAppearanceSliders() {
        var cbSlider = $('#tutor_cuf_terms_checkbox_size');
        var txtSlider = $('#tutor_cuf_terms_text_size');

        // Apply saved values to preview on page load
        if (cbSlider.length) {
            applyCheckboxSize(cbSlider.val());
        }
        if (txtSlider.length) {
            applyTextSize(txtSlider.val());
        }

        // Checkbox size slider
        $(document).on('input', '#tutor_cuf_terms_checkbox_size', function() {
            applyCheckboxSize($(this).val());
        });

        // Text size slider
        $(document).on('input', '#tutor_cuf_terms_text_size', function() {
            applyTextSize($(this).val());
        });

        function applyCheckboxSize(val) {
            $('#tutor-cuf-cb-size-val').text(val + 'px');
            var cb = $('.tutor-cuf-terms-preview-cb');
            if (cb.length) {
                var radius = Math.max(5, Math.round(val * 0.28));
                cb.css({
                    'width': val + 'px',
                    'height': val + 'px',
                    'border-radius': radius + 'px'
                });
            }
        }

        function applyTextSize(val) {
            $('#tutor-cuf-text-size-val').text(val + 'px');
            var txt = $('.tutor-cuf-terms-preview-text');
            if (txt.length) {
                txt.css('font-size', val + 'px');
            }
            var link = $('.tutor-cuf-terms-preview-link');
            if (link.length) {
                link.css('font-size', val + 'px');
            }
        }
    }

    // Initialize sliders when DOM ready
    $(document).ready(function() {
        initTermsAppearanceSliders();
    });

})(jQuery);
