<?php

//

/**
 * Numerical
 *
 * @package mod_lesson
 * @copyright  2009 Sam Hemelryk
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 **/

defined('MOODLE_INTERNAL') || die();

/** Numerical question type */
define("LESSON_PAGE_NUMERICAL",     "8");

class lesson_page_type_numerical extends lesson_page {

    protected $type = lesson_page::TYPE_QUESTION;
    protected $typeidstring = 'numerical';
    protected $typeid = LESSON_PAGE_NUMERICAL;
    protected $string = null;

    public function get_typeid() {
        return $this->typeid;
    }
    public function get_typestring() {
        if ($this->string===null) {
            $this->string = get_string($this->typeidstring, 'lesson');
        }
        return $this->string;
    }
    public function get_idstring() {
        return $this->typeidstring;
    }
    public function display($renderer, $attempt) {
        global $USER, $CFG, $PAGE;
        $mform = new lesson_display_answer_form_shortanswer($CFG->wwwroot.'/mod/lesson/continue.php', array('contents'=>$this->get_contents(), 'lessonid'=>$this->lesson->id));
        $data = new stdClass;
        $data->id = $PAGE->cm->id;
        $data->pageid = $this->properties->id;
        if (isset($USER->modattempts[$this->lesson->id])) {
            $data->answer = s($attempt->useranswer);
        }
        $mform->set_data($data);

        // Trigger an event question viewed.
        $eventparams = array(
            'context' => context_module::instance($PAGE->cm->id),
            'objectid' => $this->properties->id,
            'other' => array(
                    'pagetype' => $this->get_typestring()
                )
            );

        $event = \mod_lesson\event\question_viewed::create($eventparams);
        $event->trigger();
        return $mform->display();
    }

    /**
     * Creates answers for this page type.
     *
     * @param  object $properties The answer properties.
     */
    public function create_answers($properties) {
        if (isset($properties->enableotheranswers) && $properties->enableotheranswers) {
            $properties->response_editor = array_values($properties->response_editor);
            $properties->jumpto = array_values($properties->jumpto);
            $properties->score = array_values($properties->score);
            $wrongresponse = end($properties->response_editor);
            $wrongkey = key($properties->response_editor);
            $properties->answer_editor[$wrongkey] = LESSON_OTHER_ANSWERS;
        }
        parent::create_answers($properties);
    }

    /**
     * Update the answers for this page type.
     *
     * @param  object $properties The answer properties.
     * @param  context $context The context for this module.
     * @param  int $maxbytes The maximum bytes for any uploades.
     */
    public function update($properties, $context = null, $maxbytes = null) {
        if ($properties->enableotheranswers) {
            $properties->response_editor = array_values($properties->response_editor);
            $properties->jumpto = array_values($properties->jumpto);
            $properties->score = array_values($properties->score);
            $wrongresponse = end($properties->response_editor);
            $wrongkey = key($properties->response_editor);
            $properties->answer_editor[$wrongkey] = LESSON_OTHER_ANSWERS;
        }
        parent::update($properties, $context, $maxbytes);
    }

