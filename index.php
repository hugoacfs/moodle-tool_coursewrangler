<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * This is a tool for managing retiring old courses, and categories.
 * @package   tool_coursewrangler
 * @author    Hugo Soares <h.soares@chi.ac.uk>
 * @copyright 2020 University of Chichester {@link www.chi.ac.uk}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace tool_coursewrangler;

use context_system;
use moodle_url;

require_once(__DIR__ . '/../../../config.php');
require_once($CFG->libdir . '/adminlib.php');
require_once(__DIR__ . '/locallib.php');
require_once($CFG->libdir . '/tablelib.php');
$context = context_system::instance();

require_login(null, false);

require_capability('tool/coursewrangler:manage', $context);

$PAGE->set_context($context);
$PAGE->set_heading(get_string('pageheading', 'tool_coursewrangler'));
$PAGE->set_url(new moodle_url('/admin/tool/coursewrangler/index.php'));
$PAGE->set_title(get_string('pageheader', 'tool_coursewrangler'));
$PAGE->set_pagelayout('admin');

echo $OUTPUT->header();
echo $OUTPUT->heading(get_string('plugindesc', 'tool_coursewrangler'));

echo $OUTPUT->single_button(
    new moodle_url('/admin/tool/coursewrangler/table.php'),
    get_string('table_tablename', 'tool_coursewrangler'),
    'post',
    ['primary' => 1]
);
echo $OUTPUT->single_button(
    new moodle_url('/admin/tool/coursewrangler/user_table.php'),
    get_string('table_usertable_name', 'tool_coursewrangler')
);
echo $OUTPUT->single_button(
    new moodle_url('/admin/tasklogs.php?filter=tool_coursewrangler'),
    get_string('button_cw_scheduled_tasks_logs', 'tool_coursewrangler')
);

$baseurlstr = '/admin/tool/coursewrangler/index.php';
$baseurl = new moodle_url($baseurlstr, []);

$table = new table\logs_table(
    $baseurl,
    []
);

$table->out(50, false);

echo $OUTPUT->footer();
