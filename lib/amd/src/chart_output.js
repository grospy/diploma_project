//

/**
 * Chart output.
 *
 * Proxy to the default output module.
 *
 * @package    core
 * @copyright  2016 Frédéric Massart - FMCorz.net
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
define(['core/chart_output_chartjs'], function(Output) {

    /**
     * @exports module:core/chart_output
     * @extends {module:core/chart_output_chartjs}
     */
    var defaultModule = Output;

    return defaultModule;

});
