<?php declare(strict_types=1);

namespace Surda\Mpdf;

use Mpdf\Mpdf;
use Mpdf\MpdfException;

class MpdfFactory
{
    /** @var array */
    private $config;

    /**
     * @param array $config
     */
    public function __construct(array $config = [])
    {
        $this->config = $config;
    }

    /**
     * @return Mpdf
     * @throws MpdfException
     */
    public function create(): Mpdf
    {
        return new Mpdf($this->config);
    }

    /**
     * @return array
     */
    public function getConfig(): array
    {
        return $this->config;
    }

    /**
     * @param array $config
     */
    public function setConfig(array $config): void
    {
        $this->config = $config;
    }
}