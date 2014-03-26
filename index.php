<?php

/**
 * MiniRouter - A compact but powerful URI routing class.
 *
 * @author     Reno Philibert <me@renophilibert.com>
 * @copyright  2013-2014 MineDesign, LTD.
 * @license    GNU General Public License v3
 * @version    1.0.0
 * @link       https://github.com/rjp2525/Mini-Router
 *
 */

// Include the core router class
include 'minirouter.class.php';

// Create a new instance of the router
$uri = new MiniRouter();

// Add the route for the homepage
$uri->add('/', function() {
	// Display homepage content here
	echo 'This is the <b>main</b> homepage.';
});

// A profile homepage, for example:
$uri->add('/profile', function() {
	// Possibly display the logged in user's profile here
	echo 'This is the <b>profile</b> homepage.';
});

// Show the profile of a username entered
$uri->add('/profile/.+', function($username) {
	// Check if the user exists etc. then display specific content for this user
	echo 'This is <b>'.$username.'</b>\'s profile.';
});

// Here's another example of multiple URI parameters
$uri->add('/this/is/a/.+/uri/for/.+', function($first, $second) {
	// You can do whatever you want with this, this is just an example for showing off the parameters
	echo 'This is a <b>'.$first.'</b> URI for <b>'.$second.'</b>.';
});

// Finally, we compile the new URI routes that are added above
$uri->compile();