<?php
//

namespace search_solr;

/**
 * Search engine for testing purposes.
 *
 * @package   search_solr
 * @category  phpunit
 * @copyright 2016 Eric Merrill {@link http://www.merrilldigital.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

class testable_engine extends \search_solr\engine {
    /**
     * Function that lets us update the internally cached config object of the engine.
     */
    public function test_set_config($name, $value) {
        $this->config->$name = $value;
    }

    /**
     * Gets the search client (this function is usually protected) for testing.
     *
     * @return \SolrClient Solr client object
     * @throws \core_search\engine_exception
     */
    public function get_search_client_public(): \SolrClient {
        return parent::get_search_client();
    }
}
