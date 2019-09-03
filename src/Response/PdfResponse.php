<?php declare(strict_types=1);

namespace Surda\Mpdf\Response;

use Nette;

final class PdfResponse implements Nette\Application\IResponse
{
    /** @var string */
    private $content;

    public function __construct(string $content)
    {
        $this->content = $content;
    }

    public function send(Nette\Http\IRequest $httpRequest, Nette\Http\IResponse $httpResponse): void
    {
        $httpResponse->setContentType('application/pdf', 'utf-8');
        echo $this->content;
    }
}