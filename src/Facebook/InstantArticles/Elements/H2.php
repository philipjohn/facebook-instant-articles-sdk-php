<?php
/**
 * Copyright (c) 2016-present, Facebook, Inc.
 * All rights reserved.
 *
 * This source code is licensed under the license found in the
 * LICENSE file in the root directory of this source tree.
 */
namespace Facebook\InstantArticles\Elements;

use Facebook\InstantArticles\Validators\Type;

/**
 * Title for the Document
 *
 * Example:
 * <h2> This is the first Instant Article</h2>
 *  or
 * <h2> This is the <b>first</b> Instant Article</h2>
 */
class H2 extends TextContainer
{
    /**
     * @var string text align. Values: "op-left"|"op-center"|"op-right"
     */
    private $textAlignment;

    /**
     * @var string text position. Values: "op-vertical-below"|"op-vertical-above"|"op-vertical-center"
     */
    private $position;

    private function __construct()
    {
    }

    public static function create()
    {
        return new self();
    }


    /**
     * The Text alignment that will be used.
     *
     * @see Caption::ALIGN_RIGHT
     * @see Caption::ALIGN_LEFT
     * @see Caption::ALIGN_CENTER
     *
     * @param string alignment option that will be used.
     */
    public function withTextAlignment($text_alignment)
    {
        Type::enforceWithin(
            $text_alignment,
            array(
                Caption::ALIGN_RIGHT,
                Caption::ALIGN_LEFT,
                Caption::ALIGN_CENTER
            )
        );
        $this->textAlignment = $text_alignment;

        return $this;
    }

    /**
    * The Text position that will be used.
    *
    * @see Caption::POSITION_ABOVE
    * @see Caption::POSITION_BELOW
    * @see Caption::POSITION_CENTER
    *
    * @param string position that will be used.
    */
    public function withPostion($position)
    {
        Type::enforceWithin(
            $position,
            array(
                Caption::POSITION_ABOVE,
                Caption::POSITION_BELOW,
                Caption::POSITION_CENTER
            )
        );
        $this->position = $position;

        return $this;
    }

    /**
     * Structure and create the H2 in a DOMElement.
     *
     * @param DOMDocument $document - The document where this element will be appended (optional).
     */
    public function toDOMElement($document = null)
    {
        if (!$document) {
            $document = new \DOMDocument();
        }
        $h2 = $document->createElement('h2');

        $classes = array();
        if ($this->position) {
            $classes[] = $this->position;
        }
        if ($this->textAlignment) {
            $classes[] = $this->textAlignment;
        }
        if (!empty($classes)) {
            $h2->setAttribute('class', implode(' ', $classes));
        }

        $h2->appendChild($this->textToDOMDocumentFragment($document));

        return $h2;
    }
}
