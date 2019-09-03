<?php declare(strict_types=1);

namespace Tests\Surda\Mpdf;

use Mpdf\Mpdf;
use Nette\DI\Container;
use Surda\Mpdf\MpdfFactory;
use Tester\Assert;
use Tester\TestCase;

require __DIR__ . '/../bootstrap.php';

/**
 * @testCase
 */
class MpdfFactoryTest extends TestCase
{
    public function testControl()
    {
        /** @var Container $container */
        $container = (new ContainerFactory())->create([
            'mpdf' => [
                'mpdf' => [
                    'tempDir' => TMP_DIR
                ]
            ]
        ]);

        /** @var MpdfFactory $factory */
        $factory = $container->getService('mpdf.factory');

        Assert::same(['tempDir' => TMP_DIR], $factory->getConfig());

        /** @var Mpdf $mpdf */
        $mpdf = $factory->create();

        Assert::true($mpdf instanceof Mpdf);
    }
}

(new MpdfFactoryTest())->run();