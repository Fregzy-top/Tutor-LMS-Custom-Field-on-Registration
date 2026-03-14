/**
 * Tutor CUF Frontend - Field Validation & Phone Country Dropdown
 * Version 3.0 — Modern custom country selector
 */
(function($) {
    'use strict';

    var i18n = (typeof tutorCufFront !== 'undefined') ? tutorCufFront.i18n : {};

    $(document).ready(function() {
        initPhoneFields();
        initCountryDropdowns();
        initValidation();
        initDateFields();
    });

    /* ==================================================
       Phone fields: allow ONLY numbers
       ================================================== */
    function initPhoneFields() {
        $(document).on('keypress', '.tutor-cuf-phone-field', function(e) {
            var char = String.fromCharCode(e.which || e.keyCode);
            if (/[0-9]/.test(char)) return true;
            e.preventDefault();
            return false;
        });

        $(document).on('paste', '.tutor-cuf-phone-field', function() {
            var self = this;
            setTimeout(function() {
                $(self).val($(self).val().replace(/[^0-9]/g, ''));
                updatePhoneFullValue($(self));
            }, 50);
        });

        $(document).on('input', '.tutor-cuf-phone-field', function() {
            var val = $(this).val();
            var cleaned = val.replace(/[^0-9]/g, '');
            if (val !== cleaned) $(this).val(cleaned);
            updatePhoneFullValue($(this));
        });
    }

    /* ==================================================
       Custom Country Dropdown
       ================================================== */
    function initCountryDropdowns() {
        // Toggle dropdown on trigger click
        $(document).on('click', '.tutor-cuf-country-trigger', function(e) {
            e.preventDefault();
            e.stopPropagation();
            var $trigger = $(this);
            var $dropdown = $trigger.closest('.tutor-cuf-country-dropdown');
            var $panel = $dropdown.find('.tutor-cuf-country-panel');
            var isOpen = $panel.is(':visible');

            // Close all other open panels first
            closeAllDropdowns();

            if (!isOpen) {
                $panel.css('display', 'block');
                $trigger.attr('aria-expanded', 'true');
                // Focus search input
                var $search = $panel.find('.tutor-cuf-country-search');
                $search.val('').trigger('input');
                setTimeout(function() { $search.focus(); }, 50);
                // Scroll to active item
                var $active = $panel.find('.tutor-cuf-country-active');
                if ($active.length) {
                    var $list = $panel.find('.tutor-cuf-country-list');
                    $list.scrollTop($active.position().top - $list.height() / 2 + $active.outerHeight() / 2);
                }
            }
        });

        // Search countries
        $(document).on('input', '.tutor-cuf-country-search', function() {
            var query = $(this).val().toLowerCase().trim();
            var $items = $(this).closest('.tutor-cuf-country-panel').find('.tutor-cuf-country-item');

            $items.each(function() {
                var name = ($(this).data('name') || '').toString().toLowerCase();
                var code = ($(this).data('code') || '').toString().toLowerCase();
                var match = !query || name.indexOf(query) > -1 || code.indexOf(query) > -1;
                $(this).toggle(match);
            });
        });

        // Keyboard navigation in search
        $(document).on('keydown', '.tutor-cuf-country-search', function(e) {
            var $panel = $(this).closest('.tutor-cuf-country-panel');
            var $visible = $panel.find('.tutor-cuf-country-item:visible');
            var $focused = $panel.find('.tutor-cuf-country-hover');

            if (e.key === 'ArrowDown' || e.key === 'ArrowUp') {
                e.preventDefault();
                var idx = $visible.index($focused);

                if (e.key === 'ArrowDown') {
                    idx = (idx < $visible.length - 1) ? idx + 1 : 0;
                } else {
                    idx = (idx > 0) ? idx - 1 : $visible.length - 1;
                }

                $visible.removeClass('tutor-cuf-country-hover');
                var $next = $visible.eq(idx).addClass('tutor-cuf-country-hover');

                // Scroll into view
                var $list = $panel.find('.tutor-cuf-country-list');
                var topOffset = $next.position().top;
                if (topOffset < 0) {
                    $list.scrollTop($list.scrollTop() + topOffset - 10);
                } else if (topOffset + $next.outerHeight() > $list.height()) {
                    $list.scrollTop($list.scrollTop() + topOffset - $list.height() + $next.outerHeight() + 10);
                }
            }

            if (e.key === 'Enter') {
                e.preventDefault();
                if ($focused.length) {
                    $focused.trigger('click');
                } else if ($visible.length === 1) {
                    $visible.first().trigger('click');
                }
            }

            if (e.key === 'Escape') {
                closeAllDropdowns();
            }
        });

        // Select country
        $(document).on('click', '.tutor-cuf-country-item', function(e) {
            e.stopPropagation();
            var $item = $(this);
            var $dropdown = $item.closest('.tutor-cuf-country-dropdown');
            var $wrapper = $dropdown.closest('.tutor-cuf-phone-wrapper');
            var $trigger = $dropdown.find('.tutor-cuf-country-trigger');

            var code = $item.data('code');
            var iso = $item.data('iso');
            var name = $item.data('name');

            // Mark active
            $dropdown.find('.tutor-cuf-country-item').removeClass('tutor-cuf-country-active tutor-cuf-country-hover');
            $item.addClass('tutor-cuf-country-active');

            // Update trigger display
            $trigger.html(
                '<img src="https://flagcdn.com/w40/' + iso + '.png" srcset="https://flagcdn.com/w80/' + iso + '.png 2x" class="tutor-cuf-flag-img" alt="' + escapeHtml(name) + '" width="28" height="20">' +
                '<span class="tutor-cuf-selected-code">' + escapeHtml(code) + '</span>' +
                '<svg class="tutor-cuf-chevron" width="12" height="12" viewBox="0 0 12 12" fill="none"><path d="M3 4.5L6 7.5L9 4.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>'
            );

            // Update hidden value
            $wrapper.find('.tutor-cuf-country-value').val(code);

            // Update full phone
            var $phoneInput = $wrapper.find('.tutor-cuf-phone-field');
            updatePhoneFullValue($phoneInput);

            // Close dropdown
            closeAllDropdowns();

            // Focus phone input
            $phoneInput.focus();
        });

        // Hover effect for keyboard nav
        $(document).on('mouseenter', '.tutor-cuf-country-item', function() {
            $(this).closest('.tutor-cuf-country-panel').find('.tutor-cuf-country-hover').removeClass('tutor-cuf-country-hover');
            $(this).addClass('tutor-cuf-country-hover');
        });

        // Close on outside click
        $(document).on('click', function(e) {
            if (!$(e.target).closest('.tutor-cuf-country-dropdown').length) {
                closeAllDropdowns();
            }
        });
    }

    /**
     * Close all open country dropdowns
     */
    function closeAllDropdowns() {
        $('.tutor-cuf-country-panel').hide();
        $('.tutor-cuf-country-trigger').attr('aria-expanded', 'false');
        $('.tutor-cuf-country-hover').removeClass('tutor-cuf-country-hover');
    }

    /**
     * Update the hidden full phone field (country_code + local_number)
     */
    function updatePhoneFullValue($phoneInput) {
        var $wrapper = $phoneInput.closest('.tutor-cuf-phone-wrapper');
        if (!$wrapper.length) return;

        var countryCode = $wrapper.find('.tutor-cuf-country-value').val() || '';
        var localNumber = $phoneInput.val().replace(/[^0-9]/g, '');
        var fullNumber = '';

        if (countryCode && localNumber) {
            fullNumber = countryCode + localNumber;
        } else if (localNumber) {
            fullNumber = localNumber;
        }

        $wrapper.find('.tutor-cuf-phone-full').val(fullNumber);
    }

    /* ==================================================
       Date field enhancements
       ================================================== */
    function initDateFields() {
        $('.tutor-cuf-date-field').each(function() {
            if (!$(this).attr('max')) {
                var today = new Date().toISOString().split('T')[0];
                $(this).attr('max', today);
            }
        });
    }

    /* ==================================================
       Form validation before submit
       ================================================== */
    function initValidation() {
        $(document).on('submit', 'form', function(e) {
            var $form = $(this);

            if ($form.find('.tutor-cuf-field-wrap').length === 0) {
                return true;
            }

            var isValid = true;

            $form.find('.tutor-cuf-error').remove();
            $form.find('.tutor-cuf-field-error').removeClass('tutor-cuf-field-error');

            $form.find('.tutor-cuf-field-wrap').each(function() {
                var $wrap = $(this);
                var type = $wrap.data('type');
                var $field, isRequired, value;

                // Terms & Conditions: special handling
                if (type === 'terms') {
                    var $cb = $wrap.find('.tutor-cuf-terms-checkbox');
                    if ($cb.length && !$cb.is(':checked')) {
                        var errMsg = $wrap.data('error-msg') || i18n.termsRequired || 'You must accept the Terms & Conditions to register.';
                        showError($wrap, errMsg);
                        isValid = false;
                    }
                    return;
                }

                // Phone: special handling
                if (type === 'phone') {
                    $field = $wrap.find('.tutor-cuf-phone-field');
                    isRequired = $field.prop('required');
                    value = $field.val();
                    var countryCode = $wrap.find('.tutor-cuf-country-value').val();

                    if (isRequired && (!value || value.trim() === '')) {
                        showError($wrap, i18n.required || 'This field is required.');
                        isValid = false;
                        return;
                    }

                    if (value && value.trim() !== '') {
                        if (!/^[0-9]+$/.test(value)) {
                            showError($wrap, i18n.invalidPhone || 'Please enter numbers only.');
                            isValid = false;
                            return;
                        }
                        if (!countryCode) {
                            showError($wrap, i18n.selectCountry || 'Please select your country code.');
                            isValid = false;
                            return;
                        }
                    }
                    return;
                }

                // Radio groups
                if (type === 'radio') {
                    var radioName = $wrap.find('input[type="radio"]').attr('name');
                    value = $form.find('input[name="' + radioName + '"]:checked').val() || '';
                    isRequired = $wrap.find('input[type="radio"]').first().prop('required');

                    if (isRequired && !value) {
                        showError($wrap, i18n.required || 'This field is required.');
                        isValid = false;
                    }
                    return;
                }

                // Checkbox groups
                if (type === 'checkbox') {
                    return;
                }

                // Normal fields
                $field = $wrap.find('input, select, textarea').first();
                isRequired = $field.prop('required');
                value = $field.val();

                if (isRequired && (!value || value.trim() === '')) {
                    showError($wrap, i18n.required || 'This field is required.');
                    isValid = false;
                    return;
                }

                if (!value || value.trim() === '') return;

                switch (type) {
                    case 'email':
                        if (!isValidEmail(value)) {
                            showError($wrap, i18n.invalidEmail || 'Please enter a valid email address.');
                            isValid = false;
                        }
                        break;
                    case 'url':
                        if (!isValidUrl(value)) {
                            showError($wrap, i18n.invalidUrl || 'Please enter a valid URL.');
                            isValid = false;
                        }
                        break;
                    case 'date':
                        if (!isValidDate(value)) {
                            showError($wrap, i18n.invalidDate || 'Please enter a valid date.');
                            isValid = false;
                        }
                        break;
                }
            });

            if (!isValid) {
                e.preventDefault();
                var $firstError = $form.find('.tutor-cuf-field-error').first();
                if ($firstError.length) {
                    $('html, body').animate({
                        scrollTop: $firstError.offset().top - 100
                    }, 400);
                }
                return false;
            }

            return true;
        });

        // Clear error on input
        $(document).on('input change', '.tutor-cuf-field-wrap input, .tutor-cuf-field-wrap select, .tutor-cuf-field-wrap textarea', function() {
            var $wrap = $(this).closest('.tutor-cuf-field-wrap');
            $wrap.find('.tutor-cuf-error').remove();
            $wrap.removeClass('tutor-cuf-field-error');
        });

        // Clear terms error when checked
        $(document).on('change', '.tutor-cuf-terms-checkbox', function() {
            var $wrap = $(this).closest('.tutor-cuf-terms-wrap');
            if ($(this).is(':checked')) {
                $wrap.find('.tutor-cuf-error').remove();
                $wrap.removeClass('tutor-cuf-field-error');
            }
        });
    }

    /* ==================================================
       Helpers
       ================================================== */
    function showError($wrap, message) {
        $wrap.addClass('tutor-cuf-field-error');
        $wrap.append('<span class="tutor-cuf-error">' + escapeHtml(message) + '</span>');
    }

    function isValidEmail(email) {
        return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
    }

    function isValidUrl(url) {
        try { new URL(url); return true; } catch (_) { return false; }
    }

    function isValidDate(dateStr) {
        return !isNaN(new Date(dateStr).getTime());
    }

    function escapeHtml(text) {
        var div = document.createElement('div');
        div.appendChild(document.createTextNode(text));
        return div.innerHTML;
    }

})(jQuery);
