<?php
/*
 * Plugin Name: Custom User Registration Fields for Tutor LMS
 * Requires Plugins: tutor
 * Description: Advanced Custom User Registration Fields for Tutor LMS - supports text, email, phone, number, date, textarea, select, radio, checkbox, URL fields with validation.
 * Version: 2.0
 * Requires at least: 6.0
 * Requires PHP: 7.4
 * Requires Plugins: tutor
 * Author: userelements
 * Author URI: http://userelements.com/
 * License: GNU General Public License v2.0
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: custom-user-registration-fields-tutor-lms
 * Domain Path: /languages
 */

// Exit if accessed directly.
if ( ! defined('ABSPATH') ) {
    exit;
}

/**
 * ============================================================
 * SUPPORTED FIELD TYPES
 * ============================================================
 */
function tutor_cuf_get_field_types() {
    return array(
        'text'     => __('Text', 'custom-user-registration-fields-tutor-lms'),
        'email'    => __('Email', 'custom-user-registration-fields-tutor-lms'),
        'phone'    => __('Phone (Numbers Only)', 'custom-user-registration-fields-tutor-lms'),
        'number'   => __('Number', 'custom-user-registration-fields-tutor-lms'),
        'date'     => __('Date / Birthday', 'custom-user-registration-fields-tutor-lms'),
        'textarea' => __('Textarea', 'custom-user-registration-fields-tutor-lms'),
        'select'   => __('Dropdown Select', 'custom-user-registration-fields-tutor-lms'),
        'radio'    => __('Radio Buttons', 'custom-user-registration-fields-tutor-lms'),
        'checkbox' => __('Checkboxes', 'custom-user-registration-fields-tutor-lms'),
        'url'      => __('URL', 'custom-user-registration-fields-tutor-lms'),
    );
}

/**
 * Field types that need options (choices)
 */
function tutor_cuf_types_with_options() {
    return array('select', 'radio', 'checkbox');
}

/**
 * ============================================================
 * COUNTRY CODES DATA (with flags emoji)
 * ============================================================
 */
function tutor_cuf_get_country_codes() {
    return array(
        array('code' => '+966', 'iso' => 'SA', 'flag' => '🇸🇦', 'name' => 'Saudi Arabia'),
        array('code' => '+20',  'iso' => 'EG', 'flag' => '🇪🇬', 'name' => 'Egypt'),
        array('code' => '+971', 'iso' => 'AE', 'flag' => '🇦🇪', 'name' => 'UAE'),
        array('code' => '+974', 'iso' => 'QA', 'flag' => '🇶🇦', 'name' => 'Qatar'),
        array('code' => '+973', 'iso' => 'BH', 'flag' => '🇧🇭', 'name' => 'Bahrain'),
        array('code' => '+968', 'iso' => 'OM', 'flag' => '🇴🇲', 'name' => 'Oman'),
        array('code' => '+965', 'iso' => 'KW', 'flag' => '🇰🇼', 'name' => 'Kuwait'),
        array('code' => '+962', 'iso' => 'JO', 'flag' => '🇯🇴', 'name' => 'Jordan'),
        array('code' => '+961', 'iso' => 'LB', 'flag' => '🇱🇧', 'name' => 'Lebanon'),
        array('code' => '+964', 'iso' => 'IQ', 'flag' => '🇮🇶', 'name' => 'Iraq'),
        array('code' => '+963', 'iso' => 'SY', 'flag' => '🇸🇾', 'name' => 'Syria'),
        array('code' => '+970', 'iso' => 'PS', 'flag' => '🇵🇸', 'name' => 'Palestine'),
        array('code' => '+967', 'iso' => 'YE', 'flag' => '🇾🇪', 'name' => 'Yemen'),
        array('code' => '+218', 'iso' => 'LY', 'flag' => '🇱🇾', 'name' => 'Libya'),
        array('code' => '+216', 'iso' => 'TN', 'flag' => '🇹🇳', 'name' => 'Tunisia'),
        array('code' => '+213', 'iso' => 'DZ', 'flag' => '🇩🇿', 'name' => 'Algeria'),
        array('code' => '+212', 'iso' => 'MA', 'flag' => '🇲🇦', 'name' => 'Morocco'),
        array('code' => '+249', 'iso' => 'SD', 'flag' => '🇸🇩', 'name' => 'Sudan'),
        array('code' => '+252', 'iso' => 'SO', 'flag' => '🇸🇴', 'name' => 'Somalia'),
        array('code' => '+253', 'iso' => 'DJ', 'flag' => '🇩🇯', 'name' => 'Djibouti'),
        array('code' => '+269', 'iso' => 'KM', 'flag' => '🇰🇲', 'name' => 'Comoros'),
        array('code' => '+222', 'iso' => 'MR', 'flag' => '🇲🇷', 'name' => 'Mauritania'),
        array('code' => '+1',   'iso' => 'US', 'flag' => '🇺🇸', 'name' => 'United States'),
        array('code' => '+1',   'iso' => 'CA', 'flag' => '🇨🇦', 'name' => 'Canada'),
        array('code' => '+44',  'iso' => 'GB', 'flag' => '🇬🇧', 'name' => 'United Kingdom'),
        array('code' => '+49',  'iso' => 'DE', 'flag' => '🇩🇪', 'name' => 'Germany'),
        array('code' => '+33',  'iso' => 'FR', 'flag' => '🇫🇷', 'name' => 'France'),
        array('code' => '+39',  'iso' => 'IT', 'flag' => '🇮🇹', 'name' => 'Italy'),
        array('code' => '+34',  'iso' => 'ES', 'flag' => '🇪🇸', 'name' => 'Spain'),
        array('code' => '+31',  'iso' => 'NL', 'flag' => '🇳🇱', 'name' => 'Netherlands'),
        array('code' => '+46',  'iso' => 'SE', 'flag' => '🇸🇪', 'name' => 'Sweden'),
        array('code' => '+47',  'iso' => 'NO', 'flag' => '🇳🇴', 'name' => 'Norway'),
        array('code' => '+45',  'iso' => 'DK', 'flag' => '🇩🇰', 'name' => 'Denmark'),
        array('code' => '+41',  'iso' => 'CH', 'flag' => '🇨🇭', 'name' => 'Switzerland'),
        array('code' => '+43',  'iso' => 'AT', 'flag' => '🇦🇹', 'name' => 'Austria'),
        array('code' => '+32',  'iso' => 'BE', 'flag' => '🇧🇪', 'name' => 'Belgium'),
        array('code' => '+351', 'iso' => 'PT', 'flag' => '🇵🇹', 'name' => 'Portugal'),
        array('code' => '+30',  'iso' => 'GR', 'flag' => '🇬🇷', 'name' => 'Greece'),
        array('code' => '+48',  'iso' => 'PL', 'flag' => '🇵🇱', 'name' => 'Poland'),
        array('code' => '+90',  'iso' => 'TR', 'flag' => '🇹🇷', 'name' => 'Turkey'),
        array('code' => '+91',  'iso' => 'IN', 'flag' => '🇮🇳', 'name' => 'India'),
        array('code' => '+92',  'iso' => 'PK', 'flag' => '🇵🇰', 'name' => 'Pakistan'),
        array('code' => '+880', 'iso' => 'BD', 'flag' => '🇧🇩', 'name' => 'Bangladesh'),
        array('code' => '+86',  'iso' => 'CN', 'flag' => '🇨🇳', 'name' => 'China'),
        array('code' => '+81',  'iso' => 'JP', 'flag' => '🇯🇵', 'name' => 'Japan'),
        array('code' => '+82',  'iso' => 'KR', 'flag' => '🇰🇷', 'name' => 'South Korea'),
        array('code' => '+60',  'iso' => 'MY', 'flag' => '🇲🇾', 'name' => 'Malaysia'),
        array('code' => '+62',  'iso' => 'ID', 'flag' => '🇮🇩', 'name' => 'Indonesia'),
        array('code' => '+63',  'iso' => 'PH', 'flag' => '🇵🇭', 'name' => 'Philippines'),
        array('code' => '+66',  'iso' => 'TH', 'flag' => '🇹🇭', 'name' => 'Thailand'),
        array('code' => '+84',  'iso' => 'VN', 'flag' => '🇻🇳', 'name' => 'Vietnam'),
        array('code' => '+65',  'iso' => 'SG', 'flag' => '🇸🇬', 'name' => 'Singapore'),
        array('code' => '+61',  'iso' => 'AU', 'flag' => '🇦🇺', 'name' => 'Australia'),
        array('code' => '+64',  'iso' => 'NZ', 'flag' => '🇳🇿', 'name' => 'New Zealand'),
        array('code' => '+55',  'iso' => 'BR', 'flag' => '🇧🇷', 'name' => 'Brazil'),
        array('code' => '+52',  'iso' => 'MX', 'flag' => '🇲🇽', 'name' => 'Mexico'),
        array('code' => '+54',  'iso' => 'AR', 'flag' => '🇦🇷', 'name' => 'Argentina'),
        array('code' => '+57',  'iso' => 'CO', 'flag' => '🇨🇴', 'name' => 'Colombia'),
        array('code' => '+56',  'iso' => 'CL', 'flag' => '🇨🇱', 'name' => 'Chile'),
        array('code' => '+27',  'iso' => 'ZA', 'flag' => '🇿🇦', 'name' => 'South Africa'),
        array('code' => '+234', 'iso' => 'NG', 'flag' => '🇳🇬', 'name' => 'Nigeria'),
        array('code' => '+254', 'iso' => 'KE', 'flag' => '🇰🇪', 'name' => 'Kenya'),
        array('code' => '+255', 'iso' => 'TZ', 'flag' => '🇹🇿', 'name' => 'Tanzania'),
        array('code' => '+233', 'iso' => 'GH', 'flag' => '🇬🇭', 'name' => 'Ghana'),
        array('code' => '+251', 'iso' => 'ET', 'flag' => '🇪🇹', 'name' => 'Ethiopia'),
        array('code' => '+7',   'iso' => 'RU', 'flag' => '🇷🇺', 'name' => 'Russia'),
        array('code' => '+380', 'iso' => 'UA', 'flag' => '🇺🇦', 'name' => 'Ukraine'),
        array('code' => '+98',  'iso' => 'IR', 'flag' => '🇮🇷', 'name' => 'Iran'),
        array('code' => '+93',  'iso' => 'AF', 'flag' => '🇦🇫', 'name' => 'Afghanistan'),
    );
}

