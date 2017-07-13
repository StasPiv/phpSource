<?php
/**
 * Created by rest-bundle.
 * User: ssp
 * Date: 07.02.17
 * Time: 18:15
 */

namespace StasPiv\PhpSource;


class PhpClassUse extends PhpElement
{
    /**
     * @var
     */
    private $traitName;
    /**
     * @var array
     */
    private $methods;


    /**
     * PhpClassUse constructor.
     * @param $traitName
     * @param array $methods
     */
    public function __construct($traitName, $methods = [])
    {
        $this->traitName = $traitName;
        $this->methods = $methods;
    }

    public function getSource()
    {
        $ret = $this->getSourceRow('use ' . $this->traitName . (!empty($this->methods) ? ' {' : ';'));

        if (!empty($this->methods)) {
            $methods = [];
            foreach ($this->methods as $alias => $method) {
                $methods[] = str_repeat($this->getIndentionStr(), 2) . $method . ' as ' . $alias . ';';
            }

            $ret.=implode(PHP_EOL, $methods) . PHP_EOL.$this->getSourceRow('}');
        }

        return $ret;
    }

    /**
     * @return mixed
     */
    public function getTraitName()
    {
        return $this->traitName;
    }

    /**
     * @return array
     */
    public function getMethods(): array
    {
        return $this->methods;
    }

}