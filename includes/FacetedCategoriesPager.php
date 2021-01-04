<?php

namespace MediaWiki\Extension\FacetedCategory;

use AlphabeticPager;
use CategoryTree;
use Html;
use IContextSource;
use LinkBatch;
use MediaWiki\Linker\LinkRenderer;
use stdClass;
use Title;
use Xml;

class FacetedCategoriesPager extends AlphabeticPager {

	protected $linkRenderer;

	private $facetName;
	private $facetMember;
	private $includeNotExactlyMatched;
	private $including;

	/** @var CategoryTree */
	private $tree;

	/**
	 * @param IContextSource $context
	 * @param string $facetName
	 * @param string $facetMember
	 * @param bool $includeNotExactlyMatched
	 * @param LinkRenderer $linkRenderer
	 * @param bool $including
	 */
	public function __construct( IContextSource $context, $facetName, $facetMember, $includeNotExactlyMatched, LinkRenderer $linkRenderer, $including
	) {
		parent::__construct( $context );
		$facetName = str_replace( ' ', '_', $facetName );
		$facetMember = str_replace( ' ', '_', $facetMember );

		if ( $facetName !== '' ) {
			$this->facetName = $facetName;
		}
		if ( $facetMember !== '' ) {
			$this->facetMember = $facetMember;
		}
		if ( $includeNotExactlyMatched !== '' ) {
			$this->includeNotExactlyMatched = $includeNotExactlyMatched;
		}
		if ( $including !== '' ) {
			$this->including = $including;
		}

		if ( $this->including ) {
			$this->setLimit( 200 );
			$this->includeNotExactlyMatched = false;
		}

		$this->linkRenderer = $linkRenderer;
	}

	/**
	 * @return array
	 */
	public function getQueryInfo() {
		$query = [
			'tables' => [ 'category' ],
			'fields' => [ 'cat_title' ],
			'conds' => [ 'cat_pages > 0' ],
			'options' => [ 'USE INDEX' => 'cat_title' ],
		];

		if ( $this->includeNotExactlyMatched ) {
			$query['conds'][] = 'cat_title' . $this->mDb->buildLike( $this->mDb->anyString(), $this->facetName, $this->mDb->anyString(), '/', $this->mDb->anyString(), $this->facetMember, $this->mDb->anyString() );
		} else {
			if ( $this->facetName != '' && $this->facetMember != '' ) {
				$query['conds'][] = 'cat_title' . $this->mDb->buildLike( $this->facetName . '/' . $this->facetMember );
			} elseif ( $this->facetName != '' && $this->facetMember == '' ) {
				$query['conds'][] = 'cat_title' . $this->mDb->buildLike( $this->facetName . '/', $this->mDb->anyString() );
			} elseif ( $this->facetName == '' && $this->facetMember != '' ) {
				$query['conds'][] = 'cat_title' . $this->mDb->buildLike( $this->mDb->anyString(), '/' . $this->facetMember );
			} else {
				$query['conds'][] = 'cat_title' . $this->mDb->buildLike( $this->mDb->anyString(), '/', $this->mDb->anyString() );
			}
		}

		return $query;
	}

	/**
	 * @return string
	 */
	public function getIndexField() {
		return 'cat_title';
	}

	/**
	 * @return array
	 */
	public function getDefaultQuery() {
		parent::getDefaultQuery();

		return $this->mDefaultQuery;
	}

	/**
	 * Override getBody to apply LinksBatch on resultset before actually outputting anything.
	 * @return string
	 */
	public function getBody() {
		$batch = new LinkBatch;

		$this->mResult->rewind();

		foreach ( $this->mResult as $row ) {
			$batch->addObj( Title::makeTitleSafe( NS_CATEGORY, $row->cat_title ) );
		}
		$batch->execute();
		CategoryTree::setHeaders( $this->getOutput() );
		$this->mResult->rewind();

		return parent::getBody();
	}

	/**
	 * @param array|stdClass $result
	 * @return string
	 */
	public function formatRow( $result ) {
		/*
		$title = new TitleValue( NS_CATEGORY, $result->cat_title );
		$text = $title->getText();
		$link = $this->linkRenderer->renderHtmlLink( $title, $text );

		$count = $this->msg( 'nmembers' )->numParams( $result->cat_pages )->escaped();
		*/

		global $wgCategoryTreeDefaultOptions, $wgCategoryTreeSpecialPageOptions;

		$title = Title::makeTitle( NS_CATEGORY, $result->cat_title );

		$options = [];
		# grab all known options from the request. Normalization is done by the CategoryTree class
		foreach ( $wgCategoryTreeDefaultOptions as $option => $default ) {
			if ( isset( $wgCategoryTreeSpecialPageOptions[$option] ) ) {
				$default = $wgCategoryTreeSpecialPageOptions[$option];
			}
			$options[$option] = $default;
		}
		$options['mode'] = 'categories';
		$this->tree = new CategoryTree( $options );

		return $this->tree->renderNode( $title );
	}

	/**
	 * @param string $facetName
	 * @param string $facetMember
	 * @param bool $includeNotExactlyMatched
	 * @return string
	 */
	public function getStartForm( $facetName, $facetMember, $includeNotExactlyMatched ) {
		return $this->including ? '' : Xml::tags(
			'form',
			[ 'method' => 'get', 'action' => wfScript() ],
			Html::hidden( 'title', $this->getTitle()->getPrefixedText() ) .
			Xml::fieldset(
				$this->msg( 'categories' )->text(),
				$this->msg( 'facetedcategory-search-for' )->text() .
				' ' .
				Xml::input(
					'facetName', 10, $facetName, [ 'class' => 'mw-ui-input-inline' ] ) .
				' / ' .
				Xml::input(
					'facetMember', 10, $facetMember, [ 'class' => 'mw-ui-input-inline' ] ) .
				' ' .
				Html::submitButton(
					$this->msg( 'categories-submit' )->text(),
					[], [ 'mw-ui-progressive' ]
				) .
				' ' .
				Xml::checkLabel(
					$this->msg( 'facetedcategory-not-only-match-exactly' )->text(), 'includeNotExactlyMatched', 'includeNotExactlyMatched', $includeNotExactlyMatched, [] )
			)
		);
	}
}