/**
 * Parse stored phone value into country code + local number
 */
function tutor_cuf_parse_phone_value($value) {
    $result = array('country_code' => '', 'local_number' => $value);
    if (empty($value)) return $result;

    $countries = tutor_cuf_get_country_codes();
    // Sort by code length descending to match longest first
    usort($countries, function($a, $b) {
        return strlen($b['code']) - strlen($a['code']);
    });

    foreach ($countries as $country) {
        if (strpos($value, $country['code']) === 0) {
            $result['country_code'] = $country['code'];
            $result['local_number'] = trim(substr($value, strlen($country['code'])));
            break;
        }
    }

    return $result;
}

/**
 * ============================================================
 * MIGRATION: Convert old simple format to new advanced format
 * ============================================================
 */
function tutor_cuf_maybe_migrate() {
    $migrated = get_option('tutor_cuf_migrated_v2', false);
    if ($migrated) return;

    // Migrate student fields
    $old_student = get_option('tutor_field_cuf_fields', []);
    if (!empty($old_student) && !isset(reset($old_student)['type'])) {
        // Old format: meta_key => label
        $new_fields = [];
        $order = 0;
        foreach ($old_student as $meta_key => $label) {
            if (is_string($label)) {
                $new_fields[] = array(
                    'meta_key'    => $meta_key,
                    'label'       => $label,
                    'type'        => 'text',
                    'required'    => '0',
                    'placeholder' => '',
                    'options'     => '',
                    'order'       => $order++,
                );
            }
        }
        if (!empty($new_fields)) {
            update_option('tutor_field_cuf_fields', $new_fields);
        }
    }

    // Migrate instructor fields
    $old_instructor = get_option('tutor_field_cif_fields', []);
    if (!empty($old_instructor) && !isset(reset($old_instructor)['type'])) {
        $new_fields = [];
        $order = 0;
        foreach ($old_instructor as $meta_key => $label) {
            if (is_string($label)) {
                $new_fields[] = array(
                    'meta_key'    => $meta_key,
                    'label'       => $label,
                    'type'        => 'text',
                    'required'    => '0',
                    'placeholder' => '',
                    'options'     => '',
                    'order'       => $order++,
                );
            }
        }
        if (!empty($new_fields)) {
            update_option('tutor_field_cif_fields', $new_fields);
        }
    }

    update_option('tutor_cuf_migrated_v2', true);
}
add_action('admin_init', 'tutor_cuf_maybe_migrate');

/**
 * ============================================================
 * ADMIN MENU
 * ============================================================
 */
add_action('admin_menu', 'tutor_field_cuf_add_admin_submenu');
function tutor_field_cuf_add_admin_submenu() {
    add_submenu_page(
        'users.php',
        esc_html__('Tutor LMS User Fields', 'custom-user-registration-fields-tutor-lms'),
        esc_html__('Tutor LMS User Fields', 'custom-user-registration-fields-tutor-lms'),
        'manage_options',
        'custom-user-fields',
        'tutor_field_cuf_settings_page'
    );
}

/**
 * ============================================================
 * SAVE SETTINGS HANDLER
 * ============================================================
 */
function tutor_cuf_save_fields_from_post($option_name, $nonce_action, $nonce_field) {
    if (!isset($_POST[$nonce_field]) || !wp_verify_nonce($_POST[$nonce_field], $nonce_action)) {
        return false;
    }

    $prefix = ($option_name === 'tutor_field_cuf_fields') ? 'cuf' : 'cif';
    $fields = [];

    if (isset($_POST[$prefix . '_meta_keys']) && is_array($_POST[$prefix . '_meta_keys'])) {
        foreach ($_POST[$prefix . '_meta_keys'] as $index => $meta_key) {
            $meta_key = sanitize_key($meta_key);
            if (empty($meta_key)) continue;

            $fields[] = array(
                'meta_key'    => $meta_key,
                'label'       => sanitize_text_field($_POST[$prefix . '_labels'][$index] ?? ''),
                'type'        => sanitize_text_field($_POST[$prefix . '_types'][$index] ?? 'text'),
                'required'    => sanitize_text_field($_POST[$prefix . '_required'][$index] ?? '0'),
                'placeholder' => sanitize_text_field($_POST[$prefix . '_placeholders'][$index] ?? ''),
                'options'     => sanitize_textarea_field($_POST[$prefix . '_options'][$index] ?? ''),
                'order'       => intval($index),
            );
        }
    }

    // Sort by order
    usort($fields, function($a, $b) { return $a['order'] - $b['order']; });

    update_option($option_name, $fields);
    return true;
}

/**
 * ============================================================
 * ADMIN SETTINGS PAGE
 * ============================================================
 */
