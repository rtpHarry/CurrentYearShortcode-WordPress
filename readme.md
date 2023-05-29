# Introduction
This is a plugin which adds a simple shortcode to display a dynamic
year, for use in copyright statements.

Its most basic usage is [year], for the current year, but it will expand
into a date range if the 'from' year is before the current year.

# Usage
Install the plugin and activate it.

Set "from" to apply a range, after "from" year has passed.

// assuming current year is 2023
[year] = 2023

// assuming current year is 2023
[year from="2023"] = 2023

// assuming current year is 2023
[year from="1983"] = 1983-2023

# Download
Download and contribute issues at:

https://github.com/rtpHarry/EmptyMediaTitle-Wordpress/

# Changelog

1.2.0 - 29th May 2023

- Update year examples to 2023

1.1.0 - 19th February 2022

- Added licence
- Updated plugin meta
- Added readme file
- Initial public release

1.0.0 - 25th August 2021

- Internal release

# Licence
This plugin is licenced under GPL 3, and is free to use on personal and 
commercial projects.

# Author
Built by Matthew Harris of runthings.dev, copyright 2022.

https://runthings.dev/
