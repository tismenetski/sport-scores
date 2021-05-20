<?php

use Symfony\Component\VarDumper\Cloner\VarCloner;
use Symfony\Component\VarDumper\Dumper\CliDumper;
use Symfony\Component\VarDumper\Dumper\HtmlDumper;

function ddd($variable, $depth = -1, $stringLength = 20)
{
    $cloner = new VarCloner();
    $cloner->setMaxString($stringLength);
    $dumper = 'cli' === PHP_SAPI ? new CliDumper() : new HtmlDumper();
    $dumper->dump($cloner->cloneVar($variable)->withMaxDepth($depth));

    die(1);
}
