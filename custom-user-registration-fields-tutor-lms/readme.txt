=== Custom User Registration Fields for Tutor LMS ===
Contributors: userelements
Tags: tutor lms, tutor, registration field, user field
Requires at least: 6.0
Tested up to: 6.8
Requires PHP: 7.2
Requires Plugins: tutor
Stable tag: 1.3
License: GPL2+
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Add Custom User Registration Fields for Tutor LMS.

## Description

Custom User Registration Fields for Tutor LMS extends your Tutor LMS registration process by allowing you to add custom fields for both student and instructor registrations. This plugin provides a simple admin interface to manage custom fields without any coding knowledge required.

== How It Works == 

1. Install and activate the plugin
2. Navigate to Users → Tutor LMS User Fields in your admin panel
3. Add custom fields with labels and meta keys
4. Fields automatically appear on registration forms
5. User data is saved and displayed on profile pages

== Frequently Asked Questions ==
= Does this plugin require Tutor LMS? =
Yes, this plugin is specifically designed to work with Tutor LMS and requires it to be installed and active.
= Can I add different fields for students and instructors? =
Absolutely! The plugin provides separate sections for student and instructor registration fields.
= Are the custom fields required or optional? =
Currently, all custom fields are optional. Users can complete registration without filling them out.
= Can I edit or remove fields after creating them? =
Yes, you can easily edit field labels, modify meta keys, or remove fields entirely from the admin panel.
= Where is the custom field data stored? =
All custom field data is stored as WordPress user meta, making it accessible through standard WordPress functions.


== Tutorials & Guides ==

- [17 Awesome Websites Made with Tutor LMS](https://www.userelements.com/list/tutor-lms-website-examples/)
- [The Complete List of Tutor LMS Shortcodes and How to Use Them – Tutor LMS](https://www.userelements.com/tutor-lms-shortcodes/)
- [Sending Reminder Emails to Inactive Students – Tutor LMS](https://www.userelements.com/sending-reminder-emails-to-inactive-students-tutor-lms/)
- [Tutor LMS – Get Student Information in PHP](https://www.userelements.com/tutor-lms-get-student-information-in-php/)
- [How to Hide, Remove or Disable Reviews or Star Rating in Tutor LMS](https://www.userelements.com/remove-tutor-reviews/)
- [Create a User Directory with Elementor](https://userelements.com/create-user-directory-elementor/)
- [Best WordPress LMS Plugins to Create and Sell Courses Online](https://www.userelements.com/list/best-wordpress-lms-plugins/)


== More Plugins by UserElements ==

- [Personalized User Menu for TutorLMS](https://www.userelements.com/mightymenu-tutorlms/)
- [WP User Data](https://www.userelements.com/wp-user-data/)
- [User Broadcast Email](https://www.userelements.com/user-broadcast-email/)
- [Elementor Product Table for WooCommerce](https://wordpress.org/plugins/product-table-for-elementor)

== Support ==
For technical support, feature requests, or general questions, please visit userelements.com or create a support ticket in the WordPress.org plugin forum.



## Installation

1. Upload the plugin files to the `/wp-content/plugins/tutor-lms-custom-user-registration-fields` directory, or install the plugin through the WordPress plugins screen directly.
2. Activate the plugin through the 'Plugins' screen in WordPress.
3. Navigate to the 'Users' menu and select 'Tutor LMS User Fields' to configure the custom fields.

## Usage

### Admin Panel

1. Go to `Users` -> `Tutor LMS User Fields` to manage custom fields.
2. There are two tabs: `Student Registration Fields` and `Instructor Registration Fields`.
3. Add new fields by filling in the `Field Label` and `Meta Key` and clicking `Add Field`.
4. Remove fields by clicking the `Remove` button next to the respective field.
5. Save changes by clicking the `Save Changes` button.

### Frontend

Custom fields will automatically appear on the Tutor LMS registration forms for students and instructors.

### Hooks and Functions

- **Admin Menu:**
  - Adds a submenu under the `Users` menu for plugin settings.
- **Custom CSS:**
  - Enqueues custom CSS for the plugin settings page.
- **Settings Page:**
  - Displays the settings page for managing custom fields.
- **User Meta:**
  - Adds and updates custom user meta during registration and profile updates.
- **Profile Page:**
  - Displays custom fields on the user profile page.
- **Registration Forms:**
  - Adds custom fields to Tutor LMS registration forms for students and instructors.

## License

This plugin is licensed under the GNU General Public License v2.0. See the [License URI](http://www.gnu.org/licenses/gpl-2.0.html) for more details.

## Credits

- Developed by [userelements](http://userelements.com/).

## Support

For support, please visit [userelements.com](http://userelements.com/).

== Screenshots ==

1. TutorLMS adding user registration fields

## Changelog

= 1.3: August 25, 2024 =
* Fixed update_user_meta error that was preventing proper data saving

= 1.2: August 25, 2024 =
* Fixed Tested Up To Value
* Added wp_enqueue commands
* Fixed Internationalization
* Prefixed Options and Transients.

= 1.1: August 18, 2024 =
* Fix - Fix plugin name.

= 1.0: August 4, 2024 =
* Initial release.