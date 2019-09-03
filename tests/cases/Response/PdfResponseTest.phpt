<?php declare(strict_types=1);

namespace Tests\Surda\Mpdf;

use Nette\Http;
use Surda\Mpdf\Response\PdfResponse;
use Tester\Assert;
use Tester\TestCase;

require __DIR__ . '/../../bootstrap.php';

/**
 * @testCase
 */
class PdfResponseTest extends TestCase
{
    public function testContent()
    {
        $data = 'žluťoučký kůň';
        $pdfResponse = new PdfResponse($data);

        ob_start();
        $pdfResponse->send(new Http\Request(new Http\UrlScript), new Http\Response);
        Assert::same($data, ob_get_clean());
    }
}

(new PdfResponseTest())->run();