function tutor_field_cuf_settings_page() {
    $saved = false;

    if (isset($_POST['cuf_submit'])) {
        if (tutor_cuf_save_fields_from_post('tutor_field_cuf_fields', 'cuf_settings_nonce_action', 'cuf_settings_nonce_field')) {
            $saved = true;
        }
    }

    if (isset($_POST['cif_submit'])) {
        if (tutor_cuf_save_fields_from_post('tutor_field_cif_fields', 'cif_settings_nonce_action', 'cif_settings_nonce_field')) {
            $saved = true;
        }
    }

    // Save Terms & Conditions settings
    if (isset($_POST['tutor_cuf_terms_submit'])) {
        if (isset($_POST['tutor_cuf_terms_nonce']) && wp_verify_nonce($_POST['tutor_cuf_terms_nonce'], 'tutor_cuf_terms_nonce_action')) {
            $terms_settings = array(
                'enabled'        => sanitize_text_field($_POST['tutor_cuf_terms_enabled'] ?? '0'),
                'checkbox_text'  => sanitize_text_field($_POST['tutor_cuf_terms_checkbox_text'] ?? ''),
                'link_text'      => sanitize_text_field($_POST['tutor_cuf_terms_link_text'] ?? ''),
                'link_url'       => esc_url_raw($_POST['tutor_cuf_terms_link_url'] ?? ''),
                'apply_to'       => sanitize_text_field($_POST['tutor_cuf_terms_apply_to'] ?? 'both'),
                'error_message'  => sanitize_text_field($_POST['tutor_cuf_terms_error_message'] ?? ''),
                'checkbox_size'  => max(18, min(52, intval($_POST['tutor_cuf_terms_checkbox_size'] ?? 32))),
                'text_size'      => max(12, min(28, intval($_POST['tutor_cuf_terms_text_size'] ?? 16))),
            );
            update_option('tutor_cuf_terms_settings', $terms_settings);
            $saved = true;
        }
    }

    if ($saved) {
        echo '<div class="notice notice-success is-dismissible"><p>' . esc_html__('Settings saved successfully!', 'custom-user-registration-fields-tutor-lms') . '</p></div>';
    }

    $user_fields = get_option('tutor_field_cuf_fields', []);
    $instructor_fields = get_option('tutor_field_cif_fields', []);
    $terms_settings = get_option('tutor_cuf_terms_settings', array(
        'enabled'        => '0',
        'checkbox_text'  => __('I agree to the', 'custom-user-registration-fields-tutor-lms'),
        'link_text'      => __('Terms & Conditions', 'custom-user-registration-fields-tutor-lms'),
        'link_url'       => '',
        'apply_to'       => 'both',
        'error_message'  => __('You must accept the Terms & Conditions to register.', 'custom-user-registration-fields-tutor-lms'),
        'checkbox_size'  => 32,
        'text_size'      => 16,
    ));
    // Ensure backwards compatible defaults for size fields
    if (!isset($terms_settings['checkbox_size'])) $terms_settings['checkbox_size'] = 32;
    if (!isset($terms_settings['text_size'])) $terms_settings['text_size'] = 16;
    $field_types = tutor_cuf_get_field_types();
    $types_with_options = tutor_cuf_types_with_options();
    ?>
    <div class="wrap tutor-cuf-wrap">
        <h1><?php esc_html_e('Tutor LMS Custom Registration Fields', 'custom-user-registration-fields-tutor-lms'); ?></h1>
        <p class="description"><?php esc_html_e('Add and manage custom fields for student and instructor registration forms. Supports text, email, phone, date, dropdown, radio, checkbox and more.', 'custom-user-registration-fields-tutor-lms'); ?></p>

        <h2 class="nav-tab-wrapper">
            <a href="#user-fields" class="nav-tab nav-tab-active"><?php esc_html_e('Student Registration Fields', 'custom-user-registration-fields-tutor-lms'); ?></a>
            <a href="#instructor-fields" class="nav-tab"><?php esc_html_e('Instructor Registration Fields', 'custom-user-registration-fields-tutor-lms'); ?></a>
            <a href="#terms-settings" class="nav-tab"><?php esc_html_e('Terms & Conditions', 'custom-user-registration-fields-tutor-lms'); ?></a>
        </h2>

        <!-- STUDENT FIELDS TAB -->
        <div id="user-fields" class="tab-content">
            <form method="post">
                <?php wp_nonce_field('cuf_settings_nonce_action', 'cuf_settings_nonce_field'); ?>
                <div id="cuf_fields_container" class="tutor-cuf-fields-container">
                    <?php if (!empty($user_fields)): ?>
                        <?php foreach ($user_fields as $index => $field): ?>
                            <?php tutor_cuf_render_admin_field_row('cuf', $index, $field, $field_types, $types_with_options); ?>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <?php tutor_cuf_render_admin_field_row('cuf', 0, null, $field_types, $types_with_options); ?>
                    <?php endif; ?>
                </div>
                <p>
                    <button type="button" id="cuf_add_field" class="button tutor-cuf-add-btn"><?php esc_html_e('+ Add New Field', 'custom-user-registration-fields-tutor-lms'); ?></button>
                </p>
                <p class="submit">
                    <input type="submit" name="cuf_submit" class="button button-primary tutor-cuf-save-btn" value="<?php esc_attr_e('Save Student Fields', 'custom-user-registration-fields-tutor-lms'); ?>">
                </p>
            </form>
        </div>

        <!-- INSTRUCTOR FIELDS TAB -->
        <div id="instructor-fields" class="tab-content" style="display:none;">
            <form method="post">
                <?php wp_nonce_field('cif_settings_nonce_action', 'cif_settings_nonce_field'); ?>
                <div id="cif_fields_container" class="tutor-cuf-fields-container">
                    <?php if (!empty($instructor_fields)): ?>
                        <?php foreach ($instructor_fields as $index => $field): ?>
                            <?php tutor_cuf_render_admin_field_row('cif', $index, $field, $field_types, $types_with_options); ?>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <?php tutor_cuf_render_admin_field_row('cif', 0, null, $field_types, $types_with_options); ?>
                    <?php endif; ?>
                </div>
                <p>
                    <button type="button" id="cif_add_field" class="button tutor-cuf-add-btn"><?php esc_html_e('+ Add New Field', 'custom-user-registration-fields-tutor-lms'); ?></button>
                </p>
                <p class="submit">
                    <input type="submit" name="cif_submit" class="button button-primary tutor-cuf-save-btn" value="<?php esc_attr_e('Save Instructor Fields', 'custom-user-registration-fields-tutor-lms'); ?>">
                </p>
            </form>
        </div>
    </div>

        <!-- TERMS & CONDITIONS TAB -->
        <!-- TERMS & CONDITIONS TAB -->
        <div id="terms-settings" class="tab-content" style="display:none;">
            <form method="post">
                <?php wp_nonce_field('tutor_cuf_terms_nonce_action', 'tutor_cuf_terms_nonce'); ?>
                <div class="tutor-cuf-terms-admin">

                    <!-- Section 1: General -->
                    <div class="tutor-cuf-terms-section">
                        <div class="tutor-cuf-terms-section-header">
                            <span class="tutor-cuf-terms-section-icon">
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none"><path d="M10 1L3 5v5c0 4.4 3 8.5 7 9.9 4-1.4 7-5.5 7-9.9V5l-7-4z" stroke="currentColor" stroke-width="1.5" fill="none"/><path d="M7 10l2 2 4-4" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            </span>
                            <div>
                                <h3><?php esc_html_e('General Settings', 'custom-user-registration-fields-tutor-lms'); ?></h3>
                                <p><?php esc_html_e('Enable and configure where the terms checkbox appears.', 'custom-user-registration-fields-tutor-lms'); ?></p>
                            </div>
                        </div>
                        <div class="tutor-cuf-terms-section-body">
                            <div class="tutor-cuf-field-row">
                                <div class="tutor-cuf-col">
                                    <label><?php esc_html_e('Status', 'custom-user-registration-fields-tutor-lms'); ?></label>
                                    <div class="tutor-cuf-terms-toggle-wrap">
                                        <label class="tutor-cuf-terms-toggle">
                                            <input type="hidden" name="tutor_cuf_terms_enabled" value="0">
                                            <input type="checkbox" name="tutor_cuf_terms_enabled" value="1" <?php checked($terms_settings['enabled'], '1'); ?>>
                                            <span class="tutor-cuf-terms-toggle-slider"></span>
                                        </label>
                                        <span class="tutor-cuf-terms-toggle-label">
                                            <?php echo ($terms_settings['enabled'] === '1') ? esc_html__('Active', 'custom-user-registration-fields-tutor-lms') : esc_html__('Inactive', 'custom-user-registration-fields-tutor-lms'); ?>
                                        </span>
                                    </div>
                                </div>
                                <div class="tutor-cuf-col">
                                    <label><?php esc_html_e('Apply To', 'custom-user-registration-fields-tutor-lms'); ?></label>
                                    <select name="tutor_cuf_terms_apply_to" class="tutor-cuf-input">
                                        <option value="both" <?php selected($terms_settings['apply_to'], 'both'); ?>><?php esc_html_e('Students & Instructors', 'custom-user-registration-fields-tutor-lms'); ?></option>
                                        <option value="students" <?php selected($terms_settings['apply_to'], 'students'); ?>><?php esc_html_e('Students Only', 'custom-user-registration-fields-tutor-lms'); ?></option>
                                        <option value="instructors" <?php selected($terms_settings['apply_to'], 'instructors'); ?>><?php esc_html_e('Instructors Only', 'custom-user-registration-fields-tutor-lms'); ?></option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Section 2: Content -->
                    <div class="tutor-cuf-terms-section">
                        <div class="tutor-cuf-terms-section-header">
                            <span class="tutor-cuf-terms-section-icon">
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none"><rect x="3" y="2" width="14" height="16" rx="2" stroke="currentColor" stroke-width="1.5"/><path d="M7 6h6M7 10h6M7 14h4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>
                            </span>
                            <div>
                                <h3><?php esc_html_e('Checkbox Content', 'custom-user-registration-fields-tutor-lms'); ?></h3>
                                <p><?php esc_html_e('Customize the text and link shown next to the checkbox.', 'custom-user-registration-fields-tutor-lms'); ?></p>
                            </div>
                        </div>
                        <div class="tutor-cuf-terms-section-body">
                            <div class="tutor-cuf-field-row">
                                <div class="tutor-cuf-col">
                                    <label><?php esc_html_e('Checkbox Text', 'custom-user-registration-fields-tutor-lms'); ?></label>
                                    <input type="text" name="tutor_cuf_terms_checkbox_text" value="<?php echo esc_attr($terms_settings['checkbox_text']); ?>" class="tutor-cuf-input" placeholder="<?php esc_attr_e('I agree to the', 'custom-user-registration-fields-tutor-lms'); ?>">
                                    <p class="description"><?php esc_html_e('Text before the link, e.g. "I agree to the" / "أوافق على"', 'custom-user-registration-fields-tutor-lms'); ?></p>
                                </div>
                                <div class="tutor-cuf-col">
                                    <label><?php esc_html_e('Link Label', 'custom-user-registration-fields-tutor-lms'); ?></label>
                                    <input type="text" name="tutor_cuf_terms_link_text" value="<?php echo esc_attr($terms_settings['link_text']); ?>" class="tutor-cuf-input" placeholder="<?php esc_attr_e('Terms & Conditions', 'custom-user-registration-fields-tutor-lms'); ?>">
                                    <p class="description"><?php esc_html_e('Clickable text, e.g. "Terms & Conditions" / "الشروط والأحكام"', 'custom-user-registration-fields-tutor-lms'); ?></p>
                                </div>
                            </div>
                            <div class="tutor-cuf-field-row">
                                <div class="tutor-cuf-col tutor-cuf-col-full">
                                    <label>
                                        <svg width="14" height="14" viewBox="0 0 14 14" fill="none" style="vertical-align:-2px;margin-right:4px;"><path d="M1 7C1 3.7 3.7 1 7 1s6 2.7 6 6-2.7 6-6 6-6-2.7-6-6z" stroke="#007cba" stroke-width="1.2"/><path d="M5 5.5c0-1.1.9-2 2-2s2 .9 2 2c0 .8-.5 1.3-1 1.6-.3.2-.5.4-.5.7V6.5" stroke="#007cba" stroke-width="1.2" stroke-linecap="round"/><circle cx="7" cy="9" r=".6" fill="#007cba"/></svg>
                                        <?php esc_html_e('Terms Page URL', 'custom-user-registration-fields-tutor-lms'); ?>
                                    </label>
                                    <input type="url" name="tutor_cuf_terms_link_url" value="<?php echo esc_attr($terms_settings['link_url']); ?>" class="tutor-cuf-input" placeholder="https://yoursite.com/terms-and-conditions" dir="ltr">
                                    <p class="description"><?php esc_html_e('Full URL of your terms page. Leave empty to show plain text instead of a link.', 'custom-user-registration-fields-tutor-lms'); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Section 3: Error -->
                    <div class="tutor-cuf-terms-section">
                        <div class="tutor-cuf-terms-section-header">
                            <span class="tutor-cuf-terms-section-icon tutor-cuf-terms-section-icon--warn">
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none"><path d="M10 2L2 17h16L10 2z" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round"/><path d="M10 8v4M10 14.5v.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>
                            </span>
                            <div>
                                <h3><?php esc_html_e('Validation Error', 'custom-user-registration-fields-tutor-lms'); ?></h3>
                                <p><?php esc_html_e('Message shown when a user tries to register without accepting.', 'custom-user-registration-fields-tutor-lms'); ?></p>
                            </div>
                        </div>
                        <div class="tutor-cuf-terms-section-body">
                            <div class="tutor-cuf-field-row">
                                <div class="tutor-cuf-col tutor-cuf-col-full">
                                    <label><?php esc_html_e('Error Message', 'custom-user-registration-fields-tutor-lms'); ?></label>
                                    <input type="text" name="tutor_cuf_terms_error_message" value="<?php echo esc_attr($terms_settings['error_message']); ?>" class="tutor-cuf-input" placeholder="<?php esc_attr_e('You must accept the Terms & Conditions to register.', 'custom-user-registration-fields-tutor-lms'); ?>">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Section 4: Appearance -->
                    <div class="tutor-cuf-terms-section">
                        <div class="tutor-cuf-terms-section-header">
                            <span class="tutor-cuf-terms-section-icon tutor-cuf-terms-section-icon--appearance">
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none"><path d="M3 17h2l10-10-2-2L3 15v2z" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round"/><path d="M11 5l2 2" stroke="currentColor" stroke-width="1.5"/><path d="M15 3l2 2-1 1-2-2 1-1z" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round"/></svg>
                            </span>
                            <div>
                                <h3><?php esc_html_e('Appearance', 'custom-user-registration-fields-tutor-lms'); ?></h3>
                                <p><?php esc_html_e('Control the checkbox size and text size for the terms section.', 'custom-user-registration-fields-tutor-lms'); ?></p>
                            </div>
                        </div>
                        <div class="tutor-cuf-terms-section-body">
                            <div class="tutor-cuf-field-row" style="display:flex;gap:24px;flex-wrap:wrap;">
                                <!-- Checkbox Size -->
                                <div class="tutor-cuf-col" style="flex:1;min-width:220px;">
                                    <label>
                                        <svg width="14" height="14" viewBox="0 0 14 14" fill="none" style="vertical-align:-2px;margin-right:4px;"><rect x="1" y="1" width="12" height="12" rx="3" stroke="#007cba" stroke-width="1.2"/><path d="M4 7l2 2 4-4" stroke="#007cba" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                        <?php esc_html_e('Checkbox Size', 'custom-user-registration-fields-tutor-lms'); ?>
                                        <span class="tutor-cuf-size-value" id="tutor-cuf-cb-size-val"><?php echo intval($terms_settings['checkbox_size']); ?>px</span>
                                    </label>
                                    <div class="tutor-cuf-range-wrap">
                                        <input type="range" name="tutor_cuf_terms_checkbox_size" id="tutor_cuf_terms_checkbox_size" min="18" max="52" step="1" value="<?php echo intval($terms_settings['checkbox_size']); ?>" class="tutor-cuf-range-slider">
                                        <div class="tutor-cuf-range-labels">
                                            <span>18px</span>
                                            <span>52px</span>
                                        </div>
                                    </div>
                                </div>
                                <!-- Text Size -->
                                <div class="tutor-cuf-col" style="flex:1;min-width:220px;">
                                    <label>
                                        <svg width="14" height="14" viewBox="0 0 14 14" fill="none" style="vertical-align:-2px;margin-right:4px;"><text x="2" y="11" font-size="11" font-weight="bold" fill="#007cba" font-family="Arial">A</text></svg>
                                        <?php esc_html_e('Text Size', 'custom-user-registration-fields-tutor-lms'); ?>
                                        <span class="tutor-cuf-size-value" id="tutor-cuf-text-size-val"><?php echo intval($terms_settings['text_size']); ?>px</span>
                                    </label>
                                    <div class="tutor-cuf-range-wrap">
                                        <input type="range" name="tutor_cuf_terms_text_size" id="tutor_cuf_terms_text_size" min="12" max="28" step="1" value="<?php echo intval($terms_settings['text_size']); ?>" class="tutor-cuf-range-slider">
                                        <div class="tutor-cuf-range-labels">
                                            <span>12px</span>
                                            <span>28px</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Section 5: Live Preview -->
                    <div class="tutor-cuf-terms-section tutor-cuf-terms-preview-section">
                        <div class="tutor-cuf-terms-section-header">
                            <span class="tutor-cuf-terms-section-icon tutor-cuf-terms-section-icon--preview">
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none"><circle cx="10" cy="10" r="3" stroke="currentColor" stroke-width="1.5"/><path d="M2 10s3-6 8-6 8 6 8 6-3 6-8 6-8-6-8-6z" stroke="currentColor" stroke-width="1.5"/></svg>
                            </span>
                            <div>
                                <h3><?php esc_html_e('Live Preview', 'custom-user-registration-fields-tutor-lms'); ?></h3>
                                <p><?php esc_html_e('This is how it will appear on the registration form.', 'custom-user-registration-fields-tutor-lms'); ?></p>
                            </div>
                        </div>
                        <div class="tutor-cuf-terms-section-body">
                            <div class="tutor-cuf-terms-preview-box">
                                <div class="tutor-cuf-terms-preview-inner">
                                    <label class="tutor-cuf-terms-preview-label">
                                        <span class="tutor-cuf-terms-preview-cb">
                                            <svg width="12" height="12" viewBox="0 0 12 12" fill="none"><path d="M2.5 6L5 8.5L9.5 3.5" stroke="#fff" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                        </span>
                                        <span class="tutor-cuf-terms-preview-text">
                                            <?php echo esc_html($terms_settings['checkbox_text']); ?>
                                            <?php if (!empty($terms_settings['link_url'])): ?>
                                                <a href="<?php echo esc_url($terms_settings['link_url']); ?>" target="_blank" class="tutor-cuf-terms-preview-link"><?php echo esc_html($terms_settings['link_text']); ?></a>
                                            <?php else: ?>
                                                <strong class="tutor-cuf-terms-preview-link"><?php echo esc_html($terms_settings['link_text']); ?></strong>
                                            <?php endif; ?>
                                            <span style="color:#d63638;font-weight:700;"> *</span>
                                        </span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <p class="submit">
                    <input type="submit" name="tutor_cuf_terms_submit" class="button button-primary tutor-cuf-save-btn" value="<?php esc_attr_e('Save Terms Settings', 'custom-user-registration-fields-tutor-lms'); ?>">
                </p>
            </form>
        </div>
    </div>

    <!-- Hidden template for JS cloning -->
    <script type="text/html" id="tmpl-cuf-field-row">
        <?php tutor_cuf_render_admin_field_row('__PREFIX__', '__INDEX__', null, $field_types, $types_with_options); ?>
    </script>
    <?php
}

