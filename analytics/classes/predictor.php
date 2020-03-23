<?php
//

/**
 * Predictions processor interface.
 *
 * @package   core_analytics
 * @copyright 2017 David Monllao {@link http://www.davidmonllao.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core_analytics;

defined('MOODLE_INTERNAL') || die();

/**
 * Predictors interface.
 *
 * @package   core_analytics
 * @copyright 2016 David Monllao {@link http://www.davidmonllao.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
interface predictor {

    /**
     * Is it ready to predict?
     *
     * @return bool
     */
    public function is_ready();

    /**
     * Delete all stored information of the current model id.
     *
     * This method is called when there are important changes to a model,
     * all previous training algorithms using that version of the model
     * should be deleted.
     *
     * In case you want to perform extra security measures before deleting
     * a directory you can check that $modelversionoutputdir subdirectories
     * can only be named 'execution', 'evaluation' or 'testing'.
     *
     * @param string $uniqueid The site model unique id string
     * @param string $modelversionoutputdir The output dir of this model version
     * @return null
     */
    public function clear_model($uniqueid, $modelversionoutputdir);

    /**
     * Delete the output directory.
     *
     * This method is called when a model is completely deleted.
     *
     * In case you want to perform extra security measures before deleting
     * a directory you can check that the subdirectories are timestamps
     * (the model version) and each of this subdirectories' subdirectories
     * can only be named 'execution', 'evaluation' or 'testing'.
     *
     * @param string $modeloutputdir The model directory id (parent of all model versions subdirectories).
     * @param string $uniqueid
     * @return null
     */
    public function delete_output_dir($modeloutputdir, $uniqueid);

}
