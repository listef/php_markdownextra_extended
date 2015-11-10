### PHP Markdown Extra Extended for use with Syntax Highlightning Class for PHP

This slightly extended PHP Markdown Extra version is for use with Michel Fortin's [PHP Markdown Extra](https://michelf.ca/projects/php-markdown/ "PHP Markdown Extra") class and my [Syntax Highlightning Class for PHP](http://limi.eu/projects/php/php_syntax_highlightning.html "Syntax Highlightning Class for PHP"). It is developed with PHP Markdown v. 1.5.0, so further versions might break this version.


**_Installation:_**
* download PHP Markdown from [here](https://michelf.ca/projects/php-markdown/ "PHP Markdown Extra Homepage") or [here](https://github.com/michelf/php-markdown "PHP Markdown Extra on GitHub").
* download Syntax Highlightning Class for PHP from [here](https://github.com/listef/php_syntaxhighlightning "Syntax Highlightning Class for PHP on GitHub").
* extract/copy all files in the same directory

**_Usage:_**
Include the CSS file provided by the Syntax Highlightning Class in your HTML header and do something like this:
```
require_once $install_dir."/MarkdownExtraExtended.inc.php";

$my_html = MarkdownExtraExtended::defaultTransform($my_text);
```
or if you can use class autoloading
```
use "\Michelf\MarkdownExtraExtended";

$my_html = MarkdownExtraExtended::defaultTransform($my_text);
```
You may specify the language to highlight by applying one or more classnames to a code block like this:

    ~~~css
    h1 { font-size: 25pt; }
    ~~~

or

    ~~~{.html .php}
    <body>
      <?php echo content; ?>
    </body>
    ~~~



