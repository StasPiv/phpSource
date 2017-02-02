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
     * @var The code inside {}
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
     *
     * @param string $access
     * @param string $identifier
     * @param array $params
     * @param string $source
     * @param PhpDocComment $comment
     * @param null $returnType
     */
    public function __construct($access, $identifier, $params, $source, PhpDocComment $comment = null, $returnType = null)
    {
        $this->access = $access;
        $this->identifier = $identifier;
        $this->params = $params;
        $this->source = $source;
        $this->comment = $comment;
        $this->returnType = $returnType;
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

        $sourceRow = $this->access . ' function ' . $this->identifier . '(' . implode(', ', $this->params) . ')';

        $sourceRow .= ($this->returnType ? (': '.$this->returnType) : '');

        $ret .= $this->getSourceRow($sourceRow);
        $ret .= $this->getSourceRow('{');
        $ret .= $this->getSourceRow($this->source);
        $ret .= $this->getSourceRow('}');

        return $ret;
    }
}