/**
 * Render a single admin field row (card)
 */
function tutor_cuf_render_admin_field_row($prefix, $index, $field, $field_types, $types_with_options) {
    $meta_key    = $field['meta_key'] ?? '';
    $label       = $field['label'] ?? '';
    $type        = $field['type'] ?? 'text';
    $required    = $field['required'] ?? '0';
    $placeholder = $field['placeholder'] ?? '';
    $options     = $field['options'] ?? '';
    $show_options = in_array($type, $types_with_options) ? '' : ' style="display:none;"';
    ?>
    <div class="tutor-cuf-field-card" data-index="<?php echo esc_attr($index); ?>">
        <div class="tutor-cuf-card-header">
            <span class="tutor-cuf-drag-handle dashicons dashicons-move" title="<?php esc_attr_e('Drag to reorder', 'custom-user-registration-fields-tutor-lms'); ?>"></span>
            <span class="tutor-cuf-card-title"><?php echo !empty($label) ? esc_html($label) : esc_html__('New Field', 'custom-user-registration-fields-tutor-lms'); ?></span>
            <span class="tutor-cuf-card-type-badge"><?php echo esc_html($field_types[$type] ?? $type); ?></span>
            <button type="button" class="tutor-cuf-toggle-btn dashicons dashicons-arrow-down-alt2" title="<?php esc_attr_e('Expand/Collapse', 'custom-user-registration-fields-tutor-lms'); ?>"></button>
            <button type="button" class="tutor-cuf-remove-btn" title="<?php esc_attr_e('Remove Field', 'custom-user-registration-fields-tutor-lms'); ?>">&times;</button>
        </div>
        <div class="tutor-cuf-card-body">
            <div class="tutor-cuf-field-row">
                <div class="tutor-cuf-col">
                    <label><?php esc_html_e('Field Label', 'custom-user-registration-fields-tutor-lms'); ?> <span class="required">*</span></label>
                    <input type="text" name="<?php echo esc_attr($prefix); ?>_labels[]" value="<?php echo esc_attr($label); ?>" class="tutor-cuf-input tutor-cuf-label-input" placeholder="<?php esc_attr_e('e.g. Phone Number', 'custom-user-registration-fields-tutor-lms'); ?>" required>
                </div>
                <div class="tutor-cuf-col">
                    <label><?php esc_html_e('Meta Key', 'custom-user-registration-fields-tutor-lms'); ?> <span class="required">*</span></label>
                    <input type="text" name="<?php echo esc_attr($prefix); ?>_meta_keys[]" value="<?php echo esc_attr($meta_key); ?>" class="tutor-cuf-input tutor-cuf-metakey-input" placeholder="<?php esc_attr_e('e.g. phone_number', 'custom-user-registration-fields-tutor-lms'); ?>" required>
                </div>
            </div>
            <div class="tutor-cuf-field-row">
                <div class="tutor-cuf-col">
                    <label><?php esc_html_e('Field Type', 'custom-user-registration-fields-tutor-lms'); ?></label>
                    <select name="<?php echo esc_attr($prefix); ?>_types[]" class="tutor-cuf-input tutor-cuf-type-select">
                        <?php foreach ($field_types as $type_key => $type_label): ?>
                            <option value="<?php echo esc_attr($type_key); ?>" <?php selected($type, $type_key); ?>><?php echo esc_html($type_label); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="tutor-cuf-col">
                    <label><?php esc_html_e('Required?', 'custom-user-registration-fields-tutor-lms'); ?></label>
                    <select name="<?php echo esc_attr($prefix); ?>_required[]" class="tutor-cuf-input">
                        <option value="0" <?php selected($required, '0'); ?>><?php esc_html_e('Optional', 'custom-user-registration-fields-tutor-lms'); ?></option>
                        <option value="1" <?php selected($required, '1'); ?>><?php esc_html_e('Required', 'custom-user-registration-fields-tutor-lms'); ?></option>
                    </select>
                </div>
            </div>
            <div class="tutor-cuf-field-row">
                <div class="tutor-cuf-col tutor-cuf-col-full">
                    <label><?php esc_html_e('Placeholder Text', 'custom-user-registration-fields-tutor-lms'); ?></label>
                    <input type="text" name="<?php echo esc_attr($prefix); ?>_placeholders[]" value="<?php echo esc_attr($placeholder); ?>" class="tutor-cuf-input" placeholder="<?php esc_attr_e('e.g. Enter your phone number...', 'custom-user-registration-fields-tutor-lms'); ?>">
                </div>
            </div>
            <div class="tutor-cuf-field-row tutor-cuf-options-row"<?php echo $show_options; ?>>
                <div class="tutor-cuf-col tutor-cuf-col-full">
                    <label><?php esc_html_e('Options (one per line)', 'custom-user-registration-fields-tutor-lms'); ?></label>
                    <textarea name="<?php echo esc_attr($prefix); ?>_options[]" class="tutor-cuf-input tutor-cuf-textarea" rows="4" placeholder="<?php esc_attr_e("Option 1\nOption 2\nOption 3", 'custom-user-registration-fields-tutor-lms'); ?>"><?php echo esc_textarea($options); ?></textarea>
                    <p class="description"><?php esc_html_e('Enter each option on a new line. For value:label format use "value|Label Text".', 'custom-user-registration-fields-tutor-lms'); ?></p>
                </div>
            </div>
        </div>
    </div>
    <?php
}