    public function check_answer() {
        global $CFG;
        $result = parent::check_answer();

        $mform = new lesson_display_answer_form_shortanswer($CFG->wwwroot.'/mod/lesson/continue.php', array('contents'=>$this->get_contents()));
        $data = $mform->get_data();
        require_sesskey();

        $formattextdefoptions = new stdClass();
        $formattextdefoptions->noclean = true;
        $formattextdefoptions->para = false;

        // set defaults
        $result->response = '';
        $result->newpageid = 0;

        if (!isset($data->answer) || !is_numeric($data->answer)) {
            $result->noanswer = true;
            return $result;
        } else {
            // Just doing default PARAM_RAW, not doing PARAM_INT because it could be a float.
            $result->useranswer = (float)$data->answer;
        }
        $result->studentanswer = $result->userresponse = $result->useranswer;
        $answers = $this->get_answers();
        foreach ($answers as $answer) {
            $answer = parent::rewrite_answers_urls($answer);
            if (strpos($answer->answer, ':')) {
                // there's a pairs of values
                list($min, $max) = explode(':', $answer->answer);
                $minimum = (float) $min;
                $maximum = (float) $max;
            } else {
                // there's only one value
                $minimum = (float) $answer->answer;
                $maximum = $minimum;
            }
            if (($result->useranswer >= $minimum) && ($result->useranswer <= $maximum)) {
                $result->newpageid = $answer->jumpto;
                $result->response = format_text($answer->response, $answer->responseformat, $formattextdefoptions);
                if ($this->lesson->jumpto_is_correct($this->properties->id, $result->newpageid)) {
                    $result->correctanswer = true;
                }
                if ($this->lesson->custom) {
                    if ($answer->score > 0) {
                        $result->correctanswer = true;
                    } else {
                        $result->correctanswer = false;
                    }
                }
                $result->answerid = $answer->id;
                return $result;
            }
        }
        // We could check here to see if we have a wrong answer jump to use.
        if ($result->answerid == 0) {
            // Use the all other answers jump details if it is set up.
            $lastanswer = end($answers);
            // Double check that this is the @#wronganswer#@ answer.
            if (strpos($lastanswer->answer, LESSON_OTHER_ANSWERS) !== false) {
                $otheranswers = end($answers);
                $result->newpageid = $otheranswers->jumpto;
                $result->response = format_text($otheranswers->response, $otheranswers->responseformat, $formattextdefoptions);
                // Does this also need to do the jumpto_is_correct?
                if ($this->lesson->custom) {
                    $result->correctanswer = ($otheranswers->score > 0);
                }
                $result->answerid = $otheranswers->id;
            }
        }
        return $result;
    }

    public function display_answers(html_table $table) {
        $answers = $this->get_answers();
        $options = new stdClass;
        $options->noclean = true;
        $options->para = false;
        $i = 1;
        foreach ($answers as $answer) {
            $answer = parent::rewrite_answers_urls($answer, false);
            $cells = array();
            if ($this->lesson->custom && $answer->score > 0) {
                // if the score is > 0, then it is correct
                $cells[] = '<label class="correct">' . get_string('answer', 'lesson') . ' ' . $i . '</label>:';
            } else if ($this->lesson->custom) {
                $cells[] = '<label>' . get_string('answer', 'lesson') . ' ' . $i . '</label>:';
            } else if ($this->lesson->jumpto_is_correct($this->properties->id, $answer->jumpto)) {
                // underline correct answers
                $cells[] = '<span class="correct">' . get_string('answer', 'lesson') . ' ' . $i . '</span>:' . "\n";
            } else {
                $cells[] = '<label class="correct">' . get_string('answer', 'lesson') . ' ' . $i . '</label>:';
            }
            $cells[] = format_text($answer->answer, $answer->answerformat, $options);
            $table->data[] = new html_table_row($cells);

            $cells = array();
            $cells[] = '<label>' . get_string('response', 'lesson') . ' ' . $i . '</label>:';
            $cells[] = format_text($answer->response, $answer->responseformat, $options);
            $table->data[] = new html_table_row($cells);

            $cells = array();
            $cells[] = '<label>' . get_string('score', 'lesson') . '</label>:';
            $cells[] = $answer->score;
            $table->data[] = new html_table_row($cells);

            $cells = array();
            $cells[] = '<label>' . get_string('jump', 'lesson') . '</label>:';
            $cells[] = $this->get_jump_name($answer->jumpto);
            $table->data[] = new html_table_row($cells);
            if ($i === 1){
                $table->data[count($table->data)-1]->cells[0]->style = 'width:20%;';
            }
            $i++;
        }
        return $table;
    }
    public function stats(array &$pagestats, $tries) {
        if(count($tries) > $this->lesson->maxattempts) { // if there are more tries than the max that is allowed, grab the last "legal" attempt
            $temp = $tries[$this->lesson->maxattempts - 1];
        } else {
            // else, user attempted the question less than the max, so grab the last one
            $temp = end($tries);
        }
        if (isset($pagestats[$temp->pageid][$temp->useranswer])) {
            $pagestats[$temp->pageid][$temp->useranswer]++;
        } else {
            $pagestats[$temp->pageid][$temp->useranswer] = 1;
        }
        if (isset($pagestats[$temp->pageid]["total"])) {
            $pagestats[$temp->pageid]["total"]++;
        } else {
            $pagestats[$temp->pageid]["total"] = 1;
        }
        return true;
    }

