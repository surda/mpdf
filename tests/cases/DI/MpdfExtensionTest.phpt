<?php declare(strict_types=1);

namespace Tests\Surda\Mpdf;

use Nette\DI\Container;
use Surda\Mpdf\MpdfFactory;
use Tester\Assert;
use Tester\TestCase;

require __DIR__ . '/../../bootstrap.php';

/**
 * @testCase
 */
class MpdfExtensionTest extends TestCase
{
    public function testRegistration()
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
        Assert::true($factory instanceof MpdfFactory);

        /** @var MpdfFactory $factory */
        $factory = $container->getByType(MpdfFactory::class);
        Assert::true($factory instanceof MpdfFactory);
    }
}

(new MpdfExtensionTest())->run();