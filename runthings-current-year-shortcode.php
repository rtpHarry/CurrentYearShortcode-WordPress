<?php
/*
Plugin Name: Current Year Shortcode
Plugin URI: https://runthings.dev
Description: Add a shortcode for displaying the current year as a range, usage: [year from="2025"] or [runthings_year from="2025"] if there's a conflict
Version: 1.3.0
Author: runthingsdev
Author URI: https://runthings.dev/
License: GPLv3 or later
License URI: http://www.gnu.org/licenses/gpl-3.0.html

Copyright 2022-2025 Matthew Harris

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as
published by the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 */

namespace RunthingsCurrentYearShortcode;

if (!defined('WPINC')) {
    die;
}

class CurrentYearShortcode
{
    /**
     * The actual shortcode tag that is registered
     * 
     * @var string
     */
    private $shortcode_tag = 'year';

    /**
     * Initialize the plugin and register hooks
     */
    public function __construct()
    {
        // Register shortcode on init with low priority (20)
        // This ensures we register after most other plugins, allowing us to check for conflicts
        add_action('init', array($this, 'register_shortcode'), 20);
    }

    /**
     * Register our shortcode on init
     * 
     * If 'year' shortcode already exists, we'll use 'runthings_year' instead
     * Running at a lower priority (higher number) lets us adapt to other plugins
     */
    public function register_shortcode()
    {
        // Check if the 'year' shortcode already exists
        if (shortcode_exists('year')) {
            $this->shortcode_tag = 'runthings_year';
        }

        // Register our shortcode with the appropriate tag
        add_shortcode($this->shortcode_tag, array($this, 'render'));
    }

    /**
     * Shortcode to display current year in a copyright statement.
     *
     * Set "from" to apply a range when "from" year has passed.
     * Set "mode" to "short" to abbreviate the end year when the century matches.
     *
     * @example
     * // assuming current year is 2025
     * [year] = 2025 (or [runthings_year] if 'year' is taken)
     * @example
     * // assuming current year is 2025
     * [year from="2025"] = 2025
     * @example
     * // assuming current year is 2025
     * [year from="1983"] = 1983-2025
     * @example
     * // assuming current year is 2025
     * [year from="2020" mode="short"] = 2020-25
     * @example
     * // assuming current year is 2025
     * [year from="1995" mode="short"] = 1995-2025
     *
     * @param array $atts Shortcode attributes
     * @return string The current year or year range specified
     */
    public function render($atts)
    {
        $output = '';

        $atts = shortcode_atts(
            array(
                'from' => null,
                'mode' => 'long',
            ),
            $atts,
            'year'
        );

        $year = current_time('Y');
        $from = $atts['from'];
        $mode = strtolower($atts['mode']);

        $output = $year;

        if ($from !== null && $from < $year) {
            $formatted_year = $year;

            if ($mode === 'short' && substr($from, 0, 2) === substr($year, 0, 2)) {
                $formatted_year = substr($year, 2);
            }

            $output = "$from-$formatted_year";
        }

        return $output;
    }
}

// Initialize the plugin
new CurrentYearShortcode();
