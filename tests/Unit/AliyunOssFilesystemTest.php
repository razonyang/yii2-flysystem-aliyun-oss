<?php
namespace RazonYang\Yii2\Flysystem\Tests;

use Codeception\Test\Unit;
use RazonYang\Yii2\Flysystem\AliyunOssFilesystem;
use yii\base\InvalidArgumentException;

class AliyunOssFilesystemTest extends Unit
{
    /**
     * @dataProvider dataInit
     */
    public function testInit(string $accessKeyId, string $accessKeySecret, string $endpoint, string $bucket, ?\Throwable $exception = null): void
    {
        if ($exception) {
            $this->expectException(get_class($exception));
            $this->expectExceptionMessage($exception->getMessage());
            $this->createFlysystem($accessKeyId, $accessKeySecret, $endpoint, $bucket);
            return;
        }

        $filesystem = $this->createFlysystem($accessKeyId, $accessKeySecret, $endpoint, $bucket);
        $this->assertSame($accessKeyId, $filesystem->getAccessKeyId());
        $this->assertSame($accessKeySecret, $filesystem->getAccessKeySecret());
        $this->assertSame($endpoint, $filesystem->getEndpoint());
        $this->assertSame($bucket, $filesystem->getBucket());
    }

    public function dataInit(): array
    {
        return [
            ['', 'secret', 'endpoint', 'bucket', new InvalidArgumentException('accessKeyId is required')],
            ['accessKeyId', '', 'endpoint', 'bucket', new InvalidArgumentException('accessKeySecret is required')],
            ['accessKeyId', 'secret', '', 'bucket', new InvalidArgumentException('endpoint is required')],
            ['accessKeyId', 'secret', 'endpoint', '', new InvalidArgumentException('bucket is required')],
            ['accessKeyId', 'secret', 'endpoint', 'bucket'],
        ];
    }

    private function createFlysystem(string $accessKeyId, string $accessKeySecret, string $endpoint, string $bucket): AliyunOssFilesystem
    {
        return new AliyunOssFilesystem([
            'accessKeyId' => $accessKeyId,
            'accessKeySecret' => $accessKeySecret,
            'endpoint' => $endpoint,
            'bucket' => $bucket,
        ]);
    }

    /**
     * @dataProvider dataSetGet
     */
    public function testSetGet(
        string $accessKeyId,
        string $accessKeySecret,
        string $endpoint,
        bool $isCName,
        string $securityToken,
        string $bucket,
        string $prefix,
        array $options
    ): void {
        $filesystem = $this->createFlysystem('1', '2', '3', '4');
        $filesystem->setAccessKeyId($accessKeyId);
        $this->assertSame($accessKeyId, $filesystem->getAccessKeyId());

        $filesystem->setAccessKeySecret($accessKeySecret);
        $this->assertSame($accessKeySecret, $filesystem->getAccessKeySecret());

        $filesystem->setEndpoint($endpoint);
        $this->assertSame($endpoint, $filesystem->getEndpoint());

        $filesystem->setIsCName($isCName);
        $this->assertSame($isCName, $filesystem->getIsCName());

        $filesystem->setSecurityToken($securityToken);
        $this->assertSame($securityToken, $filesystem->getSecurityToken());

        $filesystem->setBucket($bucket);
        $this->assertSame($bucket, $filesystem->getBucket());

        $filesystem->setPrefix($prefix);
        $this->assertSame($prefix, $filesystem->getPrefix());

        $filesystem->setOptions($options);
        $this->assertSame($options, $filesystem->getOptions());
    }

    public function dataSetGet(): array
    {
        return [
            ['id', 'secret1', 'endpoint1', false, 'token1', 'bucket1', 'prefix1', []],
            ['id2', 'secret2', 'endpoint2', true, 'token2', 'bucket2', 'prefix2', ['k1' => 'v1']],
        ];
    }
}
