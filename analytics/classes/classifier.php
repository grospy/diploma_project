<?php
//

/**
 * Classifier interface.
 *
 * @package   core_analytics
 * @copyright 2017 David Monllao {@link http://www.davidmonllao.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core_analytics;

defined('MOODLE_INTERNAL') || die();

/**
 * Classifier interface.
 *
 * @package   core_analytics
 * @copyright 2016 David Monllao {@link http://www.davidmonllao.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
interface classifier extends predictor {

    /**
     * Train this processor classification model using the provided supervised learning dataset.
     *
     * @param string $uniqueid
     * @param \stored_file $dataset
     * @param string $outputdir
     * @return \stdClass
     */
    public function train_classification($uniqueid, \stored_file $dataset, $outputdir);

    /**
     * Classifies the provided dataset samples.
     *
     * @param string $uniqueid
     * @param \stored_file $dataset
     * @param string $outputdir
     * @return \stdClass
     */
    public function classify($uniqueid, \stored_file $dataset, $outputdir);

    /**
     * Evaluates this processor classification model using the provided supervised learning dataset.
     *
     * @param string $uniqueid
     * @param float $maxdeviation
     * @param int $niterations
     * @param \stored_file $dataset
     * @param string $outputdir
     * @param  string $trainedmodeldir
     * @return \stdClass
     */
    public function evaluate_classification($uniqueid, $maxdeviation, $niterations, \stored_file $dataset,
            $outputdir, $trainedmodeldir);
}