/**
 * ============================================================
 * ENQUEUE ADMIN SCRIPTS & STYLES
 * ============================================================
 */
function tutor_field_cuf_enqueue_scripts($hook_suffix) {
    if ($hook_suffix !== 'users_page_custom-user-fields') {
        return;
    }

    wp_enqueue_script('jquery-ui-sortable');
    wp_register_script('tutor-field-cuf-admin-js', plugins_url('assets/js/tutor-field-cuf-admin.js', __FILE__), array('jquery', 'jquery-ui-sortable'), '2.0.0', true);
    wp_enqueue_script('tutor-field-cuf-admin-js');

    wp_localize_script('tutor-field-cuf-admin-js', 'tutorCufAdmin', array(
        'typesWithOptions' => tutor_cuf_types_with_options(),
        'i18n' => array(
            'newField'      => __('New Field', 'custom-user-registration-fields-tutor-lms'),
            'confirmRemove' => __('Are you sure you want to remove this field?', 'custom-user-registration-fields-tutor-lms'),
            'atLeastOne'    => __('You must have at least one field.', 'custom-user-registration-fields-tutor-lms'),
        )
    ));

    wp_register_style('tutor-field-cuf-admin-css', plugins_url('assets/css/tutor-field-cuf-admin.css', __FILE__), array(), '2.0.0');
    wp_enqueue_style('tutor-field-cuf-admin-css');
}
add_action('admin_enqueue_scripts', 'tutor_field_cuf_enqueue_scripts');

/**
 * ============================================================
 * ENQUEUE FRONTEND SCRIPTS & STYLES
 * ============================================================
 */
function tutor_cuf_enqueue_frontend_assets() {
    if (!is_user_logged_in() || is_admin()) {
        // Load on registration pages (not admin)
    }
    wp_register_style('tutor-field-cuf-front-css', plugins_url('assets/css/tutor-field-cuf-front.css', __FILE__), array(), '2.0.0');
    wp_enqueue_style('tutor-field-cuf-front-css');

    wp_register_script('tutor-field-cuf-front-js', plugins_url('assets/js/tutor-field-cuf-front.js', __FILE__), array('jquery'), '2.0.0', true);
    wp_enqueue_script('tutor-field-cuf-front-js');

    wp_localize_script('tutor-field-cuf-front-js', 'tutorCufFront', array(
        'i18n' => array(
            'required'      => __('This field is required.', 'custom-user-registration-fields-tutor-lms'),
            'invalidEmail'  => __('Please enter a valid email address.', 'custom-user-registration-fields-tutor-lms'),
            'invalidPhone'  => __('Please enter numbers only.', 'custom-user-registration-fields-tutor-lms'),
            'invalidUrl'    => __('Please enter a valid URL.', 'custom-user-registration-fields-tutor-lms'),
            'invalidDate'   => __('Please enter a valid date.', 'custom-user-registration-fields-tutor-lms'),
            'selectCountry' => __('Please select your country code.', 'custom-user-registration-fields-tutor-lms'),
            'termsRequired' => __('You must accept the Terms & Conditions to register.', 'custom-user-registration-fields-tutor-lms'),
        )
    ));
}
add_action('wp_enqueue_scripts', 'tutor_cuf_enqueue_frontend_assets');

/**
 * ============================================================
 * HELPER: Parse options string into array
 * ============================================================
 */
function tutor_cuf_parse_options($options_string) {
    $options = [];
    if (empty($options_string)) return $options;

    $lines = explode("\n", $options_string);
    foreach ($lines as $line) {
        $line = trim($line);
        if (empty($line)) continue;
        if (strpos($line, '|') !== false) {
            list($value, $label) = explode('|', $line, 2);
            $options[trim($value)] = trim($label);
        } else {
            $options[$line] = $line;
        }
    }
    return $options;
}

/**
 * ============================================================
 * RENDER FRONTEND FIELD HTML
 * ============================================================
 */
