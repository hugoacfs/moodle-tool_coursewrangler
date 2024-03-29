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
 * This file is a class example.
 *
 * @package   tool_coursewrangler
 * @author    Hugo Soares <h.soares@chi.ac.uk>
 * @copyright 2020 University of Chichester {@link www.chi.ac.uk}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */


namespace tool_coursewrangler\form;

use moodleform;

defined('MOODLE_INTERNAL') || die();

require_once("$CFG->libdir/formslib.php");

class action_form extends moodleform {
    // Add elements to form.
    public function definition() {
        $mform = $this->_form;
        $customdata = $this->_customdata;
        $reportformdatajson = null;
        $reportformdatajson = $customdata['reportformdatajson'] ?? null;

        $mform->addElement('hidden', 'reportformdatajson', $reportformdatajson);
        $rowsselected = ['class' => 'action_form-selected'];
        $mform->addElement('hidden', 'rowsselected', null, $rowsselected);

        $options = array();
        $options['delete'] = get_string(
            'action_form_scheduledelete',
            'tool_coursewrangler'
        );
        $options['protect'] = get_string(
            'action_form_protectcourse',
            'tool_coursewrangler'
        );
        $options['reset'] = get_string(
            'action_form_resetaction',
            'tool_coursewrangler'
        );
        $objs = array();
        $objs[] =& $mform->createElement(
            'select',
            'action',
            get_string('action_form_chooseaction', 'tool_coursewrangler'),
            $options);
        $objs[] =& $mform->createElement('submit', 'submit', get_string('go'));
        $batchdescription = get_string(
            'action_form_withselected',
            'tool_coursewrangler'
        );
        $mform->addElement(
            'group',
            'actionsgrp',
            $batchdescription,
            $objs,
            ' ',
            false
        );
    }
}
