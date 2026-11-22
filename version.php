<?php
/**
*
* @package MoT DIM v1.3.1
* @copyright (c) 2024 - 2026 Mike-on-Tour
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

$composer = json_decode(file_get_contents(__DIR__ . '/composer.json'), true);
$version = $composer['version'] ?? '0.0.0';

header('Content-Type: image/svg+xml; charset=UTF-8');

?>
<svg xmlns="http://www.w3.org/2000/svg"
	width="100" height="18"
	viewBox="0 0 100 18"
	role="img">

	<defs>
		<linearGradient id="plastic" x2="0" y2="100%">
		<stop offset="0" stop-color="#fff" stop-opacity=".5"/>
		<stop offset="1" stop-color="#000" stop-opacity=".2"/>
		</linearGradient>
	</defs>

	<rect width="100" height="18" rx="3" fill="#555"/>
	<rect x="49" width="51" height="18" rx="3" fill="#4c1"/>
	<rect width="100" height="18" rx="3" fill="url(#plastic)"/>

	<g fill="#fff"
		font-family="Verdana,Arial,sans-serif"
		font-size="11">

		<text x="24.5" y="13" text-anchor="middle">Version</text>
		<text x="74" y="13" text-anchor="middle"><?php echo htmlentities($version, ENT_QUOTES | ENT_SUBSTITUTE | ENT_HTML401, 'UTF-8') ?></text>
	</g>
</svg>