function tutor_cuf_render_frontend_field($field, $value = '') {
    $meta_key    = $field['meta_key'];
    $label       = $field['label'];
    $type        = $field['type'];
    $required    = ($field['required'] === '1');
    $placeholder = $field['placeholder'];
    $req_attr    = $required ? ' required' : '';
    $req_star    = $required ? ' <span class="tutor-cuf-required">*</span>' : '';

    echo '<div class="tutor-form-col-6">';
    echo '<div class="tutor-form-group tutor-cuf-field-wrap" data-type="' . esc_attr($type) . '">';

    // Label
    echo '<label for="' . esc_attr($meta_key) . '">' . esc_html($label) . $req_star . '</label>';

    switch ($type) {
        case 'textarea':
            echo '<textarea name="' . esc_attr($meta_key) . '" id="' . esc_attr($meta_key) . '" placeholder="' . esc_attr($placeholder) . '" rows="4" class="tutor-cuf-field"' . $req_attr . '>' . esc_textarea($value) . '</textarea>';
            break;

        case 'select':
            $options = tutor_cuf_parse_options($field['options']);
            echo '<select name="' . esc_attr($meta_key) . '" id="' . esc_attr($meta_key) . '" class="tutor-cuf-field"' . $req_attr . '>';
            echo '<option value="">' . esc_html($placeholder ?: __('-- Select --', 'custom-user-registration-fields-tutor-lms')) . '</option>';
            foreach ($options as $opt_val => $opt_label) {
                echo '<option value="' . esc_attr($opt_val) . '" ' . selected($value, $opt_val, false) . '>' . esc_html($opt_label) . '</option>';
            }
            echo '</select>';
            break;

        case 'radio':
            $options = tutor_cuf_parse_options($field['options']);
            echo '<div class="tutor-cuf-radio-group">';
            foreach ($options as $opt_val => $opt_label) {
                $uid = esc_attr($meta_key . '_' . sanitize_key($opt_val));
                echo '<label class="tutor-cuf-radio-label" for="' . $uid . '">';
                echo '<input type="radio" name="' . esc_attr($meta_key) . '" id="' . $uid . '" value="' . esc_attr($opt_val) . '" ' . checked($value, $opt_val, false) . $req_attr . '> ';
                echo esc_html($opt_label);
                echo '</label>';
            }
            echo '</div>';
            break;

        case 'checkbox':
            $options = tutor_cuf_parse_options($field['options']);
            $current_values = is_array($value) ? $value : (is_string($value) && !empty($value) ? explode(',', $value) : []);
            echo '<div class="tutor-cuf-checkbox-group">';
            foreach ($options as $opt_val => $opt_label) {
                $uid = esc_attr($meta_key . '_' . sanitize_key($opt_val));
                $is_checked = in_array($opt_val, $current_values);
                echo '<label class="tutor-cuf-checkbox-label" for="' . $uid . '">';
                echo '<input type="checkbox" name="' . esc_attr($meta_key) . '[]" id="' . $uid . '" value="' . esc_attr($opt_val) . '" ' . checked($is_checked, true, false) . '> ';
                echo esc_html($opt_label);
                echo '</label>';
            }
            echo '</div>';
            break;

        case 'phone':
            $countries = tutor_cuf_get_country_codes();
            $parsed = tutor_cuf_parse_phone_value($value);
            $selected_code = $parsed['country_code'];
            $local_number = $parsed['local_number'];

            // Find selected country info
            $sel_iso = 'SA';
            $sel_name = '';
            foreach ($countries as $c) {
                if ($selected_code === $c['code']) {
                    $sel_iso = $c['iso'];
                    $sel_name = $c['name'];
                    break;
                }
            }

            echo '<div class="tutor-cuf-phone-wrapper">';

            // Custom country dropdown trigger
            echo '<div class="tutor-cuf-country-dropdown">';
            echo '<button type="button" class="tutor-cuf-country-trigger" aria-haspopup="listbox" aria-expanded="false">';
            if ($selected_code) {
                echo '<img src="https://flagcdn.com/w40/' . esc_attr(strtolower($sel_iso)) . '.png" srcset="https://flagcdn.com/w80/' . esc_attr(strtolower($sel_iso)) . '.png 2x" class="tutor-cuf-flag-img" alt="' . esc_attr($sel_name) . '" width="28" height="20">';
                echo '<span class="tutor-cuf-selected-code">' . esc_html($selected_code) . '</span>';
            } else {
                echo '<span class="tutor-cuf-flag-placeholder">&#127760;</span>';
                echo '<span class="tutor-cuf-selected-code">' . esc_html__('Code', 'custom-user-registration-fields-tutor-lms') . '</span>';
            }
            echo '<svg class="tutor-cuf-chevron" width="12" height="12" viewBox="0 0 12 12" fill="none"><path d="M3 4.5L6 7.5L9 4.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>';
            echo '</button>';

            // Dropdown panel
            echo '<div class="tutor-cuf-country-panel" role="listbox" style="display:none;">';
            echo '<div class="tutor-cuf-country-search-wrap"><input type="text" class="tutor-cuf-country-search" placeholder="' . esc_attr__('Search country...', 'custom-user-registration-fields-tutor-lms') . '" autocomplete="off"><svg class="tutor-cuf-search-icon" width="16" height="16" viewBox="0 0 16 16" fill="none"><circle cx="7" cy="7" r="5" stroke="#999" stroke-width="1.5"/><path d="M11 11L14 14" stroke="#999" stroke-width="1.5" stroke-linecap="round"/></svg></div>';
            echo '<ul class="tutor-cuf-country-list">';
            foreach ($countries as $country) {
                $is_active = ($selected_code === $country['code']) ? ' tutor-cuf-country-active' : '';
                echo '<li class="tutor-cuf-country-item' . $is_active . '" data-code="' . esc_attr($country['code']) . '" data-iso="' . esc_attr(strtolower($country['iso'])) . '" data-name="' . esc_attr($country['name']) . '" role="option">';
                echo '<img src="https://flagcdn.com/w40/' . esc_attr(strtolower($country['iso'])) . '.png" srcset="https://flagcdn.com/w80/' . esc_attr(strtolower($country['iso'])) . '.png 2x" class="tutor-cuf-flag-img" alt="' . esc_attr($country['name']) . '" width="28" height="20" loading="lazy">';
                echo '<span class="tutor-cuf-country-name">' . esc_html($country['name']) . '</span>';
                echo '<span class="tutor-cuf-country-code">' . esc_html($country['code']) . '</span>';
                echo '</li>';
            }
            echo '</ul>';
            echo '</div>';
            echo '</div>';

            // Hidden select for form submission
            echo '<input type="hidden" name="' . esc_attr($meta_key) . '_country_code" class="tutor-cuf-country-value" value="' . esc_attr($selected_code) . '">';

            // Phone number input
            echo '<input type="tel" name="' . esc_attr($meta_key) . '_local" id="' . esc_attr($meta_key) . '" value="' . esc_attr($local_number) . '" placeholder="' . esc_attr($placeholder ?: __('Phone number', 'custom-user-registration-fields-tutor-lms')) . '" class="tutor-cuf-field tutor-cuf-phone-field" inputmode="numeric"' . $req_attr . '>';

            // Hidden full number
            echo '<input type="hidden" name="' . esc_attr($meta_key) . '" class="tutor-cuf-phone-full" value="' . esc_attr($value) . '">';
            echo '</div>';
            break;

        case 'email':
            echo '<input type="email" name="' . esc_attr($meta_key) . '" id="' . esc_attr($meta_key) . '" value="' . esc_attr($value) . '" placeholder="' . esc_attr($placeholder) . '" class="tutor-cuf-field"' . $req_attr . '>';
            break;

        case 'number':
            echo '<input type="number" name="' . esc_attr($meta_key) . '" id="' . esc_attr($meta_key) . '" value="' . esc_attr($value) . '" placeholder="' . esc_attr($placeholder) . '" class="tutor-cuf-field"' . $req_attr . '>';
            break;

        case 'date':
            echo '<input type="date" name="' . esc_attr($meta_key) . '" id="' . esc_attr($meta_key) . '" value="' . esc_attr($value) . '" placeholder="' . esc_attr($placeholder) . '" class="tutor-cuf-field tutor-cuf-date-field" max="' . esc_attr(date('Y-m-d')) . '"' . $req_attr . '>';
            break;

        case 'url':
            echo '<input type="url" name="' . esc_attr($meta_key) . '" id="' . esc_attr($meta_key) . '" value="' . esc_attr($value) . '" placeholder="' . esc_attr($placeholder ?: 'https://') . '" class="tutor-cuf-field"' . $req_attr . '>';
            break;

        case 'text':
        default:
            echo '<input type="text" name="' . esc_attr($meta_key) . '" id="' . esc_attr($meta_key) . '" value="' . esc_attr($value) . '" placeholder="' . esc_attr($placeholder) . '" class="tutor-cuf-field"' . $req_attr . '>';
            break;
    }

    echo '</div>';
    echo '</div>';
}

/**
 * ============================================================
 * TUTOR LMS REGISTRATION FORM HOOKS
 * ============================================================
 */
add_action('tutor_student_reg_form_end', 'tutor_field_add_student_form_field');
add_action('tutor_instructor_reg_form_end', 'tutor_field_add_instructor_form_field');

function tutor_field_add_student_form_field() {
    $fields = get_option('tutor_field_cuf_fields', []);
    if (!empty($fields) && is_array($fields)) {
        foreach ($fields as $field) {
            if (!is_array($field) || empty($field['meta_key'])) continue;
            $old_value = '';
            if (function_exists('tutor_utils')) {
                $old_value = tutor_utils()->input_old($field['meta_key']);
            }
            tutor_cuf_render_frontend_field($field, $old_value);
        }
    }
    // Render Terms & Conditions checkbox
    tutor_cuf_render_terms_checkbox('students');
}

function tutor_field_add_instructor_form_field() {
    $fields = get_option('tutor_field_cif_fields', []);
    if (!empty($fields) && is_array($fields)) {
        foreach ($fields as $field) {
            if (!is_array($field) || empty($field['meta_key'])) continue;
            $old_value = '';
            if (function_exists('tutor_utils')) {
                $old_value = tutor_utils()->input_old($field['meta_key']);
            }
            tutor_cuf_render_frontend_field($field, $old_value);
        }
    }
    // Render Terms & Conditions checkbox
    tutor_cuf_render_terms_checkbox('instructors');
}

/**
 * ============================================================
 * RENDER TERMS & CONDITIONS CHECKBOX ON FRONTEND
 * ============================================================
 */
function tutor_cuf_render_terms_checkbox($context = 'students') {
    $terms = get_option('tutor_cuf_terms_settings', array());

    // Check if enabled
    if (empty($terms['enabled']) || $terms['enabled'] !== '1') return;

    // Check if applies to this context
    $apply = $terms['apply_to'] ?? 'both';
    if ($apply !== 'both' && $apply !== $context) return;

    $checkbox_text = $terms['checkbox_text'] ?? __('I agree to the', 'custom-user-registration-fields-tutor-lms');
    $link_text     = $terms['link_text'] ?? __('Terms & Conditions', 'custom-user-registration-fields-tutor-lms');
    $link_url      = $terms['link_url'] ?? '';
    $error_msg     = $terms['error_message'] ?? __('You must accept the Terms & Conditions to register.', 'custom-user-registration-fields-tutor-lms');
    $cb_size       = intval($terms['checkbox_size'] ?? 32);
    $text_size     = intval($terms['text_size'] ?? 16);

    // Calculate proportional sizes
    $check_svg_size = max(10, round($cb_size * 0.5));
    $shield_svg     = max(14, round($cb_size * 0.75));
    $icon_box       = max(28, round($cb_size * 1.3));
    $border_radius  = max(5, round($cb_size * 0.28));
    $label_padding_v = max(12, round($cb_size * 0.6));
    $label_padding_h = max(16, round($cb_size * 0.75));

    // Output dynamic inline styles to guarantee sizes override any theme CSS
    echo '<style>';
    echo '.tutor-cuf-terms-checkmark{width:' . $cb_size . 'px!important;height:' . $cb_size . 'px!important;border-radius:' . $border_radius . 'px!important;}';
    echo '.tutor-cuf-terms-check-svg{width:' . $check_svg_size . 'px!important;height:' . $check_svg_size . 'px!important;}';
    echo '.tutor-cuf-terms-icon{width:' . $icon_box . 'px!important;height:' . $icon_box . 'px!important;}';
    echo '.tutor-cuf-terms-text,.tutor-cuf-terms-link{font-size:' . $text_size . 'px!important;}';
    echo '.tutor-cuf-terms-label{padding:' . $label_padding_v . 'px ' . $label_padding_h . 'px!important;}';
    echo '</style>';

    echo '<div class="tutor-form-col-12">';
    echo '<div class="tutor-form-group tutor-cuf-field-wrap tutor-cuf-terms-wrap" data-type="terms" data-error-msg="' . esc_attr($error_msg) . '">';
    echo '<label class="tutor-cuf-terms-label">';
    echo '<input type="checkbox" name="tutor_cuf_terms_accepted" value="1" class="tutor-cuf-terms-checkbox">';
    echo '<span class="tutor-cuf-terms-checkmark">';
    echo '<svg class="tutor-cuf-terms-check-svg" width="' . $check_svg_size . '" height="' . $check_svg_size . '" viewBox="0 0 12 12" fill="none"><path d="M2.5 6L5 8.5L9.5 3.5" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>';
    echo '</span>';
    echo '<span class="tutor-cuf-terms-content">';
    echo '<span class="tutor-cuf-terms-icon">';
    echo '<svg width="' . $shield_svg . '" height="' . $shield_svg . '" viewBox="0 0 20 20" fill="none"><path d="M10 1L3 5v5c0 4.4 3 8.5 7 9.9 4-1.4 7-5.5 7-9.9V5l-7-4z" stroke="currentColor" stroke-width="1.5" fill="none"/><path d="M7 10l2 2 4-4" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>';
    echo '</span>';
    echo '<span class="tutor-cuf-terms-text">';
    echo esc_html($checkbox_text) . ' ';
    if (!empty($link_url)) {
        echo '<a href="' . esc_url($link_url) . '" target="_blank" rel="noopener noreferrer" class="tutor-cuf-terms-link">' . esc_html($link_text) . '</a>';
    } else {
        echo '<strong class="tutor-cuf-terms-link-text">' . esc_html($link_text) . '</strong>';
    }
    echo ' <span class="tutor-cuf-required">*</span>';
    echo '</span>';
    echo '</span>';
    echo '</label>';
    echo '</div>';
    echo '</div>';
}

