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

require_once($CFG->dirroot . '/theme/clean/classes/core_renderer.php');

/**
 * AC Paris core renderers.
 *
 * @package    theme_acparis
 * @copyright  2016 Thomas Jaisson
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class theme_acparis_core_renderer extends theme_clean_core_renderer {

    /**
     * Determines if we should render the logo.
     *
     * @param int $headinglevel What level the 'h' tag will be.
     * @return bool Should the logo be rendered.
     */
    protected function should_render_logo($headinglevel = 1) {
        global $PAGE;

        // Only render the logo if we're on the front page or login page
        // and the theme has a logo.
        if ($headinglevel == 1) {
            if ($PAGE->pagelayout == 'frontpage' || $PAGE->pagelayout == 'login') {
                return true;
            }
        }

        return false;
    }

    /**
     * Returns the navigation bar home reference.
     *
     * The small logo is only rendered on pages where the logo is not displayed.
     *
     * @param bool $returnlink Whether to wrap the icon and the site name in links or not
     * @return string The site name, the small logo or both depending on the theme settings.
     */
    public function navbar_home($returnlink = true) {
        global $CFG;

        if ($this->should_render_logo()) {
            // If there is no small logo we always show the site name.
            return $this->get_home_ref($returnlink);
        }
        $imageurl = $this->page->theme->pix_url('ac-paris-sm', 'theme');
        $image = html_writer::img($imageurl, get_string('sitelogo', 'theme_' . $this->page->theme->name),
            array('class' => 'small-logo'));

        if ($returnlink) {
            $logocontainer = html_writer::link($CFG->wwwroot, $image,
                array('class' => 'small-logo-container', 'title' => get_string('home')));
        } else {
            $logocontainer = html_writer::tag('span', $image, array('class' => 'small-logo-container'));
        }

        return $logocontainer . $this->get_home_ref($returnlink);
    }

}
