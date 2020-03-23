<?php
//

/**
 * Exportable machine learning backend interface.
 *
 * @package   core_analytics
 * @copyright 2019 David Monllao {@link http://www.davidmonllao.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core_analytics;

defined('MOODLE_INTERNAL') || die();

/**
 * Exportable machine learning backend interface.
 *
 * @package   core_analytics
 * @copyright 2019 David Monllao {@link http://www.davidmonllao.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
interface packable {

    /**
     * Exports the machine learning model.
     *
     * @throws \moodle_exception
     * @param  string $uniqueid  The model unique id
     * @param  string $modeldir  The directory that contains the trained model.
     * @return string            The path to the directory that contains the exported model.
     */
    public function export(string $uniqueid, string $modeldir) : string;

    /**
     * Imports the provided machine learning model.
     *
     * @param  string $uniqueid The model unique id
     * @param  string $modeldir  The directory that will contain the trained model.
     * @param  string $importdir The directory that contains the files to import.
     * @return bool Success
     */
    public function import(string $uniqueid, string $modeldir, string $importdir) : bool;
}
