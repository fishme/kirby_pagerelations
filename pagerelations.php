<?php

/**
 * add page relation fields
 *     - search for content
 *     - drag drop content
 *     - save current full uri
 * @author David Hohl <david.hohl@gmail.com>
 *
 * @use for blueprints
 *
 * @example
 *      YOUR_FIELDNAME:
 *            label: YOUR LABEL
 *            type: pagerelations
 *
 */

class PagerelationsField extends InputField {

    /**
     * @var string search mode (field/template)
     */
    public $searchmode;

    /**
     * @var string search for content with this field
     */
    public $searchfield;

    /**
     * @var string Kirby query
     */
    public $searchcontent;

    /**
     * @var array pager relation values
     */
    public $pr_values = array();


    /**
     * @var array assets
     */
    static public $assets = array(
        'css' => array(
            'pagerelations.css'
        )
    );

    /**
     * init default fieldset
     */
    public function __construct() {
        $this->type             = 'text';
        $this->icon             = 'list-ol';
        $this->searchmode       = 'field';
        $this->searchfield      = 'ARIB';
        $this->searchcontent    = 'arib_content';
    }


    /**
     * return input field
     *
     * @return Brick
     */
    public function input() {
        $input = parent::input();
        $input->data('field','pagerelation');
        return $input;
    }

    /**
     * output template for the page relation
     * @return string   output
     *
     */
    public function content() {
        if($this->searchmode == 'template') {
            $content_pages = page(explode('/',$this->page()->uri())[0])->index()->filterBy('template', 'quizzes');
        } else {
            $content_pages = page(explode('/',$this->page()->uri())[0])->index()->search((string)$this->searchfield, (string)$this->searchcontent);
        }

        $content = new Brick('div');
        $content->addClass('field-content');
        $content->append($this->input());
        $content->append($this->icon());

        $this->pr_values = explode(';',$this->value());

        return $content . tpl::load(__DIR__ . DS . 'template.php', array('field' => $this,'content_pages' => $content_pages));

    }

    /**
     * @param $string Text
     * @param int $length cut after; default 100
     * @param string $append append extra text after the text default: ...
     * @return string
     */
    public function truncate($string, $length = 100, $append = "...") {
        if (strlen($string) <= intval($length)) {
            return $string;
        }

        return substr($string, 0, $length) . $append;
    }

}

