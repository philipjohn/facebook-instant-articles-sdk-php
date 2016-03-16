<?php
/**
 * Copyright (c) 2016-present, Facebook, Inc.
 * All rights reserved.
 *
 * This source code is licensed under the license found in the
 * LICENSE file in the root directory of this source tree.
 */
namespace Facebook\InstantArticles\Transformer\Rules;

use Facebook\InstantArticles\Elements\InstantArticle;
use Facebook\InstantArticles\Elements\ListElement;
use Facebook\InstantArticles\Transformer\Getters\GetterFactory;
use Facebook\InstantArticles\Transformer\Getters\StringGetter;
use Facebook\InstantArticles\Transformer\Getters\ChildrenGetter;

class ListElementRule extends ConfigurationSelectorRule
{
    public function __construct()
    {
    }

    public function getContextClass()
    {
        return InstantArticle::class;
    }

    public static function create()
    {
        return new ListElementRule();
    }

    public static function createFrom($configuration)
    {
        return self::create()->withSelector($configuration['selector']);
    }

    public function apply($transformer, $instant_article, $element)
    {
        $list =
            $element->nodeName === 'ol' ?
                ListElement::createOrdered() :
                ListElement::createUnordered();
        $instant_article->addChild($list);
        $transformer->transform($list, $element);
        return $instant_article;
    }

    public function loadFrom($configuration)
    {
        $this->selector = $configuration['selector'];
    }
}
