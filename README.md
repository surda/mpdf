# [mPDF](https://mpdf.github.io) integration into Nette Framework

-----

[![Build Status](https://travis-ci.org/surda/mpdf.svg?branch=master)](https://travis-ci.org/surda/mpdf)
[![Licence](https://img.shields.io/packagist/l/surda/mpdf.svg?style=flat-square)](https://packagist.org/packages/surda/mpdf)
[![Latest stable](https://img.shields.io/packagist/v/surda/mpdf.svg?style=flat-square)](https://packagist.org/packages/surda/mpdf)
[![PHPStan](https://img.shields.io/badge/PHPStan-enabled-brightgreen.svg?style=flat)](https://github.com/phpstan/phpstan)

## Installation

The recommended way to is via Composer:

```
composer require surda/mpdf
```

After that you have to register extension in config.neon:

```yaml
extensions:
    mpdf: Surda\Mpdf\DI\MpdfExtension
```

## Configuration

Default
```yaml
mpdf:
    mpdf:
        tempDir: %tempDir%/mpdf
```

Custom mPDF config

See https://mpdf.github.io/reference/mpdf-functions/construct.html

```yaml
mpdf:
    mpdf:
        tempDir: %tempDir%/mpdf
        margin_left: 15
        margin_right: 15
        margin_top: 16
        margin_bottom: 16
        margin_header: 9
        margin_footer: 9
        mode: 'utf-8'
        format: 'A4'
        orientation: 'P'
        default_font_size: 0  
        default_font: ''
```

## Usage

```php
use Surda\Mpdf\MpdfFactory;
use Surda\Mpdf\Response\PdfResponse;

class OrderPresenter extends Nette\Application\UI\Presenter
{
    /** @var MpdfFactory */
    private $pdfFactory;

    /**
     * @param MpdfFactory $pdfFactory
     */
    public function injectMpdfFactory(MpdfFactory $pdfFactory): void
    {
        $this->pdfFactory = $pdfFactory;
    }

    public function actionPdf(): void
    {
        $this->template->setFile('/path/to/template.latte');

        $mpdf = $this->mpdfFactory->create();
        $mpdf->WriteHTML($this->template);

        $this->sendResponse(new PdfResponse($mpdf->Output()));
    }
}
```

## Create pdf with latte only

```php
$latte = new Latte\Engine;
$latte->setTempDirectory('/path/to/temp');

$parameters = [
    'foo' => 'bar',
];

$template = $latte->renderToString('/path/to/template.latte', $parameters);

$mpdf = $this->mpdfFactory->create();
$mpdf->WriteHTML($template);

$this->sendResponse(new PdfResponse($mpdf->Output()));
```

## Responses

```php
// Download
$this->sendResponse(new PdfResponse($mpdf->Output('file.pdf', \Mpdf\Output\Destination::DOWNLOAD)));

// Display in a browser
$this->sendResponse(new PdfResponse($mpdf->Output('file.pdf', \Mpdf\Output\Destination::INLINE)));
```
