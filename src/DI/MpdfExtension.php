<?php declare(strict_types=1);

namespace Surda\Mpdf\DI;

use Nette\DI\CompilerExtension;
use Nette\Schema\Expect;
use Nette\Schema\Schema;
use Surda\Mpdf\MpdfFactory;

class MpdfExtension extends CompilerExtension
{
    public function getConfigSchema(): Schema
    {
        $parameters = $this->getContainerBuilder()->parameters;
        $tempDir = array_key_exists('tempDir', $parameters) ? $parameters['tempDir'] . '/mpdf' : NULL;

        return Expect::structure([
            'mpdf' => Expect::array()->default([
                'tempDir' => $tempDir,
            ]),
        ]);
    }

    public function loadConfiguration(): void
    {
        $builder = $this->getContainerBuilder();
        $config = $this->config;

        $builder->addDefinition($this->prefix('factory'))
            ->setFactory(MpdfFactory::class, [(array) $config->mpdf]);
    }
}