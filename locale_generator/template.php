<?php

/**
 * P4A - PHP For Applications.
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License version 2
 * as published by the Free Software Foundation.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
 *
 * To contact the authors write to:									<br>
 * CreaLabs															<br>
 * Via Medail, 32													<br>
 * 10144 Torino (Italy)												<br>
 * Web:    {@link http://www.crealabs.it}							<br>
 * E-mail: {@link mailto:info@crealabs.it info@crealabs.it}
 *
 * The latest version of p4a can be obtained from:
 * {@link http://p4a.sourceforge.net}
 *
 * @link http://p4a.sourceforge.net
 * @link http://www.crealabs.it
 * @link mailto:info@crealabs.it info@crealabs.it
 * @copyright CreaLabs
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License
 * @author Fabrizio Balliano <fabrizio.balliano@crealabs.it>
 * @author Andrea Giardina <andrea.giardina@crealabs.it>
 * @package p4a
 */

define('P4A_I18N_DECIMAL_SEPARATOR', '[DS]');
define('P4A_I18N_THOUSAND_SEPARATOR', '[TS]');

require dirname(dirname(__FILE__)) . '/defaults.php';

$datetime_formats = array
(
	"date_default"	=>	'[DATE_DEFAULT]',
	"date_medium"	=>	'[DATE_MEDIUM]',
	"date_long"		=>	'[DATE_LONG]',
	"date_full"		=>	'[DATE_FULL]',

	"time_default"	=>	'[TIME_DEFAULT]',
	"time_long"		=>	'[TIME_LONG]'
);

$currency_formats = array
(
	"local"         => array('[LOCAL_CURRENCY_PRINT]', [LOCAL_CURRENCY_DECIMAILS], P4A_I18N_DECIMAL_SEPARATOR, P4A_I18N_THOUSAND_SEPARATOR),
	"international" => array('[INTERNATIONAL_CURRENCY_PRINT]', [INTERNATIONAL_CURRENCY_DECIMAILS], P4A_I18N_DECIMAL_SEPARATOR, P4A_I18N_THOUSAND_SEPARATOR)
);

?>