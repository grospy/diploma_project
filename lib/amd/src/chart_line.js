//

/**
 * Chart line.
 *
 * @package    core
 * @copyright  2016 Frédéric Massart - FMCorz.net
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @module     core/chart_line
 */
define(['core/chart_base'], function(Base) {

    /**
     * Line chart.
     *
     * @alias module:core/chart_line
     * @extends {module:core/chart_base}
     * @class
     */
    function Line() {
        Base.prototype.constructor.apply(this, arguments);
    }
    Line.prototype = Object.create(Base.prototype);

    /** @override */
    Line.prototype.TYPE = 'line';

    /**
     * Whether the line should be smooth or not.
     *
     * By default the chart lines are not smooth.
     *
     * @type {Bool}
     * @protected
     */
    Line.prototype._smooth = false;

    /** @override */
    Line.prototype.create = function(Klass, data) {
        var chart = Base.prototype.create.apply(this, arguments);
        chart.setSmooth(data.smooth);
        return chart;
    };

    /**
     * Get whether the line should be smooth or not.
     *
     * @method getSmooth
     * @returns {Bool}
     */
    Line.prototype.getSmooth = function() {
        return this._smooth;
    };

    /**
     * Set whether the line should be smooth or not.
     *
     * @method setSmooth
     * @param {Bool} smooth True if the line chart should be smooth, false otherwise.
     */
    Line.prototype.setSmooth = function(smooth) {
        this._smooth = Boolean(smooth);
    };

    return Line;

});