/**
 * ============================================================
 * VALIDATION (BACKEND)
 * ============================================================
 */
function tutor_cuf_validate_field($field, $value) {
    $errors = [];
    $label  = $field['label'];
    $type   = $field['type'];

    // Required check
    if ($field['required'] === '1') {
        if ($type === 'checkbox') {
            if (empty($value) || (is_array($value) && count($value) === 0)) {
                $errors[] = sprintf(__('%s is required.', 'custom-user-registration-fields-tutor-lms'), $label);
            }
        } elseif (empty($value) && $value !== '0') {
            $errors[] = sprintf(__('%s is required.', 'custom-user-registration-fields-tutor-lms'), $label);
        }
    }

    if (empty($value)) return $errors;

    // Type-specific validation
    switch ($type) {
        case 'email':
            if (!is_email($value)) {
                $errors[] = sprintf(__('%s must be a valid email address.', 'custom-user-registration-fields-tutor-lms'), $label);
            }
            break;
        case 'phone':
            if (!preg_match('/^[0-9+]+$/', $value)) {
                $errors[] = sprintf(__('%s must contain only numbers.', 'custom-user-registration-fields-tutor-lms'), $label);
            }
            break;
        case 'number':
            if (!is_numeric($value)) {
                $errors[] = sprintf(__('%s must be a number.', 'custom-user-registration-fields-tutor-lms'), $label);
            }
            break;
        case 'url':
            if (!filter_var($value, FILTER_VALIDATE_URL)) {
                $errors[] = sprintf(__('%s must be a valid URL.', 'custom-user-registration-fields-tutor-lms'), $label);
            }
            break;
        case 'date':
            if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $value)) {
                $errors[] = sprintf(__('%s must be a valid date.', 'custom-user-registration-fields-tutor-lms'), $label);
            }
            break;
    }

    return $errors;
}

/**
 * ============================================================
 * SANITIZE FIELD VALUE
 * ============================================================
 */
function tutor_cuf_sanitize_field_value($field, $value) {
    switch ($field['type']) {
        case 'email':
            return sanitize_email($value);
        case 'url':
            return esc_url_raw($value);
        case 'textarea':
            return sanitize_textarea_field($value);
        case 'number':
            return intval($value);
        case 'checkbox':
            if (is_array($value)) {
                return implode(',', array_map('sanitize_text_field', $value));
            }
            return sanitize_text_field($value);
        case 'phone':
            // Phone value comes as full number (country_code + local) from hidden field
            return preg_replace('/[^0-9+]/', '', $value);
        default:
            return sanitize_text_field($value);
    }
}

/**
 * ============================================================
 * SAVE USER META ON REGISTRATION & PROFILE UPDATE
 * ============================================================
 */
/**
 * ============================================================
 * VALIDATE TERMS & CONDITIONS ON BACKEND
 * ============================================================
 */
add_filter('tutor_student_register_validation_errors', 'tutor_cuf_validate_terms', 10, 1);
add_filter('tutor_instructor_register_validation_errors', 'tutor_cuf_validate_terms_instructor', 10, 1);

function tutor_cuf_validate_terms($errors) {
    return tutor_cuf_check_terms_acceptance($errors, 'students');
}

function tutor_cuf_validate_terms_instructor($errors) {
    return tutor_cuf_check_terms_acceptance($errors, 'instructors');
}

function tutor_cuf_check_terms_acceptance($errors, $context) {
    $terms = get_option('tutor_cuf_terms_settings', array());
    if (empty($terms['enabled']) || $terms['enabled'] !== '1') return $errors;

    $apply = $terms['apply_to'] ?? 'both';
    if ($apply !== 'both' && $apply !== $context) return $errors;

    if (empty($_POST['tutor_cuf_terms_accepted'])) {
        $msg = $terms['error_message'] ?? __('You must accept the Terms & Conditions to register.', 'custom-user-registration-fields-tutor-lms');
        if (is_array($errors)) {
            $errors[] = $msg;
        } elseif (is_wp_error($errors)) {
            $errors->add('terms_not_accepted', $msg);
        }
    }
    return $errors;
}

/**
 * ============================================================
 * SAVE USER META ON REGISTRATION & PROFILE UPDATE
 * ============================================================
 */
add_action('user_register', 'tutor_cuf_save_all_custom_meta');
add_action('profile_update', 'tutor_cuf_save_all_custom_meta');

function tutor_cuf_save_all_custom_meta($user_id) {
    // Save terms acceptance
    if (!empty($_POST['tutor_cuf_terms_accepted'])) {
        update_user_meta($user_id, 'tutor_cuf_terms_accepted', '1');
        update_user_meta($user_id, 'tutor_cuf_terms_accepted_date', current_time('mysql'));
    }
    $all_field_sets = array(
        get_option('tutor_field_cuf_fields', []),
        get_option('tutor_field_cif_fields', []),
    );

    foreach ($all_field_sets as $fields) {
        if (!is_array($fields)) continue;
        foreach ($fields as $field) {
            if (!is_array($field) || empty($field['meta_key'])) continue;
            $meta_key = $field['meta_key'];

            // Phone: merge country code + local number
            if ($field['type'] === 'phone') {
                $country_code = isset($_POST[$meta_key . '_country_code']) ? sanitize_text_field($_POST[$meta_key . '_country_code']) : '';
                $local_number = isset($_POST[$meta_key . '_local']) ? preg_replace('/[^0-9]/', '', $_POST[$meta_key . '_local']) : '';
                $full_number = '';
                if (!empty($country_code) && !empty($local_number)) {
                    $full_number = $country_code . $local_number;
                } elseif (!empty($local_number)) {
                    $full_number = $local_number;
                }
                update_user_meta($user_id, $meta_key, $full_number);
                // Also save country code separately for re-editing
                update_user_meta($user_id, $meta_key . '_country_code', $country_code);
                continue;
            }

            if ($field['type'] === 'checkbox' && isset($_POST[$meta_key]) && is_array($_POST[$meta_key])) {
                $value = tutor_cuf_sanitize_field_value($field, $_POST[$meta_key]);
                update_user_meta($user_id, $meta_key, $value);
            } elseif (isset($_POST[$meta_key])) {
                $value = tutor_cuf_sanitize_field_value($field, $_POST[$meta_key]);
                update_user_meta($user_id, $meta_key, $value);
            }
        }
    }
}

/**
 * ============================================================
 * DISPLAY FIELDS ON ADMIN USER PROFILE
 * ============================================================
 */
add_action('show_user_profile', 'tutor_cuf_show_profile_fields');
add_action('edit_user_profile', 'tutor_cuf_show_profile_fields');
add_action('user_new_form', 'tutor_cuf_show_profile_fields');

function tutor_cuf_show_profile_fields($user) {
    $user_id = is_object($user) ? $user->ID : 0;

    // Student fields
    $student_fields = get_option('tutor_field_cuf_fields', []);
    if (!empty($student_fields) && is_array($student_fields)): ?>
        <h3><?php esc_html_e('Custom Student Fields', 'custom-user-registration-fields-tutor-lms'); ?></h3>
        <table class="form-table">
            <?php foreach ($student_fields as $field):
                if (!is_array($field) || empty($field['meta_key'])) continue;
                $value = $user_id ? get_user_meta($user_id, $field['meta_key'], true) : '';
                ?>
                <tr>
                    <th><label for="<?php echo esc_attr($field['meta_key']); ?>"><?php echo esc_html($field['label']); ?></label></th>
                    <td>
                        <?php tutor_cuf_render_profile_field($field, $value); ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif;

    // Instructor fields
    $instructor_fields = get_option('tutor_field_cif_fields', []);
    if (!empty($instructor_fields) && is_array($instructor_fields)): ?>
        <h3><?php esc_html_e('Custom Instructor Fields', 'custom-user-registration-fields-tutor-lms'); ?></h3>
        <table class="form-table">
            <?php foreach ($instructor_fields as $field):
                if (!is_array($field) || empty($field['meta_key'])) continue;
                $value = $user_id ? get_user_meta($user_id, $field['meta_key'], true) : '';
                ?>
                <tr>
                    <th><label for="<?php echo esc_attr($field['meta_key']); ?>"><?php echo esc_html($field['label']); ?></label></th>
                    <td>
                        <?php tutor_cuf_render_profile_field($field, $value); ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif;
}

/**
 * Render field on WP admin profile page
 */
