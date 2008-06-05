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

// first argument
if (empty($argv[1])) {
	die("Missing argument: source icon theme folder\n");
}

$source_dir = $argv[1];
if (!file_exists($source_dir)) {
	die("$source_dir does not exist\n");
}

// second argument
if (empty($argv[2])) {
	die("Missing argument: target folder\n");
}

$target_dir = $argv[2];
if (!file_exists($target_dir)) {
	mkdir($target_dir) or die("Cannot create directory $target_dir\n");
}

$icons = array(
	// toolbars
	"actions/document-new" => "actions/filenew",
	"actions/document-print" => "actions/fileprint",
	"actions/document-save" => "actions/filesave",
	"actions/edit-undo" => "actions/undo",
	"actions/edit-delete" => "actions/cancel",
	"actions/go-jump" => "actions/ok",
	"actions/go-first" => "actions/2leftarrow",
	"actions/go-previous" => "actions/1leftarrow",
	"actions/go-next" => "actions/1rightarrow",
	"actions/go-last" => "actions/2rightarrow",
	"actions/window-close" => "actions/fileclose",

	// db navigator
	"actions/go-home" => "actions/gohome",
	"places/folder" => "filesystems/folder",
	"status/folder-open" => "filesystems/folder_open",
	
	// messages
	"status/dialog-error" => "actions/messagebox_critical",
	"status/dialog-information" => "actions/messagebox_info",
	"status/dialog-warning" => "actions/messagebox_warning",
	
	// various
	"actions/system-search" => "actions/find",
	"mimetypes/text-x-generic" => "mimetypes/empty",
);

$sizes = array(32, 22, 16);
foreach ($sizes as $size) {
	foreach ($icons as $freedesktop_icon=>$icon) {
		$file = "$source_dir/{$size}x{$size}/$icon.png";
		if (file_exists($file)) {
			$subpath = explode('/', $freedesktop_icon);
			$subpath = $subpath[0];
			exec("mkdir -p $target_dir/$size/$subpath");
			copy($file, "$target_dir/$size/$freedesktop_icon.png");
			continue;
		}
		
		print "{$size}/$icon does not exist\n";
	}
}