    public function report_answers($answerpage, $answerdata, $useranswer, $pagestats, &$i, &$n) {
        $answers = $this->get_answers();
        $formattextdefoptions = new stdClass;
        $formattextdefoptions->para = false;  //I'll use it widely in this page
        foreach ($answers as $answer) {
            if ($useranswer == null && $i == 0) {
                // I have the $i == 0 because it is easier to blast through it all at once.
                if (isset($pagestats[$this->properties->id])) {
                    $stats = $pagestats[$this->properties->id];
                    $total = $stats["total"];
                    unset($stats["total"]);
                    foreach ($stats as $valentered => $ntimes) {
                        $data = '<input class="form-control" type="text" size="50" ' .
                                'disabled="disabled" readonly="readonly" value="'.s($valentered).'" />';
                        $percent = $ntimes / $total * 100;
                        $percent = round($percent, 2);
                        $percent .= "% ".get_string("enteredthis", "lesson");
                        $answerdata->answers[] = array($data, $percent);
                    }
                } else {
                    $answerdata->answers[] = array(get_string("nooneansweredthisquestion", "lesson"), " ");
                }
                $i++;
            } else if ($useranswer != null && ($answer->id == $useranswer->answerid || ($answer == end($answers) &&
                    empty($answerdata->answers)))) {
                // Get in here when the user answered or for the last answer.
                $data = '<input class="form-control" type="text" size="50" ' .
                        'disabled="disabled" readonly="readonly" value="'.s($useranswer->useranswer).'">';
                if (isset($pagestats[$this->properties->id][$useranswer->useranswer])) {
                    $percent = $pagestats[$this->properties->id][$useranswer->useranswer] / $pagestats[$this->properties->id]["total"] * 100;
                    $percent = round($percent, 2);
                    $percent .= "% ".get_string("enteredthis", "lesson");
                } else {
                    $percent = get_string("nooneenteredthis", "lesson");
                }
                $answerdata->answers[] = array($data, $percent);

                if ($answer->id == $useranswer->answerid) {
                    if ($answer->response == null) {
                        if ($useranswer->correct) {
                            $answerdata->response = get_string("thatsthecorrectanswer", "lesson");
                        } else {
                            $answerdata->response = get_string("thatsthewronganswer", "lesson");
                        }
                    } else {
                        $answerdata->response = $answer->response;
                    }
                    if ($this->lesson->custom) {
                        $answerdata->score = get_string("pointsearned", "lesson").": ".$answer->score;
                    } elseif ($useranswer->correct) {
                        $answerdata->score = get_string("receivedcredit", "lesson");
                    } else {
                        $answerdata->score = get_string("didnotreceivecredit", "lesson");
                    }
                } else {
                    $answerdata->response = get_string("thatsthewronganswer", "lesson");
                    if ($this->lesson->custom) {
                        $answerdata->score = get_string("pointsearned", "lesson").": 0";
                    } else {
                        $answerdata->score = get_string("didnotreceivecredit", "lesson");
                    }
                }
            }
            $answerpage->answerdata = $answerdata;
        }
        return $answerpage;
    }

