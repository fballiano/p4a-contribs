<?php
/**
 * This file is part of P4A - PHP For Applications.
 *
 * P4A is free software: you can redistribute it and/or modify it under
 * the terms of the GNU Affero General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 * 
 * P4A is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Affero General Public License for more details.
 * 
 * You should have received a copy of the GNU Affero General Public License
 * along with Foobar.  If not, see <http://www.gnu.org/licenses/agpl.html>.
 * 
 * To contact the authors write to:									<br />
 * CreaLabs SNC														<br />
 * Via Medail, 32													<br />
 * 10144 Torino (Italy)												<br />
 * Website: {@link http://www.crealabs.it}							<br />
 * E-mail: {@link mailto:info@crealabs.it info@crealabs.it}
 *
 * @author Andrea Giardina <andrea.giardina@crealabs.it>
 * @author Fabrizio Balliano <fabrizio.balliano@crealabs.it>
 * @copyright CreaLabs SNC
 * @link http://www.crealabs.it
 * @link http://p4a.sourceforge.net
 * @license http://www.gnu.org/licenses/agpl.html GNU Affero General Public License
 * @package p4a
 */

if (!exec("which rsvg")) {
	die("rsvg is not installed\n");
}

// first argument: target directory
if (empty($argv[1])) {
	die("Missing argument: Target directory for theme creation\n");
}

$target_dir = $argv[1];
if (!file_exists($target_dir)) {
	mkdir($target_dir) or die("Cannot create directory $target_dir\n");
}

// second argument: source theme folder 1
if (empty($argv[2])) {
	die("Missing argument: Theme folder\n");
}

$source_dir1 = $argv[2];
if (!is_dir($source_dir1)) {
	die("$source_dir1 is not a directory");
}

// third argument: source theme folder 2
if (!empty($argv[3])) {
	$source_dir2 = $argv[3];
	if (!is_dir($source_dir2)) {
		die("$source_dir2 is not a directory");
	}
}

$icons = array(
	// toolbars
	"actions/document-new",
	"actions/document-print",
	"actions/document-save",
	"actions/edit-undo",
	"actions/edit-delete",
	"actions/go-jump",
	"actions/go-first",
	"actions/go-previous",
	"actions/go-next",
	"actions/go-last",
	"actions/window-close",

	// db navigator
	"actions/go-home",
	"places/folder",
	"status/folder-open",
	
	// messages
	"status/dialog-error",
	"status/dialog-information",
	"status/dialog-warning",
	
	// various
	"actions/system-search",
	"mimetypes/text-x-generic",
);

$sizes = array(32, 22, 16);
foreach ($sizes as $size) {
	foreach ($icons as $icon) {
		$file = "$source_dir1/{$size}x{$size}/$icon.png";
		if (file_exists($file)) {
			copy_file($file, $target_dir);
			continue;
		}
		
		$file = "$source_dir1/scalable/$icon.svg";
		if (file_exists($file)) {
			svg2png($file, $target_dir, $size);
			continue;
		}
		
		if (isset($source_dir2)) {
			$file = "$source_dir2/{$size}x{$size}/$icon.png";
			if (file_exists($file)) {
				copy_file($file, $target_dir);
				continue;
			}
			
			$file = "$source_dir2/scalable/$icon.svg";
			if (file_exists($file)) {
				svg2png($file, $target_dir, $size);
				continue;
			}
		}
		
		die("$icon was not found in the source themes directories\n");
	}
}

function svg2png($file, $target_dir, $size)
{
	$target_dir .= "/$size/" . get_file_subdir($file);
	@mkdir($target_dir, 0755, true);
	$target_file = substr(basename($file), 0, -3) . 'png';
	exec("rsvg -d 72 -p 72 -w $size -h $size -f png $file $target_dir/$target_file", $output, $ret);
	if ($ret != 0) die("Unable to convert $file to PNG format\n");
}

function copy_file($file, $target_dir)
{
	$target_dir .= "/" . get_file_subdir($file);
	@mkdir($target_dir, 0755, true);
	copy($file, "$target_dir/" . basename($file)) or die("$file cannot be copied to $target_dir\n");
}

function get_file_subdir($existing_file)
{
	$path = dirname($existing_file);
	$path = explode("/", $path);
	
	$group = array_pop($path);
	$size = explode('x', array_pop($path));
	$size = $size[0];
	
	if ($size == "scalable") {
		return $group;
	}
	return "$size/$group";
}