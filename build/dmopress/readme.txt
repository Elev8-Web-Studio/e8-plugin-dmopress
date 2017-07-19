=== DMOPress ===
Contributors: jasonpomerleau
Tags: directory, tourism, maps, places, dmo
Requires at least: 4.7
Tested up to: 4.8.0
Stable tag: 2.3.0
License: GPLv2
License URI: https://www.gnu.org/licenses/gpl-2.0.html

== Description ==

Build amazing websites powered by Places. Built for tourism offices, tour operators and other Destination Marketing Organizations.

== Features ==

* Works with any WordPress theme, including your current WordPress website!
* Adds a robust [Places post type](https://www.dmopress.com/guide/introducing-places/) to WordPress
* Unlimited [categories, features and tags](https://www.dmopress.com/guide/place-categories-place-features-and-tags/) to show your Places from a variety of different perspectives
* Easily create [interactive Google Maps](https://www.dmopress.com/guide/maps/) using any one of [6 beautiful built-in map themes](https://www.dmopress.com/guide/map-themes/), or create dynamic maps of many Places based on Categories, Features or Tags.
* Show popular ratings and reviews with 6 built-in [TripAdvisor Widget shortcodes](https://www.dmopress.com/guide/tripadvisor-widgets/).
* Show current weather conditions and temperature at your destination with a new [inline weather shortcode and widget](https://www.dmopress.com/guide/shortcodes/dmo-inline-weather/).
* Embedded JSON-LD Schema.org metadata for richer search engine indexing and enhanced discoverability.
* WPML translation ready – fully internationalizable!
* Designer Friendly: Override all plugin HTML and CSS with your own templates.
* Works with parent and child themes.
* See the [Theming Guide](https://www.dmopress.com/guide/theming/) and [API documentation](https://www.dmopress.com/guide/) for complete documentation and template samples.
* Developer Friendly: [Well-documented API](https://www.dmopress.com/guide/) and easy to extend.

== Installation ==

For installation instructions, check out our [10 Minute Quick Start Guide](https://www.dmopress.com/guide/start/)

== Screenshots ==

1. Sample Places post with TwentySeventeen theme.
2. Sample Places post in WordPress administration area.
3. New Places post type.banner-772x250

== Changelog ==

= 2.3.0 =
* Redesigned map marker callout windows contain a richer display of information, including a bolder heading and a Featured Image, if one is present.
* You can now request driving directions to any Place (walking directions coming soon) from the new marker callout windows. Requires [Google Maps Directions API](https://developers.google.com/maps/documentation/directions/) to be enabled in your Google Developers Console. Subject to [Google Maps Directions API](https://developers.google.com/maps/documentation/directions/) rate limits. This feature is off by default but can be activated with the new [[dmo-map](https://www.dmopress.com/guide/shortcodes/dmo-map/)] shortcode parameter show-directions.
* Improved geolocation services: map now dims while location or directions are being retrieved and displays a status message.
* All map outputs (i.e. status messages, error messages) now have corresponding translation string coverage.
* Added 3 new dmo-map shortcode options: [show-directions](https://www.dmopress.com/guide/shortcodes/dmo-map/#show-directions), [show-google-link](https://www.dmopress.com/guide/shortcodes/dmo-map/#show-google-link) and [show-post-thumbnail](https://www.dmopress.com/guide/shortcodes/dmo-map/#show-post-thumbnail) to support new map features.
* Added WordPress REST API support to Places post type, Place Categories taxonomy and Place Features taxonomy.

= 2.2.0 =
* Places can now have an icon/symbol association. This symbol can be used on map markers or in other theme locations. Choose from 175 location-oriented map icons.
* New SVG-based map markers with more styling/theming options.
* New dark map theme: Midnight
* New [dmo-map] shortcode parameters: [marker-stroke-weight](https://www.dmopress.com/guide/shortcodes/dmo-map/#marker-stroke-weight), [marker-stroke-color](https://www.dmopress.com/guide/shortcodes/dmo-map/#marker-stroke-color), [marker-stroke-opacity](https://www.dmopress.com/guide/shortcodes/dmo-map/#marker-stroke-opacity), [marker-fill-color](https://www.dmopress.com/guide/shortcodes/dmo-map/#marker-fill-color), [marker-fill-opacity](https://www.dmopress.com/guide/shortcodes/dmo-map/#marker-fill-opacity), [marker-label-color](https://www.dmopress.com/guide/shortcodes/dmo-map/#marker-label-color), and [marker-svg-path](https://www.dmopress.com/guide/shortcodes/dmo-map/#marker-svg-path).
* Several minor improvements and bug fixes.

= 2.1.0 =
* A new [inline weather widget and shortcode](https://www.dmopress.com/guide/shortcodes/dmo-inline-weather/) that integrates with the OpenWeatherMaps API service. Display current weather conditions for your destination just about anywhere, including Revolution Slider panels.
* All shortcodes are now integrated with [Visual Composer](https://www.dmopress.com/visual-composer/), a popular WordPress layout manager.
* Settings for DMOPress can now be managed on the 'classic' settings page (Settings > DMOPress) as well as in the WordPress Customizer.
* Improved installation experience via automatic refresh of permalinks upon activation.

= 2.0.0 =
* The DMOPress WordPress Plugin is now FREE and open source. [Follow us on Github](https://github.com/dmopress).
* DMOPress now works with all WordPress themes!
* Create beautifully styled maps with [6 gorgeous new map themes](https://www.dmopress.com/guide/map-themes/).
* All Places now have embedded JSON-LD Schema.org metadata for richer search engine indexing and enhanced discoverability.
* Leverage reviews and ratings from the most popular travel website in the world with 6 new [TripAdvisor widgets](https://www.dmopress.com/guide/tripadvisor-widgets/).
* DMOPress now integrates with the popular [The Events Calendar](https://theeventscalendar.com/product/wordpress-events-calendar/) and The [Events Calendar Pro](https://theeventscalendar.com/product/wordpress-events-calendar-pro/) plugins. Replaces the default Venue field with a selection of your Places for a seamless event management experience.
* Built-in geocoding service converts addresses into map coordinates with a single click.
* DMOPress is now fully translation-ready and [WPML compatible](https://wpml.org/).
* Introduction of designer and developer API with [22 thoroughly documented functions](https://www.dmopress.com/guide/functions/).
* All DMOPress templates can be easily customized in parent and child themes with template inheritance.
* Detailed online documentation for [users, theme designers and developers](https://www.dmopress.com/guide/).
* Numerous behind-the-scenes improvements to stabilize the core API and adhere to WordPress best practices.

= 1.0.0 =
* Initial release.
