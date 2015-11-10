<?php
/*
 * This class extents PHP Markdown Extra by Syntax Highlightning
 *
 * Please note:
 * This extension is tested against PHP Markdown Extra v. 1.5.0 only.
 *
 * Syntax Highlightning Class for PHP
 * Copyright (c) 2015 Stefan Liehmann
 * <http://limi.eu/projects/php/php_syntax_highlightning.html>
 *
 * PHP Markdown Extra
 * Copyright (c) 2004-2015 Michel Fortin
 * <https://michelf.ca/projects/php-markdown/>
 *
 * Original Markdown
 * Copyright (c) 2004-2006 John Gruber
 * <http://daringfireball.net/projects/markdown/>
 */
namespace Michelf;

require_once("SyntaxHighlight.php");

class MarkdownExtraExtended extends \Michelf\MarkdownExtra
{
	// modified version of MarkdownExtra::_doFencedCodeBlocks_callback($matches)
	protected function _doFencedCodeBlocks_callback($matches) {
		$classname =& $matches[2];
		$attrs     =& $matches[3];
		$codeblock = $matches[4];
		$codeblock = htmlspecialchars(trim($codeblock), ENT_NOQUOTES);
		$codeblock = preg_replace_callback('/^\n+/',
			array($this, '_doFencedCodeBlocks_newlines'), $codeblock);

		if ($classname != "") {
			if ($classname{0} == '.') {
				$classname = substr($classname, 1);
			}
			$attr_str = ' class="'.$this->code_class_prefix.$classname.'"';
			// do the syntax highlightning if a single classname was given
			// that was not "nohighlight"
			if ($classname !== "nohighlight") {
				$codeblock = SyntaxHighlight::process($codeblock, strtoupper($classname));
			}
		} else {
			$attr_str = $this->doExtraAttributes($this->code_attr_on_pre ? "pre" : "code", $attrs);
			// do the syntax highlightning if multiple classnames were given
			if (strpos($attr_str, "class") !== FALSE) {
				preg_match("/\"(.+?)\"/", $attr_str, $match);
				$classnames = explode(" ", $match[1]);
				foreach ($classnames as $classname) {
					$codeblock = SyntaxHighlight::process($codeblock, strtoupper($classname));
				}
			} else {
				// do the syntax highlightning if no classname was given
				$codeblock = SyntaxHighlight::process($codeblock);
			}
		}
		$pre_attr_str  = $this->code_attr_on_pre ? $attr_str : '';
		$code_attr_str = $this->code_attr_on_pre ? '' : $attr_str;
		$codeblock  = "<pre$pre_attr_str><code$code_attr_str>$codeblock</code></pre>";

		return "\n\n".$this->hashBlock($codeblock)."\n\n";
	}
}