function tutor_cuf_render_profile_field($field, $value) {
    $meta_key = $field['meta_key'];
    $type     = $field['type'];

    switch ($type) {
        case 'textarea':
            echo '<textarea name="' . esc_attr($meta_key) . '" id="' . esc_attr($meta_key) . '" rows="4" class="regular-text">' . esc_textarea($value) . '</textarea>';
            break;

        case 'select':
            $options = tutor_cuf_parse_options($field['options']);
            echo '<select name="' . esc_attr($meta_key) . '" id="' . esc_attr($meta_key) . '">';
            echo '<option value="">-- ' . esc_html__('Select', 'custom-user-registration-fields-tutor-lms') . ' --</option>';
            foreach ($options as $opt_val => $opt_label) {
                echo '<option value="' . esc_attr($opt_val) . '" ' . selected($value, $opt_val, false) . '>' . esc_html($opt_label) . '</option>';
            }
            echo '</select>';
            break;

        case 'radio':
            $options = tutor_cuf_parse_options($field['options']);
            foreach ($options as $opt_val => $opt_label) {
                $uid = esc_attr($meta_key . '_' . sanitize_key($opt_val));
                echo '<label style="margin-right:15px;"><input type="radio" name="' . esc_attr($meta_key) . '" value="' . esc_attr($opt_val) . '" ' . checked($value, $opt_val, false) . '> ' . esc_html($opt_label) . '</label>';
            }
            break;

        case 'checkbox':
            $options = tutor_cuf_parse_options($field['options']);
            $current = is_string($value) ? explode(',', $value) : (is_array($value) ? $value : []);
            foreach ($options as $opt_val => $opt_label) {
                $is_checked = in_array($opt_val, $current);
                echo '<label style="margin-right:15px;"><input type="checkbox" name="' . esc_attr($meta_key) . '[]" value="' . esc_attr($opt_val) . '" ' . checked($is_checked, true, false) . '> ' . esc_html($opt_label) . '</label>';
            }
            break;

        case 'date':
            echo '<input type="date" name="' . esc_attr($meta_key) . '" id="' . esc_attr($meta_key) . '" value="' . esc_attr($value) . '" class="regular-text">';
            break;

        case 'phone':
            $countries = tutor_cuf_get_country_codes();
            $parsed = tutor_cuf_parse_phone_value($value);
            $selected_code = $parsed['country_code'];
            $local_number = $parsed['local_number'];

            echo '<div style="display:flex;gap:10px;align-items:center;flex-wrap:wrap;">';
            echo '<div style="display:flex;align-items:center;gap:6px;">';
            // Show flag image for selected
            $sel_iso = '';
            foreach ($countries as $c) {
                if ($selected_code === $c['code']) { $sel_iso = strtolower($c['iso']); break; }
            }
            if ($sel_iso) {
                echo '<img src="https://flagcdn.com/w40/' . esc_attr($sel_iso) . '.png" width="24" height="16" style="border-radius:2px;">';
            }
            echo '<select name="' . esc_attr($meta_key) . '_country_code" style="width:240px;padding:6px 10px;border:1px solid #ddd;border-radius:4px;font-size:14px;">';
            echo '<option value="">' . esc_html__('-- Country Code --', 'custom-user-registration-fields-tutor-lms') . '</option>';
            foreach ($countries as $country) {
                $opt_val = $country['code'];
                $opt_label = $country['flag'] . ' ' . $country['name'] . ' (' . $country['code'] . ')';
                $is_selected = ($selected_code === $country['code']);
                echo '<option value="' . esc_attr($opt_val) . '"' . ($is_selected ? ' selected' : '') . '>' . esc_html($opt_label) . '</option>';
            }
            echo '</select>';
            echo '</div>';
            echo '<input type="tel" name="' . esc_attr($meta_key) . '_local" value="' . esc_attr($local_number) . '" class="regular-text" style="flex:1;min-width:200px;" inputmode="numeric" placeholder="' . esc_attr__('Phone number', 'custom-user-registration-fields-tutor-lms') . '">';
            echo '<input type="hidden" name="' . esc_attr($meta_key) . '" class="tutor-cuf-phone-full" value="' . esc_attr($value) . '">';
            echo '</div>';
            echo '<p class="description">' . esc_html__('Select country code then enter phone number without the code.', 'custom-user-registration-fields-tutor-lms') . '</p>';
            break;

        case 'email':
            echo '<input type="email" name="' . esc_attr($meta_key) . '" id="' . esc_attr($meta_key) . '" value="' . esc_attr($value) . '" class="regular-text">';
            break;

        case 'url':
            echo '<input type="url" name="' . esc_attr($meta_key) . '" id="' . esc_attr($meta_key) . '" value="' . esc_attr($value) . '" class="regular-text">';
            break;

        case 'number':
            echo '<input type="number" name="' . esc_attr($meta_key) . '" id="' . esc_attr($meta_key) . '" value="' . esc_attr($value) . '" class="regular-text">';
            break;

        default:
            echo '<input type="text" name="' . esc_attr($meta_key) . '" id="' . esc_attr($meta_key) . '" value="' . esc_attr($value) . '" class="regular-text">';
            break;
    }
}

/**
 * ============================================================
 * SAVE PROFILE FIELDS (ADMIN)
 * ============================================================
 */
add_action('personal_options_update', 'tutor_cuf_save_profile_fields');
add_action('edit_user_profile_update', 'tutor_cuf_save_profile_fields');

function tutor_cuf_save_profile_fields($user_id) {
    if (!current_user_can('edit_user', $user_id)) {
        return false;
    }

    $all_field_sets = array(
        get_option('tutor_field_cuf_fields', []),
        get_option('tutor_field_cif_fields', []),
    );

    foreach ($all_field_sets as $fields) {
        if (!is_array($fields)) continue;
        foreach ($fields as $field) {
            if (!is_array($field) || empty($field['meta_key'])) continue;
            $meta_key = $field['meta_key'];

            // Phone: merge country code + local number
            if ($field['type'] === 'phone') {
                $country_code = isset($_POST[$meta_key . '_country_code']) ? sanitize_text_field($_POST[$meta_key . '_country_code']) : '';
                $local_number = isset($_POST[$meta_key . '_local']) ? preg_replace('/[^0-9]/', '', $_POST[$meta_key . '_local']) : '';
                $full_number = '';
                if (!empty($country_code) && !empty($local_number)) {
                    $full_number = $country_code . $local_number;
                } elseif (!empty($local_number)) {
                    $full_number = $local_number;
                }
                update_user_meta($user_id, $meta_key, $full_number);
                update_user_meta($user_id, $meta_key . '_country_code', $country_code);
                continue;
            }

            if ($field['type'] === 'checkbox') {
                if (isset($_POST[$meta_key]) && is_array($_POST[$meta_key])) {
                    $value = implode(',', array_map('sanitize_text_field', $_POST[$meta_key]));
                } else {
                    $value = '';
                }
                update_user_meta($user_id, $meta_key, $value);
            } elseif (isset($_POST[$meta_key])) {
                $value = tutor_cuf_sanitize_field_value($field, $_POST[$meta_key]);
                update_user_meta($user_id, $meta_key, $value);
            }
        }
    }
}

/**
 * ============================================================
 * ADMIN COLUMNS: Show custom fields in Users list
 * ============================================================
 */
add_filter('manage_users_columns', 'tutor_cuf_add_user_columns');
function tutor_cuf_add_user_columns($columns) {
    $student_fields = get_option('tutor_field_cuf_fields', []);
    if (is_array($student_fields)) {
        foreach ($student_fields as $field) {
            if (!is_array($field) || empty($field['meta_key'])) continue;
            $columns['cuf_' . $field['meta_key']] = $field['label'];
        }
    }
    return $columns;
}

add_filter('manage_users_custom_column', 'tutor_cuf_user_column_content', 10, 3);
function tutor_cuf_user_column_content($value, $column_name, $user_id) {
    if (strpos($column_name, 'cuf_') === 0) {
        $meta_key = substr($column_name, 4);
        $meta_value = get_user_meta($user_id, $meta_key, true);
        return esc_html($meta_value);
    }
    return $value;
}

add_filter('manage_users_sortable_columns', 'tutor_cuf_sortable_columns');
function tutor_cuf_sortable_columns($columns) {
    $student_fields = get_option('tutor_field_cuf_fields', []);
    if (is_array($student_fields)) {
        foreach ($student_fields as $field) {
            if (!is_array($field) || empty($field['meta_key'])) continue;
            $columns['cuf_' . $field['meta_key']] = $field['meta_key'];
        }
    }
    return $columns;
}

/**
 * ============================================================
 * EXPORT USER DATA (CSV)
 * ============================================================
 */
add_action('admin_init', 'tutor_cuf_handle_export');
function tutor_cuf_handle_export() {
    if (!isset($_GET['tutor_cuf_export']) || $_GET['tutor_cuf_export'] !== '1') return;
    if (!current_user_can('manage_options')) return;
    if (!wp_verify_nonce($_GET['_wpnonce'] ?? '', 'tutor_cuf_export_nonce')) return;

    $users = get_users();
    $student_fields = get_option('tutor_field_cuf_fields', []);
    $instructor_fields = get_option('tutor_field_cif_fields', []);
    $all_fields = array_merge(
        is_array($student_fields) ? $student_fields : [],
        is_array($instructor_fields) ? $instructor_fields : []
    );

    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=tutor-users-export-' . date('Y-m-d') . '.csv');

    $output = fopen('php://output', 'w');
    // UTF-8 BOM for Arabic support
    fprintf($output, chr(0xEF).chr(0xBB).chr(0xBF));

    // Header row
    $header = array('ID', 'Username', 'Email', 'Display Name');
    foreach ($all_fields as $field) {
        if (is_array($field) && !empty($field['label'])) {
            $header[] = $field['label'];
        }
    }
    fputcsv($output, $header);

    // Data rows
    foreach ($users as $user) {
        $row = array($user->ID, $user->user_login, $user->user_email, $user->display_name);
        foreach ($all_fields as $field) {
            if (is_array($field) && !empty($field['meta_key'])) {
                $row[] = get_user_meta($user->ID, $field['meta_key'], true);
            }
        }
        fputcsv($output, $row);
    }

    fclose($output);
    exit;
}
