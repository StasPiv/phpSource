<?php
/**
 * Created by rest-bundle.
 * User: ssp
 * Date: 07.02.17
 * Time: 17:53
 */

namespace StasPiv\PhpSource;


class PhpConstant extends PhpElement
{
    /**
     * @var
     */
    private $name;
    /**
     * @var
     */
    private $value;
    /**
     * @var PhpDocComment
     */
    private $comment;

    /**
     * PhpConstant constructor.
     * @param $name
     * @param $value
     * @param PhpDocComment $comment
     */
    public function __construct($name, $value, PhpDocComment $comment = null)
    {
        $this->name = $name;
        $this->value = $value;
        $this->comment = $comment;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return PhpDocComment
     */
    public function getComment(): PhpDocComment
    {
        return $this->comment;
    }

    public function getSource()
    {
        $ret = '';

        if ($this->comment !== null) {
            $ret .= PHP_EOL . $this->getSourceRow($this->comment->getSource());
        }

        $ret .= $this->getSourceRow('const ' . $this->name . ' = ' . $this->value . ';');

        return $ret;
    }

}