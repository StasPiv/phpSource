<?php
/**
 * @package phpSource
 */
namespace StasPiv\PhpSource;

/**
 * Class that represents the source code for a function in php
 *
 * @package phpSource
 * @author Fredrik Wallgren <fredrik.wallgren@gmail.com>
 * @license http://www.opensource.org/licenses/mit-license.php MIT License
 */
class PhpFunction extends PhpElement
{
    /**
     *
     * @var array|PhpParam[] String containing the params to the function
     * @access private
     */
    private $params;

    /**
     *
     * @var string code inside {}
     * @access private
     */
    private $source;

    /**
     *
     * @var PhpDocComment A comment in phpdoc format that describes the function
     * @access private
     */
    private $comment;
    /**
     * @var null
     */
    private $returnType;
    /**
     * @var bool
     */
    private $static;

    /**
     *
     * @param string $access
     * @param string $identifier
     * @param bool $static
     * @param array $params
     * @param string $source
     * @param PhpDocComment $comment
     * @param null $returnType
     */
    public function __construct(
        $access,
        $identifier,
        $static = false,
        $params = [],
        $source = null,
        PhpDocComment $comment = null,
        $returnType = null
    )
    {
        $this->access = $access;
        $this->identifier = $identifier;
        $this->params = $params;
        $this->source = $source;
        $this->comment = $comment;
        $this->returnType = $returnType;
        $this->static = $static;
    }

    /**
     *
     * @return string Returns the complete source code for the function
     * @access public
     */
    public function getSource()
    {
        $ret = '' . PHP_EOL;

        if ($this->comment !== null) {
            $ret .= $this->getSourceRow($this->comment->getSource());
        }

        $sourceRow = $this->access . ($this->static?' static':'') . ' function ' . $this->identifier . '(' . implode(', ', $this->params) . ')';

        $sourceRow .= ($this->returnType ? (': '.$this->returnType) : '');

        if ($this->source !== null) {
            $ret .= $this->getSourceRow($sourceRow);
            $ret .= $this->getSourceRow('{');
            $ret .= $this->getSourceRow($this->source);
            $ret .= $this->getSourceRow('}');
        } else {
            $ret .= $this->indentionStr . $sourceRow . ';' . PHP_EOL;
        }

        return $ret;
    }

    /**
     * @param string $source
     * @return PhpFunction
     */
    public function setSource(string $source)
    {
        $this->source = $source;
        return $this;
    }
}