    /**
     * Make updates to the form data if required. In this case to put the all other answer data into the write section of the form.
     *
     * @param stdClass $data The form data to update.
     * @return stdClass The updated fom data.
     */
    public function update_form_data(stdClass $data) : stdClass {
        $answercount = count($this->get_answers());
        // Check for other answer entry.
        $lastanswer = $data->{'answer_editor[' . ($answercount - 1) . ']'};
        if (strpos($lastanswer, LESSON_OTHER_ANSWERS) !== false) {
            $data->{'answer_editor[' . ($this->lesson->maxanswers + 1) . ']'} =
                    $data->{'answer_editor[' . ($answercount - 1) . ']'};
            $data->{'response_editor[' . ($this->lesson->maxanswers + 1) . ']'} =
                    $data->{'response_editor[' . ($answercount - 1) . ']'};
            $data->{'jumpto[' . ($this->lesson->maxanswers + 1) . ']'} = $data->{'jumpto[' . ($answercount - 1) . ']'};
            $data->{'score[' . ($this->lesson->maxanswers + 1) . ']'} = $data->{'score[' . ($answercount - 1) . ']'};
            $data->enableotheranswers = true;

            // Unset the old values.
            unset($data->{'answer_editor[' . ($answercount - 1) . ']'});
            unset($data->{'response_editor[' . ($answercount - 1) . ']'});
            unset($data->{'jumpto['. ($answercount - 1) . ']'});
            unset($data->{'score[' . ($answercount - 1) . ']'});
        }

        return $data;
    }
}

class lesson_add_page_form_numerical extends lesson_add_page_form_base {

    public $qtype = 'numerical';
    public $qtypestring = 'numerical';
    protected $answerformat = '';
    protected $responseformat = LESSON_ANSWER_HTML;

    public function custom_definition() {
        $answercount = $this->_customdata['lesson']->maxanswers;
        for ($i = 0; $i < $answercount; $i++) {
            $this->_form->addElement('header', 'answertitle'.$i, get_string('answer').' '.($i+1));
            $this->add_answer($i, null, ($i < 1));
            $this->add_response($i);
            $this->add_jumpto($i, null, ($i == 0 ? LESSON_NEXTPAGE : LESSON_THISPAGE));
            $this->add_score($i, null, ($i===0)?1:0);
        }
        // Wrong answer jump.
        $this->_form->addElement('header', 'wronganswer', get_string('allotheranswers', 'lesson'));
        $newcount = $answercount + 1;
        $this->_form->addElement('advcheckbox', 'enableotheranswers', get_string('enabled', 'lesson'));
        $this->add_response($newcount);
        $this->add_jumpto($newcount, get_string('allotheranswersjump', 'lesson'), LESSON_NEXTPAGE);
        $this->add_score($newcount, get_string('allotheranswersscore', 'lesson'), 0);
    }
}

class lesson_display_answer_form_numerical extends moodleform {

    public function definition() {
        global $USER, $OUTPUT;
        $mform = $this->_form;
        $contents = $this->_customdata['contents'];

        // Disable shortforms.
        $mform->setDisableShortforms();

        $mform->addElement('header', 'pageheader');

        $mform->addElement('html', $OUTPUT->container($contents, 'contents'));

        $hasattempt = false;
        $attrs = array('size'=>'50', 'maxlength'=>'200');
        if (isset($this->_customdata['lessonid'])) {
            $lessonid = $this->_customdata['lessonid'];
            if (isset($USER->modattempts[$lessonid]->useranswer)) {
                $attrs['readonly'] = 'readonly';
                $hasattempt = true;
            }
        }
        $options = new stdClass;
        $options->para = false;
        $options->noclean = true;

        $mform->addElement('hidden', 'id');
        $mform->setType('id', PARAM_INT);

        $mform->addElement('hidden', 'pageid');
        $mform->setType('pageid', PARAM_INT);

        $mform->addElement('text', 'answer', get_string('youranswer', 'lesson'), $attrs);
        $mform->setType('answer', PARAM_FLOAT);

        if ($hasattempt) {
            $this->add_action_buttons(null, get_string("nextpage", "lesson"));
        } else {
            $this->add_action_buttons(null, get_string("submit", "lesson"));
        }
    }

}
